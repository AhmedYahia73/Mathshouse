<?php

namespace App\Http\Controllers\Api\User\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\Course;
use App\Models\ExamCodes;
use App\Models\Exam;
use App\Models\ReportQuestionList;
use App\Models\PaymentPackageOrder;
use App\Models\SmallPackage;
use App\Models\ScoreList;
use App\Models\ExamHistory;
use App\Models\ExamMistake;
use App\Models\Lesson;

class ExamController extends Controller
{
    public function __construct(private Course $course,
    private ExamCodes $exams_code, private Exam $exam,
    private ReportQuestionList $question_report,
    private PaymentPackageOrder $payment_packag_order,
    private SmallPackage $small_package, private ScoreList $score_list,
    private ExamHistory $exam_history, private ExamMistake $exam_mistakes,
    private Lesson $lesson){}

    public function lists(Request $request){
        $courses = $this->course
        ->select('id', 'course_name')
        ->where('category_id', $request->user()->category_id)
        ->get();
        $exams_code = $this->exams_code
        ->select('id', 'exam_code')
        ->get();

        return response()->json([
            'courses' => $courses,
            'exams_code' => $exams_code,
        ]);
    }

    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'exists:courses,id',
            'year' => 'numeric',
            'month' => 'numeric', 
            'code_id' => 'exists:exam_codes,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $exams = $this->exam
        ->select('id', 'title', 'year', 'month', 'type', 'code_id')
        ->with('code:id,exam_code');
        if($request->course_id){
            $exams = $exams
            ->where('course_id', $request->course_id);
        }
        if($request->year){
            $exams = $exams
            ->where('year', $request->year);
        }
        if($request->month){
            $exams = $exams
            ->where('month', $request->month);
        }
        if($request->code_id){
            $exams = $exams
            ->where('code_id', $request->code_id);
        }
        $exams = $exams->get();

        return response()->json([
            'exams' => $exams
        ]);
    }

    public function solve_exam(Request $request, $id){
        $reports = $this->question_report
        ->get();
        $exam = $this->exam
        ->where('exam.id', $id)
        ->with(['question' => function($query){
            $query->select('questions.id', 'question', 'ans_type', 'q_url')
            ->with(['mcq:id,mcq_num,q_id']);
        }])
        ->first();
        $questions = $exam?->question;
 
        $payments = $this->payment_packag_order
        ->where('state', 1)
        ->with('pay_req', 'package')
        ->get();
        $user = $request->user()->id;

        $small_package = $this->small_package
        ->where('user_id', auth()->user()->id)
        ->where('module', 'Exam')
        ->where('course_id', $exam->course_id)
        ->where('number', '>', 0)
        ->first();

        if ( !empty($small_package) ) { 
            $small_package->number--;
            $small_package->save();
            
            return response()->json([
                'exam' => $questions,
                'reports' => $reports,
            ]);
        }

        foreach ( $payments as $item ) { 
            $newTime = Carbon::now()->subDays($item->package->number);
            if ( $item->package->module == 'Exam' && 
            $item->pay_req->user_id == auth()->user()->id &&
            $item->date > $newTime &&
            $item->number > 0
            && $item->package->course_id == $exam->course_id 
                ) 
                {  
                $newTime = Carbon::now()->subDays($item?->package?->number);

                $this->payment_packag_order
                ->where('id', $item->id)
                ->update([
                    'number' => $item->number - 1
                ]);
                return response()->json([
                    'exam' => $questions,
                    'reports' => $reports,
                ]);
            }
        } 
        
        return response()->json([
            'errors' => 'You must buy package',
            'course_id' => $exam->course_id,
        ], 400);
    }

    public function grade_exam(Request $request){ 
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'timer' => 'required',
            'exam_id' => 'required|exists:exam,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $score = 0; 
        $total = count($request->answers);
        $mistakes = [];
        $iter = 0;
        $answer = $request->answers;
        $exam = $this->exam
        ->where('id', $request->exam_id)
        ->with(['question' => function($query){
            $query->select('questions.id', 'question', 'ans_type', 'q_url', 'lesson_id')
            ->with(['mcq', 'g_ans']);
        }])
        ->first(); 
        $questions = $exam?->question;
		$total_question = $questions->count();
        $pass_score = $exam->pass_score;
        $exam_name = $exam->title;
        foreach ($questions as $item) {
            $question = $item;
            if ($question->ans_type == 'MCQ') {
                $q_answer = $question->mcq;
                if($q_answer->count() > 0 && isset($answer[$iter]) && $q_answer[0]->mcq_answers == $answer[$iter++]){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            }
            else {
                $q_answer = $question->g_ans; 
                if($q_answer->count() > 0 && isset($answer[$iter]) && $q_answer->pluck('grid_ans')->contains($answer[$iter++])){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            }
        }
  
        $right_questions = $score;
        $score = $this->score_list
        ->where('score_id', $exam->score_id)
        ->where('question_num', $right_questions)
        ->first();
        $score = $right_questions == 0 ? 200 : $score->score; 
        $grade = $exam->pass_score < $score ? true : false;
        $timer = $request->timer;
        if (empty($stu_q)) {
            $stu_exam = $this->exam_history
            ->create([
                'date' => now(),
                'user_id' => auth()->user()->id,
                'exam_id' => $exam->id,
                'score' => $score,
                'time' => $timer, 
                'r_questions' => $right_questions,
                'exam_id' => $exam->id,
            ]);

            foreach ($mistakes as $item) {
                $this->exam_mistakes
                ->create([
                    'student_exam_id' => $stu_exam->id,
                    'question_id' => $item->id
                ]);
            }
        }
        $mistakes = collect($mistakes);
        $lessons_ids = $mistakes->pluck('lesson_id');
        $recommanditions = $this->lesson
        ->whereIn('id', $lessons_ids)
        ->with(['chapter' => function($query){
            $query->select('chapter_name', 'id');
        }])
        ->get()
        ->unique('chapter_id')
        ?->pluck('chapter');

        return response()->json([
            'grade' => $grade,
            'mistakes' => $mistakes,
            'score' => $score,
            'exam' => $exam,
            'right_question' => $right_questions,
            'total_question' => $total_question,
            'pass_score' => $pass_score,
            'exam_name' => $exam_name,
            'recommanditions' => $recommanditions,
        ]);
 
    }
}
