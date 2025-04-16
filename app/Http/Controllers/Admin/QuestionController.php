<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Q_ans;
use App\Models\Mcq_ans;
use App\Models\Grid_ans;
use App\Models\ExamCodes;

class QuestionController extends Controller
{
    
    public function question(){
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $questions = Question::
        orderByDesc('id')
        ->simplePaginate(10);
        $exams = ExamCodes::all();

        return view('Admin.courses.Questions.Questions', 
        compact('categories', 'courses', 'chapters', 'lessons', 'questions', 'exams'));
    }

    public function q_edit( $id, Request $req ){
        $arr = $req->only('question', 'lesson_id', 'year', 'month',
        'q_code', 'section', 'q_num', 'difficulty', 'ans_type');
        $req->id = isset($req->id) ? $req->id : [];
        if ( !empty($req->ans_video) ) {
            extract($_FILES['ans_pdf']);
            $q_ans_item = Q_ans::where('Q_id', $id)
            ->whereNotIn('id', $req->id)
            ->delete();
            for ($i=count($req->id), $end = count($req->ans_video); $i < $end; $i++) {
                $pdf = now() . rand(1, 10000) . $name[$i];
                $pdf = str_replace([' ', ':', '-'], 'X', $pdf);
                
                Q_ans::create([
                    'ans_pdf'   => $pdf,
                    'ans_video' => $req->ans_video[$i],
                    'Q_id'      => $id,
                ]);
                move_uploaded_file($tmp_name[$i], 'files/q_pdf/' . $pdf);
            }
        }

        Mcq_ans::where('q_id', $id)
        ->delete();
        Grid_ans::where('q_id', $id)
        ->delete();
        if ( isset($req->mcq_ans) && $req->mcq_answers != null ) {

            for ( $i = 0, $end = count($req->mcq_ans); $i < $end; $i++ ) {
                Mcq_ans::create([
                    'mcq_num' => $req->mcq_char[$i],
                    'mcq_ans' => $req->mcq_ans[$i],
                    'mcq_answers' => $req->mcq_answers, 
                    'q_id' => $id,
                ]);
            }
        }
        
        if( isset($req->grid_ans) && $req->grid_ans[0] != null ){
            foreach ($req->grid_ans as $key => $item) {
                Grid_ans::create([
                    'grid_ans' => $item,
                    'q_id' => $id,
                ]);
            }
        }
       
       extract($_FILES['q_url']);
       $img_tmp = $tmp_name;
       $img_name = null;
       if ( !empty($name) ) {
           $img_name = now() . rand(1, 10000) . $name;
           $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
           $arr['q_url'] = $img_name;
       }

       move_uploaded_file($img_tmp, 'images/questions/' . $img_name);
        Question::where('id', $id)
        ->update($arr);

        return redirect()->back();
    }

