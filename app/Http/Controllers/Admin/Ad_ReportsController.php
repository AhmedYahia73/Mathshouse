<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use App\Models\SessionAttendance;
use App\Models\User;
use App\Models\PaymentRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\ExamCodes;
use App\Models\ExamHistory;
use App\Models\Exam;
use App\Models\StudentQuizze;
use App\Models\ReportVideoList;
use App\Models\quizze;

class Ad_ReportsController extends Controller
{
     public function __construct(
        private PaymentRequest $paymentRequest,
        private Exam $exam,
        private Question $question,
        private quizze $quizzes
     ){}
    public function ad_live_report( Request $req )
    {
        $query = SessionAttendance::query();
    
        if (!empty($req->from)) {
            $query->whereDate('created_at', '>=', $req->from);
        }
    
        if (!empty($req->to)) {
            $query->whereDate('created_at', '<=', $req->to);
        }
    
        $students = $query->simplePaginate(10)->appends($req->all());
        $stu_count = $query->get();
        
        return view('Admin.Reports.Live.Live', compact('students', 'stu_count'))->with('data', $req->all());
    }

    public function ad_grade_report( Request $req ){
        $data = $req->all();
        if ( !empty($req->grade)) {
            $students = User::where('grade', $req->grade)
            ->where('position', 'student')
            ->simplePaginate(10);
            $stu_count = User::where('grade', $req->grade)
            ->where('position', 'student')
            ->get();
        } else {
            $students = User::where('position', 'student')
            ->simplePaginate(10);
            $stu_count = User::where('position', 'student')
            ->get();
        }
        

        return view('Admin.Reports.Grade.Grade', compact('students', 'data', 'stu_count'));
    }

    public function ad_payment_report( Request $req ){
        if ( !empty($req->from) && empty($req->to) ) {
            $payment = PaymentRequest::
            where('state', 'Approve')
            ->where('module', 'Chapters')
            ->where('created_at', '>=', $req->from)
            ->get();
        }
        elseif ( empty($req->from) && !empty($req->to) ) {
            $payment = PaymentRequest::
            where('state', 'Approve')
            ->where('module', 'Chapters')
            ->where('created_at', '<=', $req->to)
            ->get();
        }
        elseif ( !empty($req->from) && !empty($req->to) ) {
            $payment = PaymentRequest::
            where('state', 'Approve')
            ->where('module', 'Chapters')
            ->where('created_at', '>=', $req->from)
            ->where('created_at', '<=', $req->to)
            ->get();
        }
        else{
            $payment = PaymentRequest::
            where('state', 'Approve')
            ->where('module', 'Chapters')
            ->get();
        }
        $data = $req->all();

        return view('Admin.Reports.Payment.Payment', compact('data', 'payment'));
    }
    
    public function ad_course_report( Request $req ){
        $data = $req->all();
        $payment_req = PaymentRequest::
        where('module', 'Chapters')
        ->where('state', 'Approve')
        ->with('user')
        ->get();
        $payment = [];
        if ( !empty($req->course_id) ) {
            foreach ( $payment_req as $item ) {
                foreach ( $item->chapters_order as $element ) { 
                    if ( $element->chapter->course_id == $req->course_id ) {
                        $item->course = $element->chapter->course->course_name;
                        $payment[$item->user_id] = $item;
                    }
                }
            }
        }
        else {
            foreach ( $payment_req as $item ) {
                foreach ( $item->chapters_order as $element ) {
                    $item->course = $element->chapter->course->course_name;
                    $payment[$item->user_id . ' ' . $element->chapter->course_id] = $item;
                }
            }
        }
        $categories = Category::all();
        $courses = Course::all();

        return view('Admin.Reports.Course.Course', 
        compact('data', 'payment', 'categories', 'courses'));
    }

    public function ad_exam_report( Request $req ){
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $questions = Question::
        orderByDesc('id')
        ->get();
        $exam_items = Exam::get();
        $exams = ExamCodes::all();

        return view('Admin.Reports.Exam.Exam', 
        compact('categories', 'courses', 'chapters', 'lessons', 'questions', 'exams', 'exam_items'));
    
    }

