<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DiagnosticExamsHistory;
use App\Models\DaiExamMistake; 
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

    public function dia_pdf(Request $request, $id){
        $mistakes = DaiExamMistake::where('student_exam_id', $id)
        ->with('all_question.lessons.chapter') // تحميل العلاقات مسبقًا لتقليل الاستعلامات
        ->get()
        ->map(function ($item) {
            return [
                'questions' => $item->all_question->q_image,
                'chapter' => $item?->all_question?->lessons?->chapter->chapter_name, 
            ];
        });

        $history = DiagnosticExamsHistory::where('id', $id )
        ->first();
        $dai_exam = $history->exams;

        
        // Parse exam time
        $exam_time_parts = explode(':', $dai_exam->time);
        $e_hours = isset($exam_time_parts[0]) ? intval($exam_time_parts[0]) : 0;
        $e_minutes = isset($exam_time_parts[1]) ? intval($exam_time_parts[1]) : 0;
    
        // Parse data time
        $history_time = explode(':', $history->time);
        $hours = isset($history_time[0]) ? intval($history_time[0]) : 0;
        $minutes = isset($history_time[1]) ? intval($history_time[1]) : 0;
        $seconds = isset($history_time[2]) ? intval($history_time[2]) : 0;
    
        // Calculate the times in seconds
        $e_time = $e_hours * 60 * 60 + $e_minutes * 60;
        $time = $hours * 60 * 60 + $minutes * 60 + $seconds;
        $delay = $e_time - $time;
        $color = false;

        // Determine delay status
        if ($delay == 0) {
            $delay = 'On Time';
        } else {
            $delay = -$delay;
            $color = $delay > 0 ? true : false;  
            $h = intval($delay / (60 * 60));
            $delay = $delay - $h * 60 * 60;
            $m = intval($delay / 60);
            $s = $delay - $m * 60;        
            $delay = "$h H $m M $s S";
        }
        return response()->json([
            'mistakes' => $mistakes,

            'dai_exam' => $dai_exam?->title,
            'student' => auth()->user()->nick_name,
            'delay' => $delay,
            'score' => $history?->score,
            'time' => $history?->time,
            'date' => $history?->date,
            'course' => $history?->exams?->course?->course_name,
            'category' => $history?->exams?->course?->category?->cate_name,
        ]);
    }

    public function dia_report($id){
        
        // Fetch the data
        $history = DiagnosticExamsHistory::where('id', $id)
        ->where('user_id', auth()->user()->id)->first();
        $exam = DiagnosticExam::where('id', $history->diagnostic_exams_id)
        ->with('course.category')->first();
        $exam_time = $exam->time;
        $dai_exam = $history->exams;
        
        // Parse exam time
        $exam_time_parts = explode(':', $exam_time);
        $e_hours = isset($exam_time_parts[0]) ? intval($exam_time_parts[0]) : 0;
        $e_minutes = isset($exam_time_parts[1]) ? intval($exam_time_parts[1]) : 0;
    
        // Parse data time
        $history_time = explode(':', $history->time);
        $hours = isset($history_time[0]) ? intval($history_time[0]) : 0;
        $minutes = isset($history_time[1]) ? intval($history_time[1]) : 0;
        $seconds = isset($history_time[2]) ? intval($history_time[2]) : 0;
    
        // Calculate the times in seconds
        $e_time = $e_hours * 60 * 60 + $e_minutes * 60;
        $time = $hours * 60 * 60 + $minutes * 60 + $seconds;
        $delay = $e_time - $time;
        $color = false;

        // Determine delay status
        if ($delay == 0) {
            $delay = 'On Time';
        } else {
            $delay = -$delay;
            $color = $delay > 0 ? true : false;  
            $h = intval($delay / (60 * 60));
            $delay = $delay - $h * 60 * 60;
            $m = intval($delay / 60);
            $s = $delay - $m * 60;        
            $delay = "$h H $m M $s S";
        }
    
        // Prepare the data to be passed to the view
        $report = [
            'date' => $history->date,
            'time' => $history->time,
            'delay' => $delay,
            'color' => $color
        ];
        $mistakes = DaiExamMistake::where('student_exam_id', $id)
        ->get()
        ->map(function($item){
            return [
                'question_number' => $item?->all_question?->q_num,
                'question_section' => $item?->all_question?->section,
                'chapter' => $item?->all_question?->lessons?->chapter?->chapter_name,
            ];
        });
    
        return response()->json([
            'report' => $report,
            'dai_exam' => $dai_exam?->title,
            'grade' => auth()->user()->grade,
            'course' => $history?->exams?->course?->course_name,
            'category' => $history?->exams?->course?->category?->cate_name,
            'mistakes' => $mistakes
        ]); 
    }
}
