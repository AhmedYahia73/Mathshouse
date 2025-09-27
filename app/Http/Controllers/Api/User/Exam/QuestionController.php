<?php

namespace App\Http\Controllers\Api\User\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\Question;
use App\Models\ExamCodes;
use App\Models\ReportQuestionList;
use App\Models\PaymentPackageOrder;
use App\Models\SmallPackage;
use App\Models\QuestionHistory;
use App\Models\Course;

class QuestionController extends Controller
{
    public function __construct(private ExamCodes $exam_codes,
    private Question $question, private Course $courses){}

    public function lists(Request $request){
        $exam_codes = $this->exam_codes
        ->select('id', 'exam_code')
        ->get();
        $courses = $this->courses
        ->select('id', 'course_name')
        ->where('category_id', $request->user()->category_id)
        ->get();

        return response()->json([
            'exam_codes' => $exam_codes,
            'courses' => $courses,
        ]);
    }

    public function question_filter(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'exists:courses,id',
            'year' => 'numeric',
            'month' => 'numeric',
            'section' => 'numeric',
            'code' => 'exists:exam_codes,id',
            'q_num' => 'numeric',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $question = $this->question;
        if ($request->year) {
            $question = $question
            ->where('year', $request->year);
        }
        if ($request->month) {
            $question = $question
            ->where('month', $request->month);
        }
        if ($request->section) {
            $question = $question
            ->where('section', $request->section);
        }
        if ($request->q_num) {
            $question = $question
            ->where('q_num', $request->q_num);
        }
        if ($request->code) {
            $question = $question
            ->where('q_code', $request->code);
        }
        if ($request->course_id) {
            $question = $question
            ->whereHas('lessons.chapter', function($query) use($request){
                $query->where('course_id', $request->course_id);
            } );
        }
        $question = $question->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'year' => $item->year,
                'month' => $item->month,
                'section' => $item->section,
                'code' => $item?->code?->exam_code,
                // 'ans_type' => $item?->ans_type,
                // 'question' => $item->question,
                // 'q_image' => $item->q_image,
                // 'mcq' => $item?->mcq?->select('mcq_num'),
            ];
        });

        return response()->json([
            'questions' => $question
        ]);
    }

    public function solve_question(Request $request, $id){
        
        $reports = ReportQuestionList::all();
        $question = Question::
        where('id', $id)
        ->with('mcq:id,mcq_num,q_id')
        ->first();
         
        $questio_data = [
            'id' => $question->id,
            'ans_type' => $question->ans_type,
            'question' => $question->question,
            'q_image' => $question->q_image,
            'mcq' => $question->mcq,
        ];
 
        $payments = PaymentPackageOrder::
        where('state', 1)
        ->with('pay_req', 'package')
        ->get();
        $user = $request->user()->id;

        $small_package = SmallPackage::where('user_id', auth()->user()->id)
        ->where('module', 'Question')
        ->where('course_id', $question?->lessons?->chapter?->course_id)
        ->where('number', '>', 0)
        ->first();

        if ( !empty($small_package) ) { 
            $small_package->number--;
            $small_package->save();
            
            return response()->json([
                'question' => $questio_data,
                'reports' => $reports,
            ]);
        }

        foreach ( $payments as $item ) { 
            $newTime = Carbon::now()->subDays($item->package->number);
            if ( $item->package->module == 'Question' && 
            $item->pay_req->user_id == auth()->user()->id &&
            $item->date > $newTime &&
            $item->number > 0
            && $item->package->course_id == $question->lessons->chapter->course_id 
                ) 
                {  
                $newTime = Carbon::now()->subDays($item->package->number);

                PaymentPackageOrder::where('id', $item->id)
                ->update([
                    'number' => $item->number - 1
                ]);
                return response()->json([
                    'question' => $questio_data,
                    'reports' => $reports,
                ]);
            }
        } 
        
        return response()->json([
            'errors' => "You don't have a package to start question",
            'course_id' => $question?->lessons?->chapter?->course_id,
        ], 400);
        
    }

    public function grade_question(Request $request){
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'question_id' => 'required|exists:questions,id',
            'answer' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $timer_val = $request->time;
        $arr = [];
        $ans = false; 
        $question = Question::where('id', $request->question_id)
        ->first();
        if ($question->ans_type == 'MCQ') {
            $grade = $question?->mcq[0]?->mcq_answers == $request->answer;
        }
        else{
            $grade =  $this->grid_answer($question?->g_ans?->pluck('grid_ans'), $request->answer);
        }
        $arr['user_id'] = auth()->user()->id;
        $arr['answer'] = $grade;
        $arr['time'] = $timer_val;
        $arr['question_id'] = $request->question_id;
        QuestionHistory::create($arr);

        return response()->json([
            'grade' => $grade,
            'time' => $timer_val,
        ]);
    }

    public function grid_answer($answers, $my_answer){
        foreach ($answers as $item) {
            if($item >= $my_answer - 0.04 && $item <= $my_answer + 0.04){
                return true;
            }
        }
        return false;
    }
}
