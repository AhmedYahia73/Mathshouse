<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamHistory;
use App\Models\ReportQuestion;

class Stu_ExamController extends Controller
{
    
    public function exam_history(){
        $exam_history = ExamHistory::where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();

        return view('Student.Exam_History.Exam_History', compact('exam_history'));
    }
    
    public function exam_mistakes( $id ){
        $mistakes = ExamHistory::
        where('user_id', auth()->user()->id)
        ->where('id', $id)
        ->first()->mistakes;

        return view('Student.Exam_History.Exam_Mistakes', compact('mistakes'));
    }

}
