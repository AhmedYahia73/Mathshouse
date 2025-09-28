<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamHistory;
use App\Models\ExamMistake; 
use App\Models\Exam; 
use App\Models\Chapter;

class ExamHistoryController extends Controller
{
    public function __construct(private Chapter $chapters){}

    public function view(Request $request){
        $chapters = $this->chapters;
        $exam_history = ExamHistory::
        select('id', 'date', 'score', 'time', 'exam_id')
        ->where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get()
        //  pdf
        ->map(function($item) use($chapters){
            $mistakes = clone $item?->mistakes?->pluck('questions');
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
                'grade' => $item->score >= $item?->exams?->pass_score ? true : false,
                'recommendaions' => $chapters,
            ];
        });

        return response()->json([
            'exam_history' => $exam_history,
        ]);
    }

    public function mistakes($id){
        $questions = ExamMistake::
        where('student_exam_id', $id)
        ->with('questions')
        ->get()
        ?->pluck('questions') ?? collect([]);
        $questions = $questions->select('id', 'q_image', 'question', 'ans_type', 'mcq', 'g_ans');

        return response()->json([
            'questions' => $questions
        ]);
    }

    public function exam_pdf(Request $request, $id){
        $mistakes = ExamMistake::where('student_exam_id', $id)
        ->with('questions.lessons.chapter') // تحميل العلاقات مسبقًا لتقليل الاستعلامات
        ->get()
        ->map(function ($item) {
            return [
                'questions' => $item->questions->q_image,
                'chapter' => $item?->questions?->lessons?->chapter->chapter_name, 
            ];
        });

        $history = ExamHistory::where('id', $id )
        ->first();
        $exam = $history->exams;

        
        // Parse exam time
        $exam_time_parts = explode(':', $exam->time);
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
            'exam' => $exam?->title,
            'student' => auth()->user()->nick_name,
            'delay' => $delay,
            'score' => $history?->score,
            'time' => $history?->time,
            'date' => $history?->date,
            'course' => $history?->exams?->course?->course_name,
            'category' => $history?->exams?->course?->category?->cate_name,
        ]);
    }

    public function exam_report($id){
        
        // Fetch the data
        $history = ExamHistory::where('id', $id)
        ->where('user_id', auth()->user()->id)->first();
        $exam = Exam::where('id', $history->exam_id)
        ->with('course.category')->first();
        $exam_time = $exam->time;
        $exam = $history->exams;
        
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
        $mistakes = ExamMistake::where('student_exam_id', $id)
        ->get()
        ->map(function($item){
            return [
                'question_number' => $item?->questions?->q_num,
                'question_section' => $item?->questions?->section,
                'chapter' => $item?->questions?->lessons?->chapter?->chapter_name,
            ];
        });
    
        return response()->json([
            'report' => $report,
            'exam' => $exam?->title,
            'grade' => auth()->user()->grade,
            'course' => $history?->exams?->course?->course_name,
            'category' => $history?->exams?->course?->category?->cate_name,
            'mistakes' => $mistakes
        ]); 
    }
}
