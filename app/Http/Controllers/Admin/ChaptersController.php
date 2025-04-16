<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use App\Models\ChapterPrice;

class ChaptersController extends Controller
{
    
    public function chapter(){
        $chapters = Chapter::
        orderByDesc('id')
        ->get();
        $categories = Category::
        orderByDesc('id')
        ->get();
        $courses = Course::
        orderByDesc('id')
        ->get();
        $teachers = User::
        where('position', 'teacher')
        ->orderByDesc('id')
        ->get();

        return view('Admin.courses.Chapters.Chapters', 
        compact('chapters', 'courses', 'categories', 'teachers'));
    }

    public function chapter_edit( Request $req ){
      
        $arr = $req->only('chapter_name', 'ch_des', 
        'course_id', 'pre_requisition', 'gain', 'teacher_id');
        
        $img_name = null;
        
        extract($_FILES['ch_url']);
        if( !empty($name) ){
            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if ( in_array($extension, $extension_arr) ) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['ch_url'] = $img_name;
            }
            
        }
        move_uploaded_file($tmp_name, 'images/Chapters/' . $img_name);

        Chapter::where('id', $req->chapter_id)
        ->update($arr);

        ChapterPrice::where('chapter_id', $req->chapter_id)
        ->delete();

        if ( count($req->duration) > 0 ) {
            for ($i=0, $end = count($req->duration); $i < $end; $i++) { 
                ChapterPrice::create([
                    'duration' => $req->duration[$i],
                    'price' => $req->price[$i],
                    'discount' => $req->discount[$i],
                    'chapter_id' => $req->chapter_id,
                ]);
            }
        }
        
        return redirect()->back();
    }
    
    public function ch_filter( Request $req ){
        if ( empty( $req->course_id ) && empty( $req->category_id ) ) {
            $chapters = Chapter::
            get(); 
        }
        elseif ( empty( $req->course_id ) ) {
            $chapters = Chapter::
            leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->where('courses.category_id', $req->category_id)
            ->get(); 
        }
        else{
            $chapters = Chapter::
            where('course_id', $req->course_id)
            ->get(); 
        }
        
        $data = $req->all();
        $categories = Category::
        orderByDesc('id')
        ->get();
        $courses = Course::
        orderByDesc('id')
        ->get();
        $teachers = User::
        where('position', 'teacher')
        ->orderByDesc('id')
        ->get();

        return view('Admin.courses.Chapters.Chapters', 
        compact('chapters', 'courses', 'categories', 'teachers', 'data'));
    }

    public function del_chapter($id){
        $lesson = Lesson::where('chapter_id', $id)
        ->first();
        if( !empty($lesson) ){
            session()->flash('faild','You Must Delete Linked Lesson');
            return redirect()->back();
        }
        Chapter::
        where('id', $id)
        ->delete();
        session()->flash('success','Chapter Deleted Successfully');
        return redirect()->back();
    }

    public function add_chapter( Request $req ){
        $arr = $req->only('chapter_name', 'ch_des', 'pre_requisition', 
        'gain', 'course_id','currency_id', 'teacher_id');
        
        if ( count($req->duration) == 0 || $req->duration[0] == null ) {
            session()->flash('faild','You Must Enter Pricing');
            return redirect()->back();
        }

        $req->validate([
            'chapter_name'    => 'required',
            'ch_des'          => 'required',
            'pre_requisition' => 'required',
            'gain'            => 'required',
            'teacher_id'      => 'required|numeric',
            'course_id'       => 'required|numeric',
            'currency_id' => 'sometimes|numeric',
           ]);
        $img_name = null;
        extract($_FILES['ch_url']);
        if( !empty($name) ){
            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if ( in_array($extension, $extension_arr) ) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $arr['ch_url'] = $img_name;
            }
            
        }
        move_uploaded_file($tmp_name, 'images/Chapters/' . $img_name);
        $data = Chapter::create($arr);
        for ($i=0, $end = count($req->duration); $i < $end; $i++) { 
            ChapterPrice::create([
                'duration' => $req->duration[$i],
                'price' => $req->price[$i],
                'discount' => $req->discount[$i],
                'chapter_id' => $data->id,
            ]);
        }
        session()->flash('success','Chapter Added Successfully');
        return redirect()->back();
    }

}
