<?php

namespace App\Http\Controllers\Student;

use Illuminate\Support\Facades\Cookie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Marketing;
use App\Models\PaymentRequest;
use App\Models\PaymentOrder;
use App\Models\quizze;
use App\Models\QuizzeStuAns;
use App\Models\StudentQuizze;
use App\Models\StudentQuizzeMistake;
use App\Models\Question;
use App\Models\Mcq_ans;
use App\Models\Chapter;
use App\Models\PaymentPackageOrder;
use App\Models\User;
use App\Models\Package;
use App\Models\SmallPackage;
use App\Models\ReportVideoList;
use App\Models\ReportVideo;
use App\Models\ReportQuestionList;
use App\Models\ReportQuestion;
use App\Models\Category;
use App\Models\Course;
use App\Models\Currancy;

use Carbon\Carbon;
use Carbon\CarbonInterval;

class Stu_MyCourseController extends Controller
{
    public function index()
    {
        $payment_request = PaymentRequest::where('user_id', auth()->user()->id)
            ->where('state', 'Approve')
            ->orderByDesc('id')
            ->get();
        $courses = [];
        foreach ($payment_request as $item) {
            foreach ($item->order as $value) {
                $courses[$value->course->course_name] = $value->course;
            }
        }
        return view('Student.MyCourses.MyCourses', compact('courses'));
    }

    public function courses()
    {
        $courses = Marketing::where('student_id', auth()->user()->id)
            ->where('course_id', '!=', null)
            ->orderBy('course_id')
            ->get();
        return view('Student.MyCourses.Courses', compact('courses'));
    }

    public function chapters()
    {
        $chapters = Marketing::where('student_id', auth()->user()->id)
            ->where('chapter_id', '!=', null)
            ->orderBy('chapter_id')
            ->get();
        return view('Student.MyCourses.Chapters', compact('chapters'));
    }

    public function stu_chapters($id)
    {
        // New Code
        $payment_order = PaymentOrder::where('state', 1)
        ->with('chapter')
        ->with('pay_req')
        ->orderByDesc('id')
        ->get();

        $chapters = [];
        foreach ($payment_order as $item) {
            $newTime = Carbon::now()->subDays($item->duration);
            if ( $newTime > $item->date && $item->pay_req->user_id == auth()->user()->id ) {
                $chapters[$item->chapter_id] = $item;
            }
        }
        $course_id = $id;

        return view('Student.MyCourses.Chapters_Working', compact('chapters', 'course_id'));
    }

    public function stu_lessons($id, $L_id, $idea_num)
    {
        $reports = ReportVideoList::all();
        $payment_order = PaymentOrder::where('state', 1)
        ->with('chapter')
        ->with('pay_req')
        ->orderByDesc('id')
        ->get();

        $chapters = [];
        $chapter_state = false;
        foreach ($payment_order as $item) {
            $newTime = Carbon::now()->subDays($item->duration);
            if ( $newTime > $item->date && $item->pay_req->user_id == auth()->user()->id && $item->chapter_id == $id ) {
                $chapter_state = true;
            }
        }
        $course_id = $id;
        $payment_request = [];
        if ($chapter_state) {
            $payment_request = PaymentRequest::where('user_id', auth()->user()->id)
                ->where('state', 'Approve')
                ->orderByDesc('id')
                ->get();
        }
        $chapter_id = $id;  
        return view('Student.MyCourses.Lessons', 
        compact('payment_request', 'chapter_id', 'L_id', 'idea_num', 'reports'));

    }

