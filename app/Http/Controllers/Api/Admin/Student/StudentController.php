<?php

namespace App\Http\Controllers\Api\Admin\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trait\Image;

use App\Models\User;
use App\Models\Category;

class StudentController extends Controller
{
    public function __construct(private User $user, private Category $categories){}

    protected $studentRequest = [ 
        'f_name',
        'l_name',
        'nick_name',
        'email',
        'phone',
        'parent_phone',
        'parent_email',
        'grade',
        'category_id',
    ];
    use Image;

    public function view(Request $request){
        $students = $this->user
        ->where('position', 'student')
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'f_name' => $item->f_name,
                'l_name' => $item->l_name,
                'nick_name' => $item->nick_name,
                'email' => $item->email,
                'phone' => $item->phone,
                'parent_phone' => $item->parent_phone,
                'parent_email' => $item->phone,
                'grade' => $item->grade,
                'image' => $item->image_link,
                'category' => $item?->category?->cate_name,
                'category_id' => $item->category_id,
            ];
        }); 
        $categories = $this->categories
        ->get(); 

        return response()->json([
            'students' => $students,
            'categories' => $categories, 
        ]);
    }

    public function create(Request $request){
        
        $validator = Validator::make($request->all(), [
            'f_name'  => 'required',
            'l_name'  => 'required',
            'nick_name'  => 'required|unique:users,nick_name',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'parent_phone' => 'nullable|sometimes|unique:users,parent_phone',
            'parent_email' => 'nullable|sometimes|unique:users,parent_email',
            'grade' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $studentRequest = $request->only($this->studentRequest);
        $studentRequest['password'] = bcrypt($request->password);
        $studentRequest['position'] = 'student';
        $studentRequest['state'] = 'Show';
        if ($request->image) {
            $image_path = $this->store_base64($request->image, 'images/users');
            $studentRequest['image'] = $image_path;
        }
        $student = $this->user
        ->create($studentRequest); 

        return response()->json([
            'success' => 'You add data success'
        ]);
    }

    public function modify(Request $request){
        
        $validator = Validator::make($request->all(), [
            'f_name'  => 'required',
            'l_name'  => 'required',
            'nick_name'  => 'required|unique:users,nick_name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'password' => 'required',
            'parent_phone' => 'nullable|sometimes|unique:users,parent_phone,' . $id,
            'parent_email' => 'nullable|sometimes|unique:users,parent_email,' . $id,
            'grade' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $student = $this->user
        ->where('position', 'student')
        ->where('id', $id)
        ->first();
        $image_path = null;
        if ($request->image) {
            $image_path = $this->store_base64($request->image, 'images/users');
            $this->delete_image('images/users', $student->image);
        }
        $student->f_name = $request->f_name ?? $student->f_name;
        $student->l_name = $request->l_name ?? $student->l_name;
        $student->nick_name = $request->nick_name ?? $student->nick_name;
        $student->parent_phone = $request->parent_phone ?? $student->parent_phone;
        $student->parent_email = $request->parent_email ?? $student->parent_email;
        $student->category_id = $request->category_id ?? $student->category_id;
        $student->email = $request->email ?? $student->email;
        $student->phone = $request->phone ?? $student->phone;
        $student->password = bcrypt($request->password) ?? $student->password;
        $student->image = $request->image ? $image_path : $student->image;
        $student->save(); 

        return response()->json([
            'success' => 'You update data success'
        ]);
    }

    public function delete(Request $request){
        $student = $this->user
        ->where('position', 'student')
        ->where('id', $id)
        ->first();
        $this->delete_image('images/users', $student->image);
        $this->user
        ->where('position', 'student')
        ->where('id', $id)
        ->delete();

        return response()->json([
            'success' => $student
        ]);
    }
}
