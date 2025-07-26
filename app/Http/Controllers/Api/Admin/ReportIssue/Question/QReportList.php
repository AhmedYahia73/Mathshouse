<?php

namespace App\Http\Controllers\Api\Admin\ReportIssue\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\ReportQuestionList;

class QReportList extends Controller
{
    public function __construct(private ReportQuestionList $report_question){}

    public function view(){
        $report_question = $this->report_question
        ->select('list', 'id')
        ->get();

        return response()->json([
            'report_question' => $report_question,
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'list' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $this->report_question
        ->create([
            'list' => $request->list
        ]);

        return response()->json([
            'success' => 'You add data success'
        ]);
    }

    public function modify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'list' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $this->report_question
        ->where('id', $id)
        ->update([
            'list' => $request->list
        ]);

        return response()->json([
            'success' => 'You update data success'
        ]);
    }

    public function delete($id){
        $this->report_question
        ->where('id', $id)
        ->delete();

        return response()->json([
            'success' => 'You delete data success'
        ]);
    }
}
