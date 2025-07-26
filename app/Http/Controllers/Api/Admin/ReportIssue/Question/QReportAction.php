<?php

namespace App\Http\Controllers\Api\Admin\ReportIssue\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ReportQuestion;

class QReportAction extends Controller
{
    public function __construct(private ReportQuestion $report_question){}

    public function view(){
        $report_questions = $this->report_question
        ->orderByDesc('id')
        ->get();

        return reponse()->json([
            'report_questions' => $report_questions
        ]);
    }
    
    public function status(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pendding,inprogress,done',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $this->report_question
        ->where('id', $id)
        ->update(['statues' => $request->status]);

        return response()->json([
            'success' => $request->status
        ]);
    }
}
