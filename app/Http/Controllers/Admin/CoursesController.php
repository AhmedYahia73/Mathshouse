<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\CoursePrice;
use App\Models\Category;
use App\Models\User;

class CoursesController extends Controller
{
    protected $requestCourse = ['course_name', 'teacher_id', 'course_des', 'category_id', 'gain', 'pre_requisition'
    ];
    public function courses(){
        $courses = Course::
        orderByDesc('id')
        ->get();
        $categories = Category::
        orderByDesc('id')
        ->get();
        $teachers = User::where('position', 'teacher')
        ->orderByDesc('id')
        ->get();
        return view('Admin.courses.Courses.Course', compact('courses', 'teachers', 'categories'));
    }

    public function course_edit( Request $req ){
        $arr = $req->only($this->requestCourse);

        $req->validate([
         'course_name'  => 'required',
         'teacher_id'   => 'required|numeric',
         'category_id'  => 'required|numeric',
        ]);
        extract($_FILES['course_url']);
        $img_name = null;
        if ( !empty($name) ) {
            $extention_arr = ['jpg', 'jpeg', 'png', 'svg'];
            $extention = explode('.', $name);
            $extention = end($extention);
            $extention = strtolower($extention);
            if ( in_array($extention, $extention_arr)) {
                $img_name = now() . rand(1, 10000) . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['course_url'] = $img_name;
            }
        }
                
        move_uploaded_file($tmp_name, 'images/courses/' . $img_name);

        Course::where('id', $req->course_id)
        ->update($arr);
        CoursePrice::where('course_id', $req->course_id)
        ->delete();
        for ($i=0, $end = count($req->duration); $i < $end; $i++) { 
            CoursePrice::
            create(['course_id' => $req->course_id, 
            'duration' => $req->duration[$i],
            'price' => $req->price[$i],
            'discount' => $req->discount[$i]]);
        }
        session()->flash('success','Course Edit Successfully');
        return redirect()->back();
    } 

    public function del_course($id){
        $Chapters = Chapter::where('course_id', $id)
        ->first();
        if( !empty($Chapters) ){
            session()->flash('faild','You Must Delete Linked Chapters');
            return redirect()->back();
        }

        Course::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function add_courses(){
        $categories = Category::
        orderByDesc('id')
        ->get();
        $teachers = User::where('position', 'teacher')
        ->orderByDesc('id')
        ->get();
        return view('Admin.courses.Courses.AddCourse', 
        compact('categories', 'teachers'));
    }

    public function course_add( Request $req ){
        
        $arr = $req->only('course_name', 'category_id', 'course_des', 'teacher_id', 
        'pre_requisition', 'gain');

        if ( count($req->duration) == 0 || $req->duration[0] == null ) {
            session()->flash('faild','You Must Enter Pricing');
            return redirect()->back();
        }

        $req->validate([
            'course_name'  => 'required',
            'teacher_id'   => 'required|numeric',
            'category_id'  => 'required|numeric',
           ]);
        extract($_FILES['course_url']);
        $img_name = null;
        if ( !empty($name) ) {
            $extention_arr = ['jpg', 'jpeg', 'png', 'svg'];
            $extention = explode('.', $name);
            $extention = end($extention);
            $extention = strtolower($extention);
            if ( in_array($extention, $extention_arr)) {
                $img_name = now() . rand(1, 10000) . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['course_url'] = $img_name;
            }
        }

        move_uploaded_file($tmp_name, 'images/courses/' . $img_name);
        $course_data = Course::create($arr);
        
        for ($i=0, $end = count($req->duration); $i < $end; $i++) { 
            CoursePrice::
            create(['course_id' => $course_data->id, 
            'duration' => $req->duration[$i],
            'price' => $req->price[$i],
            'discount' => $req->discount[$i]]);
        }
        session()->flash('success','Course Added Successfully');
        return redirect()->back();
    }

    public function course_filter( Request $req ){
        if ( $req->category_id == "all" || empty($req->category_id) ) {
            $courses = Course::
            orderByDesc('id')
            ->get();
        }
        else{
            $courses = Course::
            where('category_id', $req->category_id)
            ->orderByDesc('id')
            ->get();
        }
        $teachers = User::where('position', 'teacher')
        ->orderByDesc('id')
        ->get();
        $categories = Category::
        orderByDesc('id')
        ->get();
        $data =  $req->category_id;
        
        return view('Admin.courses.Courses.Course', 
        compact('courses', 'categories', 'teachers', 'data'));
    }

}
