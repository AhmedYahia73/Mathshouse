<?php

namespace App\Http\Controllers\Api\Admin\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trait\Image;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\PaymentOrder;
use App\Models\LiveLesson;
use App\Models\PaymentPackageOrder;
use App\Models\SmallPackage;
use App\Models\Session;
use App\Models\SessionAttendance;

class StudentController extends Controller
{
    public function __construct(private User $user, private Category $categories,
    private Course $courses, private Lesson $lessons){}

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
                'grade' => $item->grade,
                'payment' => !empty($item->payment_req_approve->first()) ? 'Paid' : 'Free',
                'image' => $item->image_link,
                'category' => $item?->category?->cate_name,
                'category_id' => $item->category_id,
            ];
        }); 
        $categories = $this->categories
        ->get();
        $courses = $this->courses
        ->select('id', 'course_name')
        ->get();

        return response()->json([
            'students' => $students,
            'categories' => $categories, 
            'courses' => $courses, 
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

    public function modify(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'f_name'  => 'required',
            'l_name'  => 'required',
            'nick_name'  => 'required|unique:users,nick_name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'password' => 'required', 
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

    public function delete(Request $request, $id){
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

    public function payment_history(Request $request, $id){
        $chapters = PaymentOrder::
        whereHas('pay_req', function( $query ) use($id){
            $query->where('user_id', $id);
        }) 
        ->with('chapter.teacher', 'chapter.course', 'pay_req')
        ->where('state', 1)
        ->get();
        $packages = PaymentPackageOrder::
        selectRaw('COUNT(*) as count_package')
        ->whereHas('pay_req', function( $query ) use($id){
            $query->where('user_id', $id);
        })  
        ->with('package', 'pay_req')
        ->where('state', 1)
        ->groupBy('package_id')
        ->get();
        $payment_chapters = $chapters?->pluck('pay_req');
        $payment_packages = $packages?->pluck('pay_req');
        $total_payment = $payment_chapters?->sum('price') +  $payment_packages?->sum('price');

        $chapters = $chapters?->pluck('chapter') 
        ?->map(function($item){
            $item->chapter = $item?->course?->course_name;
            $item->teacher = $item?->teacher?->nick_name;
            return $item;
        });
        $packages = $packages
        ->map(function($item){
            return [
                'id' => $item?->package?->id,
                'package' => $item?->package?->name,
                'count_package' => $item?->count_package,
            ];
        });

        return response()->json([
            'chapters' => $chapters,
            'total_payment' => $total_payment,
            'packages' => $packages
        ]);
    }
    
    public function wallet_balance(Request $request, $student_id){
        $balance = Wallet::
        where('student_id', $student_id)
        ->where('state', 'Approve')
        ->sum('wallet');
        
        return response()->json([
            'balance' => $balance
        ]);
    }

    public function charge_wallet(Request $request){
        
        $validator = Validator::make($request->all(), [
            'wallet'  => 'required',
            'student_id'  => 'required|exists:users,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        Wallet::create([
            'wallet' => $request->wallet,
            'student_id' => $request->student_id,
            'date' => now(),
            'state' => 'Approve',
        ]);

        return response()->json([
            'success' => 'You charge wallet success'
        ]);
    }

    public function academic_list(Request $request, $id){
        $student = $this->user
        ->where('id', $id)
        ->first();
        $category_id = $student?->category_id;
        $courses = $this->courses
        ->where('category_id', $category_id)
        ->get();
        $my_courses = $student->courses_live;

        return response()->json([
            'courses_list' => $courses,
            'my_courses' => $my_courses,
        ]);
    }

    public function academic_list_add(Request $request){
        $validator = Validator::make($request->all(), [
            'course_ids'  => 'required|array',
            'course_ids.*'  => 'required|exists:courses,id',
            'user_id'  => 'required|exists:users,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $student = $this->user
        ->where('id', $request->user_id)
        ->first();
        $student->courses_live()
        ->sync($request->course_ids);

        return response()->json([
            'success' => 'You update data success'
        ]);
    }
  
    public function lives_view(Request $request){
        $validator = Validator::make($request->all(), [ 
            'course_id'  => 'required|exists:courses,id',
            'user_id'  => 'required|exists:users,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $lessons = $this->lessons
        ->whereHas('chapter', function($query) use($request){
            $query->where('course_id', $request->course_id);
        })
        ->get()
        ->map(function($item) use($request){
            return [
                'id' => $item?->id,
                'lesson' => $item?->lesson_name,
                'chapter' => $item?->chapter?->chapter_name,
                'course' => $item?->chapter?->course?->course_name,
                'status' => !empty($item?->live_lesson($request->user_id)?->first()) ? 'attend' : 'Waitting',
                'extra_days' => $item?->user_extraDays($request->user_id)
                ?->sum('extra_days') ?? 0
            ];
        });

        return response()->json([
            'lessons' => $lessons
        ]);
    }

    public function live_attend(Request $request){
        $validator = Validator::make($request->all(), [ 
            'lesson_id'  => 'required|exists:lessons,id',
            'user_id'  => 'required|exists:users,id',
            'attend' => 'required|boolean'
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $have_package = false;
        $sessions_data = Session::where('lesson_id', $request->lesson_id)
        ->orderByDesc('id')
        ->get();
        $sessions = $sessions_data->pluck('id')->toArray();
        $course_id = Lesson::where('id', $request->lesson_id)
        ->first()->chapter->course_id;
        if (!$request->attend) {
            LiveLesson::
            where( 'user_id' , $request->user_id)
            ->where('lesson_id', $request->lesson_id)
            ->delete();
            SessionAttendance::whereIn('session_id', $sessions)
            ->where('user_id', $request->user_id)
            ->delete(); 
        }
        else{
            $package = PaymentPackageOrder::
            where('number', '>', 0)
            ->where('user_id', $request->user_id)
            ->where('state', 1)
            ->whereHas('package_live')
            ->with('package_live')
            ->orderByDesc('id')
            ->get();
            $small_package = SmallPackage::where('user_id', $request->user_id)
            ->where('module', 'Live')
            ->where('number', '>', 0)
            ->first();
            $small_package_count = SmallPackage::where('user_id', $request->user_id)
            ->where('module', 'Live')
            ->where('course_id', $course_id)
            ->sum('number'); 
            if ( !empty($small_package) && $small_package_count > 0 ) {
                $small_package->number = $small_package->number - 1; 
                $small_package->save();
                $have_package = true;
                // Make Live Attend
                LiveLesson::create([
                    'user_id' => $request->user_id,
                    'lesson_id' => $request->lesson_id,
                ]);
                foreach ($sessions_data as $key => $item) {
                    if ($item->session_types == 'explanation') {
                        $mysession = SessionAttendance::create([
                            'user_id' => $request->user_id,
                            'session_id' => $item->id,
                        ]);
                        break;
                    }
                }
            }

        // if buy package
            foreach ( $package as $item ) {
                if ( $item->package_live != null ) {
                    $newTime = Carbon::now()->subDays($item->package_live->duration); 
                    if ( $item->date >= $newTime && $item->package_live->course_id == $course_id ) {
                        PaymentPackageOrder::
                        where('id', $item->id )
                        ->update([
                            'number' => $item->number - 1
                        ]);
                        $have_package = true;
                 
                        LiveLesson::create([
                            'user_id' => $request->user_id,
                            'lesson_id' => $request->lesson_id,
                        ]);
                        foreach ($sessions as $key => $item) {
                            $mysession = SessionAttendance::create([
                                'user_id' => $request->user_id,
                                'session_id' => $item
                            ]);
                        }  
                    }
                }
            }
        
            if(!$have_package){
                return response()->json([
                    'errors' => 'The user does not have package'
                ], 400);
            }
        }

        return response()->json([
            'success' => 'You update status success'
        ]);
    }
}