    public function ad_report_filter_exam( Request $req ){
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all(); 
        $exams = ExamCodes::all();
        $exam_items = Exam::get();
        $filter = true;

        if (isset($req->exam_id)) {
            $exam = Exam::where('id', $req->exam_id)
            ->first();
            $questions = $exam->question->pluck('id');

            $data = Question::
            select('*', 'questions.id AS q_id')
            ->leftJoin('lessons', 'questions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->whereIn('questions.id', $questions)
            ->get();
        }
        else {
            $data = Question::
            select('*', 'questions.id AS q_id')
            ->leftJoin('lessons', 'questions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->get();
        }
        
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
        if (isset($req->month)) {
            $questions = [];
            foreach($data as $item){
                if ( $item->month == $req->month ) {
                    $questions[] = $item;
                }
            }
            $data = $questions;
        }
        $data = $req->all();

        return view('Admin.Reports.Exam.Exam', 
        compact('categories', 'courses', 'chapters', 'filter', 'lessons', 
        'questions', 'exams', 'data', 'exam_items'));
    }

    public function ad_score_sheet_report( Request $req ){
        $students = User::where('position', 'student')
        ->get();

        return view('Admin.Reports.ScoreSheet.ScoreSheet', compact('students'));
    }

    public function score_sheet_student( $user_id ){
        $lessons = Lesson::all();
        $chapters = Chapter::all();
        $courses = Course::all();
        $student = User::where('id', $user_id)->first();

        return view('Admin.Reports.ScoreSheet.Student_ScoreSheet', 
        compact('lessons', 'chapters', 'courses', 'student', 'user_id'));
    } 

    // Start Genrate PDF 
    // public function generate_pdf($user_id, $lesson_id){
    //     $data = StudentQuizze::where('student_id', $user_id)
    //     ->where('lesson_id', $lesson_id)
    //     ->with('quizze',function($query){
    //         $query->with('question', function($query){
    //             $query->with('mcq')->with('q_ans')->with('g_ans');
    //         });
    //     })->get();
    //     $arr = [];

    //     foreach ( $data as $item ) {
    //         $arr[$item->quizze_id] = $item;
    //     }

    //     $pdf = PDF::loadView('Admin.Reports.ScoreSheet.Student_ScoreSheet_Pdf', compact('arr'));
    //     return $pdf->download('ScoreSheet.pdf');
    // }
    // End Genrate PDF
    public function ad_lesson_score_sheet( Request $req ) {
        // lesson_id, chapter_id, course_id
        $lessons = [];
        if ($req->lesson_id && !empty($req->lesson_id)) {
            $lessons = collect([$req->lesson_id]);
        }
        elseif ($req->chapter_id && !empty($req->chapter_id)) {
            $lessons = Lesson::
            where('chapter_id', $req->chapter_id)
            ->pluck('id');
        }
        elseif ($req->course_id && !empty($req->course_id)) {
            $lessons = Chapter::
            where('course_id', $req->course_id)
            ->with('lessons')
            ->get();
            $lessons = $lessons->pluck('lessons.id');
        }
        $data = StudentQuizze::
        where('student_id', $req->user_id)
        ->whereIn('lesson_id', $lessons)
        ->with('quizze',function($query){
            $query->with('question', function($query){
                $query->with('mcq')->with('q_ans')->with('g_ans');
            });
        })->get();
        $arr = [];

        foreach ( $data as $item ) {
            $arr[$item->quizze_id] = $item;
        }
        
        return response()->json([
            'data' => array_values($arr)
        ]);
    }

    public function ad_score_sheet_mistake( $id ){
        $mistakes = StudentQuizze::where('id', $id)
        ->first();
        $questions = $mistakes->questions;

        return view('Admin.Reports.ScoreSheet.Quiz.Quiz_Mistakes', compact('mistakes', 'questions'));
    }

    public function ad_score_exam_mistake( $id ){
        $mistakes = ExamHistory::where('id', $id)
        ->first();
        $questions = $mistakes->mistakes;

        return view('Admin.Reports.ScoreSheet.Exam.Exam_Mistakes', compact('mistakes', 'questions'));
    }

    public function ad_score_question_answer( $id ){
        if ( empty(auth()->user()) ) {
            if ( !session()->has('previous_page') ) {
                session(['previous_page' => url()->current()]);
            }
            return redirect()->route('login.index');
        }
        else{  
            $reports = ReportVideoList::all();
            $question = Question::where('id', $id)
            ->first();

            return view('Admin.Reports.ScoreSheet.Quiz.Question_Ans', compact('question', 'reports')); 
    
        } 
    }
 

    public function ad_question_parallel($id){
        $question = Question::where('id', $id)
            ->first();
        $q_parallel = Question::where('month', $question->month)
            ->where('year', $question->year)
            ->where('section', $question->section)
            ->where('q_num', $question->q_num)
            ->where('lesson_id', $question->lesson_id)
            ->where('q_code', $question->q_code)
            ->where('q_type', '!=', 'Extra')
            ->where('id', '!=', $id)
            ->get();

        return view('Admin.Reports.ScoreSheet.Quiz.Parallel_Question', compact('q_parallel'));
    }

    public function ad_solve_parallel($id, Request $req)
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
        
        return view('Admin.Reports.ScoreSheet.Quiz.Solve_Parallel', compact('grade', 'question'));
    }

    
    public function generatePdf(Request $request) {
        
        $user = User::find($request->user_id);
        $questionsIds = is_string($request->selected_ids) ? json_decode($request->selected_ids): $request->selected_ids;
        $questions = $this->quizzes
        ->whereIn('id', $questionsIds)
        ->with(['question' => function($query){
            $query->with(['mcq', 'q_ans', 'g_ans']);
        }])->get();
        $questions = $questions->pluck('question');
        $answers = [];
        $questions = count($questions) > 0 ?$questions[0]:$questions;
        foreach ($questions as $question) {
            if ($question->ans_type == 'MCQ') {
                $answers[] = $question->mcq;
            } elseif ($question->ans_type == 'Grid') {
                $answers[] = $question->q_ans;
            }
        }
        $pdf = Pdf::loadView('questions', compact('questions', 'answers'));
        return $pdf->setPaper('a4', 'landscape')->stream('questions.pdf');
    }

}