    public function quizze_ques_ans( $id ){
        $question = Question::where('id', $id)
        ->first();
        if ( empty(auth()->user()) ) {
            if ( !Cookie::get('previous_page') ) {
                Cookie::queue(Cookie::make('previous_page', url()->current(), 90));
            }
            return redirect()->route('login.index');
        }
        else{  
            $reports = ReportVideoList::all();
            $payments = PaymentPackageOrder::
            where('state', 1)
            ->where('user_id', auth()->user()->id)
            ->with('pay_req')
            ->with('package')
            ->orderByDesc('id')
            ->get();
            $user = User::where('id', auth()->user()->id)
            ->first();

            foreach ( $payments as $item ) { 
                $newTime = Carbon::now()->subDays($item->package->duration);
                $question = Question::where('id', $id)
                ->first();

                if ( $item->package->module == 'Question' && 
                $item->pay_req->user_id == auth()->user()->id &&
                $item->date >= $newTime &&
                $item->number > 0
                 ) 
                 {  

                    PaymentPackageOrder::where('id', $item->id)
                    ->update([
                        'number' => $item->number - 1
                    ]);
                    return view('Student.Question_History.Question_Ans', compact('question', 'reports')); 
                }
            } 
            $package = Package::
            where('module', 'Question')
            ->where('course_id', $question->lessons->chapter->course_id)
            ->get();
            $categories = Category::get();
            $courses = Course::get();
            $module = 'Question';
            $currency = Currancy::all();
 
            Cookie::queue(Cookie::make('q_ans_id', $id, 90));
            return view('Student.Exam.Exam_Package', 
            compact('package', 'categories', 'courses', 'module', 'currency')); 
        }
    }

    public function stu_quizze($quizze_id)
    {
        if ( empty(auth()->user()) ) {
            if ( !Cookie::get('previous_page') ) {
                Cookie::queue(Cookie::make('previous_page', url()->current(), 90));
            }
            return redirect()->route('login.index');
        }
        else{  
            $reports = ReportQuestionList::all();
            $user = User::where('id', auth()->user()->id)
            ->first();
            // Return Exam
            $quizze = quizze::where('id', $quizze_id)
            ->first();
            if ( empty($quizze->pass_score) ) {
                $quizze->pass_score = 0;
            }
            $stu_quizze = StudentQuizze::where('student_id', auth()->user()->id)
            ->where('score', '>=', $quizze->pass_score)
            ->with('quizze')
            ->get();

            $solve_quizze = StudentQuizze::where('student_id', auth()->user()->id)
            ->where('score', '>=', $quizze->pass_score)
            ->where('quizze_id', $quizze->id)
            ->first();

            if ( !empty($solve_quizze) ) {
                session()->flash('faild', 'You Solved this quiz before.');
                return redirect()->back();
            }

            $last_quiz = quizze::where('lesson_id', $quizze->lesson_id )
            ->where('quizze_order', '<',$quizze->quizze_order)
            ->orderByDesc('quizze_order')
            ->first();
            $quiz_item = 0;
            foreach ($stu_quizze as $item) {
                if ($item?->quizze?->quizze_order > $quiz_item && 
                $item->quizze->lesson_id == $quizze->lesson_id &&
                $item->score >= $quizze->pass_score ) {
                    $quiz_item = $item->quizze->quizze_order;
                }
            }
            $next_quiz = quizze::where('lesson_id', $quizze->lesson_id )
            ->where('quizze_order', '>',$quiz_item)
            ->orderBy('quizze_order')
            ->first();
            
            if ( $quizze->quizze_order > $next_quiz->quizze_order ) {
                session()->flash('faild', 'You Must Pass Last Quiz First');
                return redirect()->back();
            }

            return view('Student.MyCourses.Quizze', compact('quizze', 'reports'));
        }
    }

