<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DiagnosticExamsHistory;
use App\Models\Chapter;

class DiaExamHistoryController extends Controller
{
    public function __construct(private Chapter $chapters){}

    public function view_dia(Request $request){
        $chapters = $this->chapters;
        $dia_history = DiagnosticExamsHistory::
        select('id', 'date', 'score', 'time', 'diagnostic_exams_id')
        ->where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get()
        ->map(function($item) use($chapters){
            $lesson_ids = clone $item?->mistakes?->pluck('all_question')?->unique('lesson_id')?->pluck('lesson_id');
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
                'recommendaions' => $chapters
            ];
        });
        			
        return response()->json([
            'dia_history' => $dia_history,
        ]);
    }
}
