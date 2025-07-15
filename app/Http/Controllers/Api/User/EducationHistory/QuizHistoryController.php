<?php

namespace App\Http\Controllers\Api\User\EducationHistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\StudentQuizze;
use App\Models\ReportVideoList;
use App\Models\ReportQuestionList;

use Carbon\Carbon;

class QuizHistoryController extends Controller
{
    public function quiz_history(){
        
        $question_reports = ReportQuestionList::all();
        $video_reports = ReportVideoList::all();
        $history = StudentQuizze::where('student_id', auth()->user()->id)
        ->orderByDesc('id')
        ->with(['questions' => function($query){
            $query->with(['mcq' => function($query1){
                $query1->select('id', 'mcq_num', 'mcq_answers', 'q_id', 'mcq_ans');
            } , 'g_ans' => function($query1){
                $query1->select('id', 'grid_ans', 'q_id');
            }]);
        }])
        ->get()
        ->map(function($item){
            $questions = $item?->quizze?->question?->count();
            
            if ($item->time == null || !empty($item->time)) {
                $item->time = '00:00:00';
            }
            // Assume input format is 'H:i:s', e.g., '01:00:00' and '00:10:00'
            // Retrieve quiz period and solve period from the request
            $quizPeriod = Carbon::createFromTimeString($item?->quizze?->time ?? '01:00:00');
            $solvePeriod = Carbon::createFromTimeString($item->time);

            // Define the two times
            $time1 = $quizPeriod;
            $time2 = $solvePeriod;

            // Subtract the times
            $diff = $time1->diff($time2);

            // Format the difference in hours, minutes, and seconds
            $hours = $diff->h;
            $minutes = $diff->i;
            $seconds = $diff->s;

            // Output the result as H:i:s
            $formattedDiff = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);

            if ( $time1 > $time2 ) {
                $delay = '-' . $formattedDiff;
            } else {
                $delay = '+' . $formattedDiff;
            }  
            return [
                'id' => $item->id,
                'date' => $item->date,
                'course' => $item?->lesson?->chapter?->course?->course_name,
                'chapter' => $item?->lesson?->chapter?->chapter_name,
                'quiz' => $item?->quizze?->title,
                'my_score' => $item?->score,
                'quiz_score' => $item?->quizze?->score,
                'no_questions' => $questions,
                'right_questions' => $item?->r_questions,
                'wrong_questions' => $questions - $item?->r_questions,
                'time' => $item?->time,
                'delay' => $item?->delay,
                'mistakes' => $item?->questions
                ->select('id', 'q_image', 'question', 'ans_type', 'mcq', 'g_ans'),
            ];
        }); 

        return response()->json([
            'history' => $history,
            'question_reports' => $question_reports,
            'video_reports' => $video_reports,
        ]);
    }
}
