<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ReportQuestionList;
use App\Models\ReportQuestion;
use App\Models\ReportVideo;
use App\Models\ReportVideoList;

class ReportIssuesController extends Controller
{
    
    public function admin_question_list_report(){
        $list = ReportQuestionList::
        orderByDesc('id')
        ->simplePaginate(10);
        return view('Admin.ReportIssues.Question.List', compact('list'));
    }
    
    public function Ad_report_list_add( Request $req ){
        ReportQuestionList::create($req->only('list'));

        return redirect()->back();
    }
    
    public function Ad_report_list_edit( Request $req, $id ){
        ReportQuestionList::
        where('id', $id)
        ->update($req->only('list'));

        return redirect()->back();
    }
    
    public function Ad_report_list_del( $id ){
        ReportQuestionList::
        where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function admin_question_action_report(){
        $report = ReportQuestion::simplePaginate(10);

        return view('Admin.ReportIssues.Question.Report', compact('report'));
    }

    public function Ad_report_question_edit( Request $req, $id ){
        ReportQuestion::where('id', $id)
        ->update(['statues' => $req->statues]);

        return redirect()->back();
    }

    public function Ad_report_question_del( $id ){
        ReportQuestion::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function admin_video_report_list(){
        $list = ReportVideoList::
        orderByDesc('id')
        ->simplePaginate(10);
        return view('Admin.ReportIssues.Video.List', compact('list'));
    }

    public function Ad_report_video_list_add( Request $req ){
        ReportVideoList::create($req->only('list'));

        return redirect()->back();
    }
    
    public function Ad_report_video_list_edit( Request $req, $id ){
        ReportVideoList::
        where('id', $id)
        ->update($req->only('list'));

        return redirect()->back();
    }

    public function Ad_report_video_list_del( $id ){
        ReportVideoList::
        where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function admin_video_action_report(){
        $report = ReportVideo::
        orderByDesc('id')
        ->simplePaginate(10);

        return view('Admin.ReportIssues.Video.Report', compact('report'));
    }

    public function Ad_report_video_edit( Request $req, $id ){
        ReportVideo::where('id', $id)
        ->update(['statues' => $req->statues]);

        return redirect()->back();
    }

    public function Ad_report_video_del( $id ){
        ReportVideo::where('id', $id)
        ->delete();

        return redirect()->back();
    }

}
