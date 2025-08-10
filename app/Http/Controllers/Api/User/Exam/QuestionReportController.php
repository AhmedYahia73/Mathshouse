<?php

namespace App\Http\Controllers\Api\User\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ReportQuestion;

class QuestionReportController extends Controller
{
    public function __construct(private ReportQuestion $report_question){}

    public function question_report(Request $request){
       $validator = Validator::make($request->all(), [
            'report_id' => ['required', 'exists:report_question_lists,id'],
            'question_id' => ['required', 'exists:questions,id'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $this->report_question
        ->create([
            'date' => date('Y-m-d'),
            'user_id' => $request->user()->id,
            'question_id' => $request->question_id,
            'list_id' => $request->report_id, 
        ]);

        return response()->json([
            'success' => 'You add data success'
        ]);
    }
}