    public function quizze_ans(Request $req)
    {
        $timer_val = Cookie::get('timer');
        $timer_val = empty($timer_val) ? '00:00:00' : $timer_val;
        $quizze_id = json_decode($req->quizze)->id;
        $quizze = quizze::where('id', $quizze_id)
        ->first();
        
        
        // Parse quiz time
        $exam_time_parts = explode(':', empty($quizze->time) || $quizze->time == null? '00:00:00' : $quizze->time);
        $e_hours = isset($exam_time_parts[0]) ? intval($exam_time_parts[0]) : 0;
        $e_minutes = isset($exam_time_parts[1]) ? intval($exam_time_parts[1]) : 0;
    
        // Parse data time
        $data_time = explode(':', $timer_val);
        $hours = isset($data_time[0]) ? intval($data_time[0]) : 0;
        $minutes = isset($data_time[1]) ? intval($data_time[1]) : 0;
        $seconds = isset($data_time[2]) ? intval($data_time[2]) : 0;
    
        // Calculate the times in seconds
        $e_time = $e_hours * 60 * 60 + $e_minutes * 60;
        $time = $hours * 60 * 60 + $minutes * 60 + $seconds;
        $delay = $e_time - $time;

        // Determine delay status
        if ($delay == 0) {
            $delay = 'On Time';
        } else {
            $color = $delay > 0 ? true : false;  
            if ($color) {
                $h = intval($delay / (60 * 60));
                $delay = $delay - $h * 60 * 60;
                $m = intval($delay / 60);
                $s = $delay - $m * 60;        
                $delay = "-$h Hours -$m Minutes -$s Seconds";
            }
            else{ 
                $h = intval($delay / (60 * 60));
                $delay = $delay - $h * 60 * 60;
                $m = intval($delay / 60);
                $s = $delay - $m * 60;        
                $delay = abs($h) . " Hours " . abs($m) . " Minutes " . abs($s) . "Seconds";
            }
        }
 
        $deg = 0;
        $mistakes = [];
        $total_question = 0;
        if ( isset($req->q_answers) ) {
            foreach ( $req->q_answers as $item ) {
                $total_question++;
                $mcq_item = json_decode($item);
                $question = Question::where('id', $mcq_item->q_id)
                ->first();


                $stu_solve = isset($question->mcq[0]) &&  isset($question->mcq[0]->mcq_answers) ? $question->mcq[0]->mcq_answers : null;
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
                $answer = $req->q_grid_ans[$i];
                if ( strpos($answer, '/') ) {
                    $arr_ans = explode('/', $answer);
                    if (floatval($arr_ans[1]) == 0) {
                        $answer = 0;
                    } else {
                        $answer = floatval($arr_ans[0]) / floatval($arr_ans[1]);
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
        $deg =  $deg / $total_question * 100;
        $deg = round($deg, 2);
        $score = ($quizze->score / $total_question) * $right_question;

        $stu_q = StudentQuizze::where('student_id', auth()->user()->id)
            ->where('quizze_id', $req->quizze_id)
            ->first();

        $stu_quizze = StudentQuizze::create([
            'date' => now(),
            'lesson_id' => $quizze->lesson_id,
            'quizze_id' => $quizze->id,
            'student_id' => auth()->user()->id,
            'score' => $score,
            'time' => $timer_val,
            'r_questions' => $right_question,
        ]);
        $quize_id = $stu_quizze->id;

        foreach ($mistakes as $item) {
            StudentQuizzeMistake::create([
                'student_quizze_id' => $quize_id,
                'question_id' => $item->id
            ]);
        }

        $report_v = ReportVideoList::all();

        return view('Student.MyCourses.Grade', 
        compact('deg', 'quize_id', 'quizze', 'right_question', 
        'total_question', 'mistakes', 'report_v', 'delay', 'color'));
    }

    public function question_parallel($id)
    {
        $question = Question::where('id', $id)
            ->first();
        $q_parallel = Question::where('month', $question->month)
            ->where('year', $question->year)
            ->where('section', $question->section)
            ->where('q_num', $question->q_num)
            ->where('q_code', $question->q_code)
            ->where('lesson_id', $question->lesson_id)
            ->where('id', '!=', $id)
            ->get();

        return view('Student.MyCourses.Parallel_Question', compact('q_parallel'));
    }

    public function solve_parallel($id, Request $req)
    {
        $question = Question::where('id', $id)
            ->first();
        $grade = false;
        if ($question->ans_type == 'MCQ') {
            if ($question->mcq[0]->mcq_answers == $req['ans' . $id]) {
                $grade = true;
            }
        } else {
            if ($question->g_ans[0]->grid_ans == $req['ans' . $id]) {
                $grade = true;
            }
        }
        
        return view('Student.MyCourses.Solve_Parallel', compact('grade', 'question'));
    }

    public function quizze_history()
    {
        $history = StudentQuizze::where('student_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();
        foreach ($history as  $item) {

            if ($item->time == null || !empty($item->time)) {
                $item->time = '00:00:00';
            }
            // Assume input format is 'H:i:s', e.g., '01:00:00' and '00:10:00'
            // Retrieve quiz period and solve period from the request
            $quizPeriod = Carbon::createFromTimeString($item->quizze->time);
            $solvePeriod = Carbon::createFromTimeString($item->time);

            // Define the two times
            $time1 = $quizPeriod;
            $time2 = $solvePeriod;

            // Subtract the times
            $diff = $time1->diff($time2);

            // Format the difference in hours, minutes, and seconds
            $hours = $diff->h;
            $minutes = $diff->i;
            $seconds = $diff->s;

            // Output the result as H:i:s
            $formattedDiff = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            if ( $time1 > $time2 ) {
                $item->delay = '-' . $formattedDiff;
            } else {
                $item->delay = '+' . $formattedDiff;
            }
            
            
        }

        return view('Student.MyCourses.History', compact('history'));
    }

    public function quizze_mistakes( $id ){
        $mistakes = StudentQuizze::
        where('student_id', auth()->user()->id)
        ->where('id', $id)
        ->first();
        $questions = $mistakes->questions;

        return view('Student.MyCourses.Quiz_Mistakes', compact('mistakes', 'questions'));
    }

    public function buy_chapter( $id ){
        
        $chapters = Chapter::where('id', $id)
        ->first(); 
        
        $prices = $chapters->price;
        $min = $prices[0];
        foreach ($prices as $key => $price) {
            if ( $min->price > $price->price ) {
                $min = $price;
            }
        }
        $chapters_price = $min->price;
        $chapter_discount = $min->price - ($min->price * $min->discount / 100);
        $chapters->ch_price = $chapters_price;
        $ch = json_encode([$chapters]);
        Cookie::queue('marketing', $ch, 10000);
        Cookie::queue('chapters_price', $chapters_price, 10000); 
        if ( empty(auth()->user()) ) {
            return view('Visitor.Login.login');
        }
        else{
            $chapters = [$chapters];
            return view('Visitor.Cart', compact('chapters', 'chapters_price', 'chapter_discount'));
        }
    }

    public function dia_buy_chapters( Request $req ){
        $ids = json_decode($req->ids);
        $chapters = Chapter::whereIn('id', $ids)
        ->get();
        $chapters_price = 0;
        $price_arr = [];
        $chapter_discount = 0;
        
        
        foreach ($chapters as $key => $chapter) {
            $prices = $chapter->price;
            $min = $prices[0];
            foreach ($prices as $key => $price) {
                if ( $min->price > $price->price ) {
                    $min = $price;
                }
            }
            $chapters_price+= $min->price;
            $price_arr[] = $min;
            $chapter_discount += $min->price - ($min->price * $min->discount / 100);
        }
        Cookie::queue('marketing', json_encode($chapters), 10000);
        Cookie::queue('chapters_price', $chapters_price, 10000);
        Cookie::queue('price_arr', json_encode($price_arr), 10000);
         
        if ( empty(auth()->user()) ) {
            return view('Visitor.Login.login');
        }
        else{
            $chapters = $chapters;
            return view('Visitor.Cart', compact('chapters', 'chapters_price', 'price_arr', 'chapter_discount'));
        }
    }

    public function report_video_api( Request $req ){
        $arr = [
            'date' => now(),
            'user_id' => auth()->user()->id,
            'lesson_video_id' => intval($req->obj['lesson_video_id']),
            'list_id' => intval($req->obj['list_id']),
            'statues' => 'Pendding'
        ];
        ReportVideo::create( $arr );

        return response()->json([
            'success' => 'You Report Video Success'
        ]);
    }

    public function report_video_q_api( Request $req ){
        $arr = [
            'date' => now(),
            'user_id' => auth()->user()->id,
            'q_video_id' => intval($req->obj['lesson_video_id']),
            'list_id' => intval($req->obj['list_id']),
            'statues' => 'Pendding'
        ];
        ReportVideo::create( $arr );

        return response()->json([
            'success' => 'You Report Video Success'
        ]);
    }

    public function report_q_video_api( Request $req ){
        $arr = [
            'date' => now(),
            'user_id' => auth()->user()->id,
            'q_video_id' => intval($req->obj['q_video_id']),
            'list_id' => intval($req->obj['list_id']),
            'statues' => 'Pendding'
        ];

        ReportVideo::create( $arr );
    }


    public function api_report_question( Request $req ){

        ReportQuestion::create([
            'date' => now(),
            'user_id' => auth()->user()->id,
            'question_id' => $req['question_id'],
            'list_id' => $req['list_id'],
            'statues' => 'pendding',
        ]);

        return response()->json([
            'success' => 'You Make Report success'
        ]);
    }

    
    
}
