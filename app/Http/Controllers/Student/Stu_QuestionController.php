<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\QuestionHistory;

class Stu_QuestionController extends Controller
{
    public function question_history(){
        $q_history = QuestionHistory::where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();
        return view('Student.Question_History.Question_History', compact('q_history'));
    }

    public function question_mistakes( $id ){
        $mistake = QuestionHistory::where('user_id', auth()->user()->id)
        ->where('id', $id)
        ->first();

        return view('Student.Question_History.Question_Mistakes', compact('mistake'));
    }

}
