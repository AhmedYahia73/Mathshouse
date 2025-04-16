<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\quizze;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\QQuize;
use App\Models\ExamCodes;

class QuizzeController extends Controller
{
    public function quizze(){ 
        $questions = Question::all();
        $quizzes = quizze::
        orderByDesc('id')
        ->simplePaginate(10);
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $codes = ExamCodes::all();

        return view('Admin.courses.Quizze.Quizze', 
        compact('quizzes', 'questions', 'categories', 'courses', 'chapters', 'lessons', 'codes'));
    }

    public function quize_del_q( Request $req ){
        QQuize::where('id', $req->id)
        ->delete();

        return $req->all();
    }

    public function quize_add_q( Request $req ){
        QQuize::create([
            'quizze_id' => $req->quizze_id,
            'question_id' => $req->question_id,
        ]);

        return $req->all();
    }

    public function quize_data( Request $req ){
        $question = Question::where('lesson_id', $req->lesson)
        ->with('api_lesson')
        ->with('code')
        ->get();

        if ( count($question) == 0 ) {
            return response()->json([
                'faild' => 'Question Is Empty'
            ]);
        } 
        else {
            return response()->json([
                'questions' => $question
            ]);
        }
        
    }

    public function add_quizze( Request $req ){
        $ques_id = json_decode($req->ques_id); 
        
        $req->validate([
            'title' => 'required',
            'score'   => 'required|numeric', 
            'pass_score'    => 'required|numeric',
            'lesson_id'    => 'required|numeric',
            'quizze_order'    => 'required|numeric',
           ]);

        $arr = $req->only('title', 'description', 'score', 'pass_score', 'state', 'lesson_id', 'quizze_order');
        $arr['time'] = $req->time_h . ':' . $req->time_m . ':00';
        if ( !isset($ques_id) ) {
            session()->flash('faild','You Must Enter Questions');
            return redirect()->back();
        }
        $quizze = quizze::create($arr);
        for ( $i=0, $end = count($ques_id); $i < $end; $i++ ) { 
            QQuize::create([
                'quizze_id' => $quizze->id,
                'question_id' => $ques_id[$i]->id,
            ]);
        }

        return redirect()->back();
    }

    public function edit_quizze( Request $req ){
        
        $quizze_data = $req->data[0][0];
        $state = $quizze_data['state'] == 1 ? 1 : 0;
        $quizze = quizze::where('id', $quizze_data['quizzeID'])
        ->update([
            'title' => $quizze_data['title'] ,
            'description' => $quizze_data['description'] ,
            'time' => $quizze_data['time'] ,
            'score' => $quizze_data['score'] ,
            'pass_score' => $quizze_data['pass_score'] ,
            'quizze_order' => $quizze_data['quizze_order'] ,
            'state' => $state ,
        ]);

        QQuize::
        where('quizze_id', $quizze_data['quizzeID'])
        ->delete();
        for ( $i= 1, $end = count($req->data); $i < $end; $i++ ) { 
            QQuize::create([
                'quizze_id' => $quizze_data['quizzeID'],
                'question_id' => $req->data[$i]['question_ID'],
            ]);
        }
        
        return response()->json(['success'=>$quizze_data]); 
    }

    public function del_quizze($id){
        quizze::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function filter_quiz( Request $req ){
        $questions = Question::all();
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $codes = ExamCodes::all();
        $quizzes = [];

        if ( !empty($req->lesson_id) ) {
            $quizzes = quizze::
            where( 'lesson_id', $req->lesson_id )
            ->simplePaginate(10);
        }
        elseif ( !empty($req->chapter_id)) {
            $chapter_id = $req->chapter_id;
            $quizzes = quizze::
            whereHas('lesson', function($query) use($chapter_id){
                $query->where('chapter_id', $chapter_id);
            })
            ->simplePaginate(10);
        }
        elseif ( !empty($req->course_id)) {
            $course_id = $req->course_id;
            $quizzes = quizze::
            whereHas('lesson.chapter', function($query) use($course_id){
                $query->where('course_id', $course_id);
            })
            ->simplePaginate(10);
        }
        elseif ( !empty($req->category_id)) {
            $category_id = $req->category_id;
            $quizzes = quizze::
            whereHas('lesson.chapter.course', function($query) use($category_id){
                $query->where('category_id', $category_id);
            })
            ->simplePaginate(10);
        }
        else {
            $quizzes = quizze::simplePaginate(10);
        }
        

        $data = $req->all();

        return view('Admin.courses.Quizze.Quizze', 
        compact('quizzes', 'questions', 'categories', 'data', 'courses', 'chapters', 'lessons', 'codes'));
    }

}
