<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamHistory;

class ExamHistoryController extends Controller
{

    public function view_dia(Request $request){
        $chapters = $this->chapters;
        $dia_history = ExamHistory::
        select('id', 'date', 'score', 'time', 'exam_id')
        ->where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get()
        //  pdf
        ->map(function($item) use($chapters){
            $mistakes = clone $item?->mistakes?->pluck('all_question');
            $lesson_ids = $mistakes?->unique('lesson_id')?->pluck('lesson_id');
            $chapters = $this->chapters
            ->select('id', 'chapter_name')
            ->whereHas('lessons', function($query) use($lesson_ids){
                $query->whereIn('lessons.id', $lesson_ids);
            })
            ->get()
            ->unique('id');
            return [
                'id' => $item->id,
                'name' => $item?->exams?->title,
                'date' => $item->date,
                'score' => $item->score,
                'time' => $item->time,
                'recommendaions' => $chapters,
                'mistakes' => $mistakes
                ->select('id', 'q_image', 'question', 'ans_type', 'mcq', 'g_ans'),
            ];
        });
        			
        return response()->json([
            'dia_history' => $dia_history,
        ]);
    }
}
