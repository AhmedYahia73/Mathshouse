<?php

namespace App\Http\Controllers\Admin\scoreSheet;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\PaymentRequest;
use App\Models\Question;
use App\Models\ExamHistory;
use App\Models\LiveCourse;
use App\Models\User;
use Illuminate\Http\Request;

class ScoreSheetExamController extends Controller
{
    // This Is Controller About All Reports Of Exams
    public function __construct(
        private PaymentRequest $paymentRequest,
        private Question $question,
        private Course $courses,
        private ExamHistory $exam_history,
        private LiveCourse $stu_course,
        ){}

   
    public function index(User $user){
        // This Function Return View Of Score Sheet Exam
        if(!$user){
            session()->flash('error','User Not Found');
        return redirect()->back();
        }
        $courses = $this->courses
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
        compact('user', 'courses', 'exam_history', 'stu_course'));
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

     public function generatePdf(Request $reqeust){
            // This Function Generate PDF Of Score Sheet Exam
            $user = User::find($reqeust->user_id);
            $questionsIds = is_string($reqeust->questions) ? json_decode($reqeust->questions):$reqeust->questions;
            $questions = $this->question->whereIn('id',$questionsIds)->get();
            $exams = $questions->exam_questions;
            return view('Admin.scoreSheet.scoreSheetExamPdf',compact('user','questions','exams'));

    }
}
