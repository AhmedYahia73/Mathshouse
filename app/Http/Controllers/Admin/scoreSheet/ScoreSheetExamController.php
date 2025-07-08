<?php

namespace App\Http\Controllers\Admin\scoreSheet;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PaymentRequest;
use App\Models\Question;
use App\Models\ExamHistory;
use App\Models\Exam;
use App\Models\LiveCourse;
use App\Models\ExamCodes;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ScoreSheetExamController extends Controller
{
    // This Is Controller About All Reports Of Exams
    public function __construct(
        private PaymentRequest $paymentRequest,
        private Question $question,
        private Course $courses,
        private ExamHistory $exam_history,
        private LiveCourse $stu_course,
        private ExamCodes $exam_codes,
        private Exam $exam,
        ){}

   
    public function index(User $user){
        // This Function Return View Of Score Sheet Exam
        if(!$user){
            session()->flash('error','User Not Found');
        return redirect()->back();
        }
        // $course_ids = auth()->user()->courses_live->pluck('id');
        $courses = $this->courses
        ->get();
        $years = range(2000, date('Y'));
        $months = range(1, 12);
        $exam_codes = $this->exam_codes
        ->get();

        $exam_history = $this->exam_history
        ->where('user_id', $user->id)
        ->get();
        $stu_course = $this->stu_course
        ->where('user_id', $user->id)
        ->orderByDesc('id')
        ->first();
        if (!empty($stu_course)) {
            $stu_course = $stu_course->course;
        }

        return view('Admin.scoreSheet.scoreSheetExam',
        compact('user', 'courses', 'exam_history', 'stu_course', 'years', 'months', 'exam_codes'));
    }

    public function filter_exams(Request $request){
        // /api/filter_exams
        // user_id, year, month, exam_code_id
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'course_id' => 'exists:courses,id',
            'year' => 'numeric', 
            'month' => 'numeric', 
            'exam_code_id' => 'exists:exam_codes,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $exams = $this->exam; 
        if (!empty($request->year)) { 
            $exams = $exams->where('year', $request->year);
        }
        if (!empty($request->month)) {
            $exams = $exams->where('month', $request->month);
        }
        if (!empty($request->exam_code_id)) {
            $exams = $exams->where('code_id', $request->exam_code_id);
        }
        if (!empty($request->course_id)) {
            $exams = $exams->where('course_id', $request->course_id);
        }
        $exams_ids = $exams->pluck('id');
        $exam_history = $this->exam_history
        ->with('exams:id,title')
        ->where('user_id', $request->user_id)
        ->whereIn('exam_id', $exams_ids)
        ->get();

        return response()->json([
            'exam_history' => $exam_history
        ]);
    }
   
    public function show(User $user){
       url : http://maths-house.test/Admin/Report/ScoreSheet/get/courseExam/{user}
    // URL : name of the route : course_exam
   
     $paymentRequest = $this->paymentRequest->where('user_id',$user->id)
     ->with('order','order.course','order.course.exams')
     ->get();
        return response()->json([
            'success'=>'data returned Successfully',
            'data'=>$paymentRequest
        ]);
    }

     public function generateExamPdf(Request $request){
        // This Function Generate PDF Of Score Sheet Exam
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'exam_history_id' => 'required|array',
            'exam_history_id.*' => 'required|exists:exam_history,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $exam_history = $this->exam_history  
        ->whereIn('id', $request->exam_history_id)
        ->with(['mistakes.question' => function($query){
            return $query->with(['mcq', 'q_ans', 'g_ans']);
        }])
        ->get();
        $questions = $exam_history
        ->flatMap(function ($history) {
            return $history->mistakes->pluck('question');
        });
        $questions = $questions->unique('id')->values();
        $user = User::where('id', $request->user_id)
        ->first(); 
        $pdf_name =  'Questions ' . ( $questions->count()) . ' for ' .  $user->f_name . ' ' . $user->l_name;
        $pdf = Pdf::loadView('questions', compact('questions', 'user'))
        ->setPaper('a4', 'landscape');
        return $pdf->download($pdf_name . '.pdf');
    
    }
    
    public function generateExamAnsPdf(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'exam_history_id' => 'required|array',
            'exam_history_id.*' => 'required|exists:exam_history,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $exam_history = $this->exam_history  
        ->whereIn('id', $request->exam_history_id)
        ->with(['mistakes.question' => function($query){
            return $query->with(['mcq', 'q_ans', 'g_ans']);
        }])
        ->get();
        $questions = $exam_history
        ->flatMap(function ($history) {
            return $history->mistakes->pluck('question');
        });
        $questions = $questions->unique('id')->values();
        $user = User::where('id', $request->user_id)
        ->first(); 
        $pdf_name =  'Ans - Questions ' . ( $questions->count()) . ' for ' .  $user->f_name . ' ' . $user->l_name;
        $pdf = Pdf::loadView('questions_answers', compact('questions', 'user'))
        ->setPaper('a4', 'landscape');
        return $pdf->download($pdf_name . '.pdf');
    }
}
