<?php

namespace App\Http\Controllers\Api\Admin\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trait\Image;

use App\Models\User;
use App\Models\Category;
use App\Models\TeacherCourse;
use App\Models\Course;

class TeacherController extends Controller
{
    public function __construct(private User $user,
    private Category $categories, private Course $courses,
    private TeacherCourse $teacher_course){}
    use Image;

    protected $teacherRequest = [
        'nick_name' ,
        'email' ,
        'phone',
    ];

    public function view(Request $request){
        $teachers = $this->user
        ->where('position', 'teacher')
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->nick_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'image' => $item->image_link,
                'categories' => $item->teacher_courses?->pluck('category'),
                'courses' => $item->teacher_courses,
            ];
        });
        $categories = $this->categories
        ->get();
        $courses = $this->courses
        ->get();

        return response()->json([
            'teachers' => $teachers,
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }

    public function create(Request $request){
        // image, nick_name, email, phone, password, 
        // course_ids[], category_ids[]
        $validator = Validator::make($request->all(), [
            'nick_name'  => 'required|unique:users,nick_name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'course_ids' => 'required|array',
            'category_ids' => 'required|array',
            'course_ids.*' => 'required|exists:courses,id',
            'category_ids.*' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $teacherRequest = $request->only($this->teacherRequest);
        $teacherRequest['password'] = bcrypt($request->password);
        $teacherRequest['position'] = 'teacher';
        $teacherRequest['state'] = 'Show';
        if ($request->image) {
            $image_path = $this->store_base64($request->image, 'images/users');
            $teacherRequest['image'] = $image_path;
        }
        $teacher = $this->user
        ->create($teacherRequest);
        foreach ($request->course_ids as $item) {
            $this->teacher_course
            ->create([
                'user_id' => $teacher->id,
                'course_id' => $item,
            ]);
        }

        return response()->json([
            'success' => 'You add data success'
        ]);
    }

    public function modify(Request $request, $id){
        // image, nick_name, email, phone, password, 
        // course_ids[], category_ids[]
        $validator = Validator::make($request->all(), [
            'nick_name'  => 'required|unique:users,nick_name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,email,' . $id,
            'password' => 'required',
            'course_ids' => 'required|array',
            'category_ids' => 'required|array',
            'course_ids.*' => 'required|exists:courses,id',
            'category_ids.*' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $teacher = $this->user
        ->where('position', 'teacher')
        ->where('id', $id)
        ->first();
        $image_path = null;
        if ($request->image) {
            $image_path = $this->store_base64($request->image, 'images/users');
            $this->delete_image('images/users', $teacher->image);
        }
        $teacher->nick_name = $request->nick_name ?? $teacher->nick_name;
        $teacher->email = $request->email ?? $teacher->email;
        $teacher->phone = $request->phone ?? $teacher->phone;
        $teacher->password = bcrypt($request->password) ?? $teacher->password;
        $teacher->image = $request->image ? $image_path : $teacher->image;
        $teacher->save();
        if ($request->course_ids) {
            $this->teacher_course
            ->where('user_id', $teacher->id)
            ->delete();
            foreach ($request->course_ids as $item) {
                $this->teacher_course
                ->create([
                    'user_id' => $teacher->id,
                    'course_id' => $item,
                ]);
            }
        }

        return response()->json([
            'success' => 'You update data success'
        ]);
    }

    public function delete(Request $request, $id){
        $teacher = $this->user
        ->where('position', 'teacher')
        ->where('id', $id)
        ->first();
        $this->delete_image('images/users', $teacher->image);
        $this->user
        ->where('position', 'teacher')
        ->where('id', $id)
        ->delete();

        return response()->json([
            'success' => $teacher
        ]);
    }
}
