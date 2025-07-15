<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Question;
use App\Models\Package;
use App\Models\PaymentPackageOrder;
use App\Models\ReportQuestionList;
use App\Models\QuestionHistory;
use App\Models\SmallPackage;
use App\Models\Q_ans;
use App\Models\User;

class QuestionFlowController extends Controller
{
    public function __construct(private Question $question,
    private Package $packages){}

    public function check_package($id){
        $payments = PaymentPackageOrder::
        where('state', 1)
        ->where('user_id', auth()->user()->id)
        ->with('pay_req')
        ->with('package')
        ->orderByDesc('id')
        ->get();
        $question = Question::where('id', $id)
        ->first();
        $user = User::where('id', auth()->user()->id)
        ->first();

        foreach ( $payments as $item ) { 
            $newTime = Carbon::now()->subDays($item->package->duration);
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
                return true; 
            }
        }
        $small_package = SmallPackage::
        where('user_id', auth()->user()->id)
        ->where('course_id', $question?->lessons?->chapter?->course_id)
        ->where('module', 'Question')
        ->where('number', '>', 0)
        ->first();
        if (!empty($small_package)) {
            $small_package->number = $small_package->number - 1;
            $small_package->save();
            return true;
        }
        return false;
    }

    public function questions_parallel(Request $request, $id){
        $question = $this->question
        ->where('id', $id)
        ->first();
        $questions = $this->question
        ->select('id', 'question', 'q_url')
        ->where('month', $question->month)
        ->where('year', $question->year)
        ->where('section', $question->section)
        ->where('q_code', $question->q_code)
        ->where('q_num', $question->q_num)
        ->where('lesson_id', $question->lesson_id)
        ->where('q_type', 'Parallel')
        ->where('id', '!=', $id)
        ->get();

        return response()->json([
            'questions' => $questions,
        ]);
    }

    public function solve_parallel(Request $request, $id){
        if(!$this->check_package($id)){
            return response()->json([
                'errors' => 'You must buy package'
            ], 403);
        }

        $question_reports = ReportQuestionList::all();
        $question = $this->question
        ->select('id', 'question', 'q_url')
        ->with('mcq:id,mcq_num,mcq_ans,mcq_answers,q_id')
        ->where('id', $id)
        ->first();
        $video_reports = ReportQuestionList::all();

        return response()->json([
            'question' => $question,
            'question_reports' => $question_reports,
        ]);
    }

    public function grade_solve_parallel(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'answer' => 'required',
            'timer' => ["required", "regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/"],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
         $question = $this->question
         ->select('id', 'question', 'q_url', 'ans_type')
         ->with(['mcq', 'g_ans'])
        ->where('id', $id)
        ->first();
        $grade = null;
        if ($question->ans_type == 'MCQ') { 
            if($question?->mcq?->pluck('mcq_answers')->contains($request->answer)){
                $grade = true;
            }
            else{
                $grade = false;
            }
        } else {
            if($question?->g_ans?->pluck('grid_ans')->contains($request->answer)){
                $grade = true;
            }
            else{
                $grade = false;
            }
        }
        QuestionHistory::
        create([
            'user_id' => auth()->user()->id,
            'question_id' => $id,
            'answer' => $grade,
            'time' => $request->timer,
        ]);
         
        return response()->json([ 
            'grade' => $grade,
            'timer' => $request->timer,
        ]);
    }

    public function view_answer(Request $request, $id){
        if(!$this->check_package($id)){
            return response()->json([
                'errors' => 'You must buy package'
            ], 403);
        }

        $answers = Q_ans::
        where('Q_id', $id)
        ->get();

        return response()->json([
            'answers' => $answers
        ]);
    }

    public function get_packages(Request $request, $id){ 
         $question = $this->question
        ->where('id', $id)
        ->first();
        $packages = $this->packages
        ->where('module', 'Question')
        ->where('course_id', $question?->lessons?->chapter?->course_id)
        ->get();

        return response()->json([
            'packages' => $packages,
        ]);
    }

    public function buy_package(Request $request, $id){ 
        $packages = $this->packages
        ->where('id', $id)
        ->first();

        return response()->json([
            'packages' => $packages,
        ]);
    }
}
