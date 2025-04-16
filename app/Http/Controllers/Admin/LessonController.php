<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\IdeaLesson;
use App\Models\User;
use App\Models\ReportVideoList;

class LessonController extends Controller
{
// This Start About Lessons 
    public function index(){
        $categories = Category::all();
        $courses    = Course::all();
        $chapters   = Chapter::all();
        $lessons    = Lesson::
        orderByDesc('id')
        ->get();
        $teachers   = User::
        where('position', 'teacher')
        ->get();
        return view('Admin.lessons.lesson',compact('categories','courses','chapters', 'lessons', 'teachers'));

    }

   public function lesson_edit(Request $req)
{
    $lesson_name = Lesson::where('id', '!=', $req->lesson_id)
        ->where('lesson_name', $req->lesson_name)
        ->first();

    if (!empty($lesson_name)) {
        session()->flash('faild', 'Lesson already exists');
        return redirect()->back();
    }

    $arr = $req->only('lesson_name', 'lesson_des', 'chapter_id', 'teacher_id', 'pre_requisition', 'gain', 'chapter_id');

    $req->validate([
        'lesson_name' => 'required',
        'chapter_id'  => 'required|numeric',
    ]);

    $img_name = null;
    if ($req->hasFile('lesson_url')) {
        $file = $req->file('lesson_url');
        $img_name = rand(0, 1000) . now() . $file->getClientOriginalName();
        $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
        $arr['lesson_url'] = $img_name;
        $file->move(public_path('images/lesson/'), $img_name);
    }

    Lesson::where('id', $req->lesson_id)->update($arr);

    $existingIdeas = IdeaLesson::where('lesson_id', $req->lesson_id)->get();
    $existingIdeas->each(function ($idea) use ($req) {
        $idea->delete();
    });

    if (isset($req->idea)) {
        for ($i = 0, $end = count($req->idea); $i < $end; $i++) {
            $pdf_name = null;

            // Handle PDF file
            if ($req->hasFile("pdf.$i")) {
                $pdfFile = $req->file("pdf.$i");
                $pdf_name = now() . $pdfFile->getClientOriginalName();
                $pdf_name = str_replace([':', '-', ' '], 'V', $pdf_name);
                $pdfFile->move(public_path('files/lessons_pdf/'), $pdf_name);
            } else if (isset($existingIdeas[$i])) {
                // Retain existing PDF if no new file is uploaded
                $pdf_name = $existingIdeas[$i]->pdf;
            }

            IdeaLesson::create([
                'idea'       => $req->idea[$i],
                'syllabus'   => $req->syllabus[$i],
                'idea_order' => $req->idea_order[$i],
                'v_link'     => $req->v_link[$i],
                'pdf'        => $pdf_name,
                'lesson_id'  => $req->lesson_id,
            ]);
        }
    }

    session()->flash('success', 'Lesson Edited Successfully');
    return redirect()->back();
}

    public function del_lesson($id){
        Lesson::where('id', $id)
        ->delete();
                session()->flash('success','Lesson Deleted Successfully');
        return redirect()->back();
    }

    public function filter_lesson( Request $req ){
        $categories = Category::all();
        $courses    = Course::all();
        $chapters   = Chapter::all();
        if( empty($req->chapter_id) && !empty($req->course_id) ){
            $course_id = $req->course_id;
            $lessons = Lesson::
            whereHas('chapter', function($query) use($course_id){
                $query->where('course_id', $course_id);
            })
            ->get();
        }
        elseif (  empty($req->chapter_id) && !empty($req->category_id) ) {
            $category_id = $req->category_id;
            $lessons = Lesson::
            whereHas('chapter.course', function($query) use($category_id){
                $query->where('category_id', $category_id);
            })
            ->get();
        }
        else{ 
            $lessons = Lesson::
            where('chapter_id', $req->chapter_id)
            ->get();
        }
        $teachers   = User::
        where('position', 'teacher')
        ->get();
        $data = $req->all();

        return view('Admin.lessons.lesson',
        compact('categories','courses','chapters', 'lessons', 'teachers', 'data'));

    }

    public function addLesson(request $req){
        $lesson_name = Lesson::
        where('lesson_name', $req->lesson_name)
        ->first();
        if ( !empty($lesson_name) ) {
            session()->flash('faild','Lesson is exist');
            return redirect()->back();
        }

        $data = $req->only('lesson_name', 'chapter_id', 'teacher_id', 'lesson_des',
        'pre_requisition', 'gain');
        $req->validate([
            'lesson_name'=>'required',
            'chapter_id'=>'required|numeric',
            ]);
        $img_name = null;
        extract($_FILES['lesson_url']);
        if( !empty($name) ){
            $extension_arr = ['png', 'jpg', 'jpeg', 'svg', 'webp'];
            $extension = explode('.', $name);
            $extension = end($extension);
            $extension = strtolower($extension);
            if ( in_array($extension, $extension_arr) ) {
                $img_name = rand(0, 1000) . now() . $name;
                $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
                $data['lesson_url'] = $img_name;
            }
            
        }
        move_uploaded_file($tmp_name, 'images/lesson/' . $img_name);

        $arr = Lesson::create($data);
        if ( isset($req->idea) ) { 
            for ($i=0, $end = count($req->idea); $i < $end; $i++) { 
                extract($_FILES['pdf']);
                if ( !empty($name[$i]) ) {
                    $pdf_name = now() . $name[$i];
                    $pdf_name = str_replace([':', '-', ' '], 'V', $pdf_name);
                } 
                else {
                    $pdf_name = null;
                }
                
                IdeaLesson::create([
                    'idea' => $req->idea[$i],
                    'syllabus' => $req->syllabus[$i],
                    'idea_order' => $req->idea_order[$i],
                    'v_link' => $req->v_link[$i],
                    'pdf' => $pdf_name,
                    'lesson_id' => $arr->id,
                ]);
                move_uploaded_file($tmp_name[$i], 'files/lessons_pdf/' . $pdf_name);
            }
        }
                session()->flash('success','Lesson Added Successfully');
        return redirect()->back();
    }

    public function lessons( Request $req ){
        if ( $req->chapter_id ) {
            $lessons = Lesson::
            where('chapter_id', $req->chapter_id)
            ->get();
    
            return response()->json([
                'lessons' => $lessons
            ]);
        }
        elseif ( $req->course_id ) {
            $chapters = Chapter::where('course_id', $req->course_id)
            ->get();
    
            return response()->json([
                'chapters' => $chapters
            ]);
        }
    }
}
