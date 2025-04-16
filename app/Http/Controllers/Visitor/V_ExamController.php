<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Models\Exam;
use App\Models\ExamCodes;
use App\Models\Course;
use App\Models\Category;
use App\Models\Package;
use App\Models\User;
use App\Models\Question;
use App\Models\UserPackage;
use App\Models\PaymentPackageOrder;
use App\Models\ScoreList;
use App\Models\ExamHistory;
use App\Models\ExamMistake;
use App\Models\SmallPackage;
use App\Models\MarketingPopup;
use App\Models\ReportQuestionList;
use App\Models\ReportVideoList;
use App\Models\Currancy;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class V_ExamController extends Controller
{
    
    public function v_exams(){
        $exam_code = ExamCodes::all();
        $courses = Course::all();
        $categories = Category::all();
        $popup = MarketingPopup::
        where('starts', '<=', now())
        ->where('ends', '>=', now())
        ->whereHas('popup_pages', function($query){
            $query->where('page_name', 'Exams');
        })
        ->get();

        return view('Visitor.Exam.Exam', compact('exam_code', 'courses', 'categories', 'popup'));
    }

    public function filter_exam( Request $req ){
        // "year":"2024","month":"1","code_id":"1","course_id":"2"
        $exams = Exam::all();
        $exam_items = $exams;
        if ( !empty($req->year) ) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ( $item->year == $req->year ) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        if ( !empty($req->month) ) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ( $item->month == $req->month ) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        if ( !empty($req->code_id) ) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ( $item->code_id == $req->code_id ) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        if ( !empty($req->course_id) ) {
            $exam_items = [];
            foreach ($exams as $item) {
                if ( $item->course_id == $req->course_id ) {
                    $exam_items[] = $item;
                }
            }
            $exams = $exam_items;
        }
        $exam_code = ExamCodes::all();
        $courses = Course::all();
        $categories = Category::all();
        $data = $req->all();
        if (count($exam_items) == 0) {
            session()->flash('faild','No Exams');
        }

        return view('Visitor.Exam.Filter_Exams', 
        compact('exam_items', 'exam_code', 'courses', 'categories', 'data'));
    }

    public function exam_page( $id ){
        // Return Exam
        $exam = Exam::where('id', $id)
        ->first(); 
        $reports = ReportQuestionList::all();
        if ( empty(auth()->user()) ) {
            if ( !Cookie::get('previous_page') ) {
                Cookie::queue(Cookie::make('previous_page', url()->current(), 90));
            }
            return redirect()->route('login.index');
        }
        else{  
            $payments = PaymentPackageOrder::
            where('state', 1)
            ->with('pay_req')
            ->with('package')
            ->get();
            $user = User::where('id', auth()->user()->id)
            ->first();

            $small_package = SmallPackage::where('user_id', auth()->user()->id)
            ->where('module', 'Exam')
            ->where('course_id', $exam->course_id)
            ->where('number', '>', 0)
            ->first();

            if ( !empty($small_package) ) { SmallPackage::where('user_id', auth()->user()->id)
                ->where('module', 'Exam')
                ->where('course_id', $exam->course_id)
                ->where('number', '>', 0)
                ->update([
                    'number' => $small_package->number - 1
                ]);
                // Return Exam
                $exam = Exam::where('id', $id)
                ->first();
                
                return view('Visitor.Exam.Exam_Question', compact('exam', 'reports'));
            }

            foreach ( $payments as $item ) { 
                $newTime = Carbon::now()->subDays($item->package->duration); 

                if ( $item->package->module == 'Exam' && 
                $item->pay_req->user_id == auth()->user()->id &&
                $item->date >= $newTime &&
                $item->number > 0
                && $item->package->course_id == $exam->course_id 
                 ) 
                 {  

                    PaymentPackageOrder::where('id', $item->id)
                    ->update([
                        'number' => $item->number - 1
                    ]);

                    
                    
                    return view('Visitor.Exam.Exam_Question', compact('exam', 'reports'));
                }
            } 

            $package = Package::
            where('module', 'Exam')
            ->where('course_id', $exam->course_id)
            ->get();
            Cookie::queue(Cookie::make('exam_id', $id, 90));
 
            $categories = Category::get();
            $courses = Course::get();
            $module = 'Exam';
            $currency = Currancy::all();
            return view('Student.Exam.Exam_Package', 
            compact('package', 'categories', 'courses', 'module', 'currency'));
             
            
        }
    }

    public function e_package(){
        
        $package = [];
        $courses = Course::get();
        $categories = Category::get();
        $module = 'Exam';
        $currency = Currancy::all();

        return view('Student.Exam.Exam_Package', 
        compact('package', 'courses', 'categories', 'module', 'currency'));
    }

    public function filter_package(Request $request){
        $package = Package::
        where('module', $request->module)
        ->where('course_id', $request->course_id)
        ->get();
        $courses = Course::get();
        $categories = Category::get();
        $module = $request->module;
        $data = $request->all();
        $currency = Currancy::all();

        return view('Student.Exam.Exam_Package', 
        compact('package', 'courses', 'categories', 'module', 'data', 'currency'));
    }

    public function exam_ans( $id, Request $req )
    { 
        $timer_val = json_decode(Cookie::get('timer'));
        $exam = Exam::where('id', $id)
        ->first();
        $report_v = ReportVideoList::all();
        $deg = 0;
        $mistakes = [];
        $total_question = 0;
        if ( isset($req->q_answers) ) {
            foreach ( $req->q_answers as $item ) {
                $total_question++;
                $mcq_item = json_decode($item);
                $question = Question::where('id', $mcq_item->q_id)
                ->first();

                $stu_solve = @$question->mcq[0]->mcq_answers;
                $arr = ['A', 'B', 'C', 'D']; 
                if ( isset($mcq_item->answer) && $stu_solve == $mcq_item->answer ) {
                    $deg++;
                } else {
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
                $answer = isset($req->q_grid_ans[$i]) ? $req->q_grid_ans[$i]: '0';
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

        if (empty($stu_q)) {
            $stu_exam = ExamHistory::create([
                'date' => now(),
                'user_id' => auth()->user()->id,
                'diagnostic_exams_id' => $exam->id,
                'score' => $score,
                'time' => $timer_val, 
                'r_questions' => $right_question,
                'exam_id' => $exam->id,
            ]);

            foreach ($mistakes as $item) {
                ExamMistake::create([
                    'student_exam_id' => $stu_exam->id,
                    'question_id' => $item->id
                ]);
            }
        }

        return view('Visitor.Exam.Grade', compact('deg', 'grade', 'score', 'exam', 
        'right_question', 'total_question', 'mistakes', 'report_v'));
    }
    
    public function exam_history(){
        
    }

    public function api_timer( Request $req ){
        Cookie::queue(Cookie::forget('timer'));
        Cookie::queue('timer', $req->timer_val, 1);
       $timerValue = $req->timer_val;
            session_destroy();
       session(['timer' => $timerValue]);

       return response()->json([
       'message' => 'Timer session updated successfully',
       'timer' => session('timer_val')
       ]);
    }

}