    public function del_q( $id ){
        Question::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function filter_question( Request $req ){
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all(); 
        $exams = ExamCodes::all();

        $data = Question::
        select('*', 'questions.id as q_id')
        ->leftJoin('lessons', 'questions.lesson_id', '=', 'lessons.id')
        ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
        ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
        ->get();
        $questions = $data;
        if (isset($req->category_id)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->category_id == $req->category_id ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->course_id)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->course_id == $req->course_id ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->chapter_id)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->chapter_id == $req->chapter_id ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->lesson_id)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->lesson_id == $req->lesson_id ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->q_type)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->q_type == $req->q_type ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->section)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->section == $req->section ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->year)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->year == $req->year ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->month)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->month == $req->month ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->difficulty)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->difficulty == $req->difficulty ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        if (isset($req->q_num)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->q_num == $req->q_num ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        $data = $req->all();

        return view('Admin.courses.Questions.Questions', 
        compact('categories', 'courses', 'chapters', 'lessons', 'questions', 'exams', 'data'));
    }

    public function add_q( Request $req ){
        $arr = $req->only('lesson_id', 'q_code', 'q_type', 'q_num',
        'month', 'year', 'section', 'difficulty', 'question', 'ans_type');
        $req->validate([
            'lesson_id' => 'required|numeric',
            'q_type' => 'required', 
            'q_num' => 'required|numeric',
            'difficulty' => 'required', 
            'question' => 'required', 
            'ans_type' => 'required',
        ]);
        if ( $req->q_code ) {
            $question_statue = Question::
            where('year', $req->year)
            ->where('month', $req->month)
            ->where('section', $req->section)
            ->where('q_num', $req->q_num)
            ->where('q_code', $req->q_code)
            ->first();
        }else {
            $question_statue = Question::
            where('year', $req->year)
            ->where('month', $req->month)
            ->where('section', $req->section)
            ->where('q_num', $req->q_num)
            ->first();
        }

        extract($_FILES['q_url']);
        if ( !empty($name) && !empty($req->question) ) {
            $arr['state'] = '2';
        }
        elseif ( !empty($name) ) {
            $arr['state'] = '1';
        }
        else {
            $arr['state'] = '0';
        }
        $img_name = null;
        if ( !empty($name) ) {
            $img_name = now() . rand(1, 10000) . $name;
            $img_name = str_replace([' ', ':', '-'], 'X', $img_name);
            $arr['q_url'] = $img_name;
        }

        if ( !empty($question_statue) && $req->q_type == 'Trail' ) {
            session()->flash('faild','Question Is Not Trail');
            return redirect()->back();
        }
        if ( empty($question_statue) && $req->q_type == 'Parallel' ) {
            session()->flash('faild','Question Is Not Parallel');
            return redirect()->back();
        }
        move_uploaded_file($tmp_name, 'images/questions/' . $img_name);
        $question = Question::create($arr);
        if ( !empty($req->mcq_answers) ) {
            for ($i=0,$end = count($req->mcq_ans); $i < $end; $i++) { 
                Mcq_ans::create([
                    'mcq_num' => $req->mcq_char[$i],
                    'mcq_ans' => $req->mcq_ans[$i],
                    'mcq_answers' => $req->mcq_answers,
                    'q_id' => $question->id,
                ]);
            }
        }
        else {
            for ($i=0,$end = count($req->grid_ans); $i < $end; $i++) { 
                Grid_ans::create([
                    'grid_ans' => $req->grid_ans[$i], 
                    'q_id' => $question->id,
                ]);
            }
        }

        extract($_FILES['ans_pdf']);
        if ( !empty($req->ans_video) ) {
            for ($i=0, $end = count($req->ans_video); $i < $end; $i++) { 
                $pdf = now() . rand(1, 10000) . $name[$i];
                $pdf = str_replace([' ', ':', '-'], 'X', $pdf);
                
                Q_ans::create([
                    'ans_pdf'   => $pdf,
                    'ans_video' => $req->ans_video[$i],
                    'Q_id'      => $question->id,
                ]);
                move_uploaded_file($tmp_name[$i], 'files/q_pdf/' . $pdf);
            }
        }

        return redirect()->back();
    }

    public function question_type( Request $req ){
        if ( $req->q_code ) {
            $question_statue = Question::
            where('year', $req->year)
            ->where('month', $req->month)
            ->where('section', $req->section)
            ->where('q_num', $req->q_num)
            ->where('q_code', $req->q_code)
            ->where('lesson_id', $req->lesson)
            ->first();
        }
        else{ 
            $question_statue = Question::
            where('year', $req->year)
            ->where('month', $req->month)
            ->where('section', $req->section)
            ->where('q_num', $req->q_num)
            ->where('lesson_id', $req->lesson)
            ->first();
        }

        if ( $req->q_type == 'Trail' && !empty($question_statue) ) {
            return 'Question is not Trial';
        }
        if ( $req->q_type == 'Parallel' && empty($question_statue) ) {
            return 'Question is not Parallel';
        }
        return 1;
    }
}
