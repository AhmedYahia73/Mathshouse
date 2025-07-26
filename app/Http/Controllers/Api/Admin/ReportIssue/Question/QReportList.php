<?php

namespace App\Http\Controllers\Api\Admin\ReportIssue\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReportQuestionList;

class QReportList extends Controller
{
    public function __construct(private ReportQuestionList $report_question){}

    public function view(){
        $report_question = $this->report_question
        ->select('list')
        ->get();

        return response()->json([
            'report_question' => $report_question,
        ]);
    }

    public function create(Request $request){
        $this->report_question
        ->create([
            'list' => $request->list
        ]);

        return response()->json([
            'success' => 'You add data success'
        ]);
    }

    public function modify(Request $request, $id){
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
