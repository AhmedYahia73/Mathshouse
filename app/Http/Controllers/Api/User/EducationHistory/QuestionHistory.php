<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\QuestionHistory as QuestionHistoryModel;

class QuestionHistory extends Controller
{
    public function view(Request $request){
        $q_history = QuestionHistoryModel::
        with(['question' => function($query){
            $query->with(['mcq', 'g_ans']);
        }])
        ->where('user_id', $request->user()->id)
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'year' => $item?->question?->year,
                'month' => $item?->question?->month,
                'section' => $item?->question?->section,
                'code' => $item?->question?->code,
                'answer' => $item->answer,
                'time' => $item->time,
                'mistake' => [
                    'id' => $item?->question?->id,
                    'q_image' => $item?->question?->q_image,
                    'question' => $item?->question?->question,
                    'ans_type' => $item?->question?->ans_type,
                    'mcq' => $item?->question?->mcq,
                    'g_ans' => $item?->question?->g_ans,
                ]
            ];
        });

        return response()->json([
            'questions_history' => $q_history
        ]);
    }
}
