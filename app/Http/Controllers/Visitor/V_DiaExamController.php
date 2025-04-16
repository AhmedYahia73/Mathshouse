<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Models\Category;
use App\Models\Course;
use App\Models\DiagnosticExam;
use App\Models\Question;
use App\Models\DiagnosticExamsHistory;
use App\Models\DaiExamMistake;
use App\Models\ScoreList;
use App\Models\MarketingPopup;
use App\Models\ReportQuestionList;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class V_DiaExamController extends Controller
{
    
    public function index(){
        if ( empty(auth()->user()) ) {
            if ( !Cookie::get('previous_page') ) {
                Cookie::queue(Cookie::make('previous_page', url()->current(), 90));
            }
            return redirect()->route('login.index');
        }
        $categories = Category::all();
        $courses = Course::all();
        $popup = MarketingPopup::
        where('starts', '<=', now())
        ->where('ends', '>=', now())
        ->whereHas('popup_pages', function($query){
            $query->where('page_name', 'Diagnostic Exam', 'popup');
        })
        ->get();

        return view('Visitor.Dia_Exam.Dia_Exam', compact('categories', 'popup', 'courses'));
    }

    public function v_dia_courses( $id ){
        if ( empty(auth()->user()) ) {
            if ( !Cookie::get('previous_page') ) {
                Cookie::queue(Cookie::make('previous_page', url()->current(), 90));
            }
            return redirect()->route('login.index');
        }

        $courses = Course::where('category_id', $id)
        ->get();

        return view('Visitor.Dia_Exam.Courses', compact('courses'));
    }

    public function v_dia_exam( Request $req ){
        if ( empty(auth()->user()) ) {
            if ( !Cookie::get('previous_page') ) {
                Cookie::queue(Cookie::make('previous_page', url()->current(), 90));
            }
            return redirect()->route('login.index');
        }
        $exam = DiagnosticExam::where('course_id', $req->course_id)
        ->where('state', 1)
        ->get();
        $num = rand(0, count($exam) - 1);
        if ( !isset($exam[$num]) ) {
            session()->flash('faild','Diagnostic Exams Is Empty');
            return redirect()->back();
        }
        $exam = $exam[$num];
        $reports = ReportQuestionList::all();
        
        return view('Visitor.Dia_Exam.Exam', compact('exam', 'reports'));
    }

    public function dia_exam_ans( $id, Request $req )
    {
        $timer_val = json_decode(Session::get('timer'));
        
        $exam = DiagnosticExam::where('id', $id)
        ->first();
        $deg = 0;
        $mistakes = [];
        $total_question = 0;
        if ( isset($req->q_answers) ) {
            foreach ( $req->q_answers as $item ) {
                $total_question++;
                $mcq_item = json_decode($item);
                $question = Question::where('id', $mcq_item->q_id)
                ->first();

                if ( isset($question->mcq[0]) && !empty($question->mcq[0]) ) {
                    $stu_solve = $question->mcq[0]->mcq_answers;
                    $arr = ['A', 'B', 'C', 'D', 'E']; 
                    if ( isset($mcq_item->answer) && $stu_solve == $mcq_item->answer ) {
                        $deg++;
                    } else {
                        $mistakes[] = $question;
                    }
                }
                else {
                    $mistakes[] = $question;
                }
            }
        }

       // "":["{\"q_id\":20}","{\"q_id\":1}"],"q_grid_ans":["1","1"]}
        if ( isset($req->q_grid_answers) ) {
            for ( $i = 0, $end = count($req->q_grid_answers); $i < $end; $i++ ) {
                $total_question++;
                $grid_item = json_decode($req->q_grid_answers[$i]);
                $question = Question::where('id', $grid_item->q_id)
                ->first();
                $grid_ans = @$question->g_ans[0]->grid_ans;
                $answer = $req->q_grid_ans[$i];
                if ( strpos($answer, '/') ) {
                    $arr_ans = explode('/', $answer);
                    try {
                        $answer = floatval($arr_ans[0]) / floatval($arr_ans[1]);
                    } catch (\Throwable $th) {
                        $answer = 0;
                    }
                    if ( floatval($grid_ans) == $answer || 
                    (floatval($grid_ans) - $answer < .06 && floatval($grid_ans) - $answer > 0 ) ||
                    ($answer - floatval($grid_ans) < .06 && $answer - floatval($grid_ans) > 0 ) ) {
                        $deg++;
                    }
                    else {
                        $mistakes[] = $question;
                    }
                }
                elseif ( floatval($grid_ans) == floatval($answer) ) {
                    $deg++;
                } else {
                    $mistakes[] = $question;
                }
            }
        }

        $right_question = $deg;
        $score = ScoreList::
        where('score_id', $exam->score_id)
        ->where('question_num', $right_question)
        ->first();
        $score = $right_question == 0 ? 200 : $score->score;
        $grade = $exam->pass_score < $score ? true : false;
        $deg =  $deg / $total_question * 100;

        // $stu_q = DiagnosticExamsHistory::where('user_id', auth()->user()->id)
        //     ->where('diagnostic_exams_id', $req->quizze_id)
        //     ->first();

        // if (empty($stu_q)) {
        $timer_val = json_decode(Session::get('timer')); // Start time from cookie
        
       $startTime = Carbon::parse($timer_val ?? "00:00:00"); // Parse the start time using Carbon
       $endTime = Carbon::parse($exam->time); // Get the current time using Carbon
        // Calculate the difference
        $difference = $startTime->diffForHumans($endTime);
        // Output the result
         $fullTime = $difference;

        $stu_exam = DiagnosticExamsHistory::create([
            'date' => now(),
            'user_id' => auth()->user()->id,
            'diagnostic_exams_id' => $exam->id,
            'score' => $score,
            'time' => $timer_val, 
            'daily' => $fullTime, // Formats it as a readable date$fullTime,
            // 'dilay_timer' => $timer_val, 
            'r_questions' => $right_question,
        ]);
        foreach ($mistakes as $item) {
           $studentDiaExam = DaiExamMistake::create([
                'student_exam_id' => $stu_exam->id,
                'question_id' => $item->id
            ]);
        }

        // }
        $dia_id = $stu_exam->id;
        // Make Daily Exam History
          //  session_destroy();
        return view('Visitor.Dia_Exam.Grade', compact('deg', 'grade', 'score', 'exam', 
        'dia_id', 'right_question', 'total_question', 'mistakes','studentDiaExam'));
    }

    public function dia_exam_history(){
        $dia_history = DiagnosticExamsHistory::
        where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();
        return view('Student.Dia_History.Dia_History', compact('dia_history'));
    }

}
