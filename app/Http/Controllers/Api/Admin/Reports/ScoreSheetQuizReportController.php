<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\StudentQuizze;
use App\Models\Lesson;

class ScoreSheetQuizReportController extends Controller
{
    public function __construct(private User $users,
    private Course $course, private Chapter $chapter, 
    private Lesson $lesson, 
    private StudentQuizze $student_quiz){}

    public function students(Request $request){
        $students = $this->users
        ->select('id', 'f_name', 'l_name', 'nick_name',
        'phone', 'parent_phone', 'email')
        ->get();

        return response()->json([
            'students' => $students
        ]);
    }

    public function quiz_list(Request $request, $user_id){
        $student = $this->users
        ->select('id', 'f_name', 'l_name', 'nick_name')
        ->where('id', $user_id)
        ->first();
        $quizs = $this->student_quiz
        ->where('student_id', $user_id)
        ->with('lesson.chapter', 'quizze')
        ->whereHas('lesson.chapter')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'time' => $item->time,
                'date' => $item->date,
                'score' => $item->score,
                'total_score' => $item?->quizze?->score,
                'quiz' => $item?->quizze?->title,
                'lesson_id' => $item?->lesson_id,
                'chapter_id' => $item?->lesson?->chapter_id,
                'course_id' => $item?->lesson?->chapter?->course_id,
            ];
        });

        return response()->json([
            'student' => $student,
            'quizs_history' => $quizs
        ]);
    }

    public function quiz_mistakes(Request $request, $id){
        $quizs = $this->student_quiz
        ->where('id', $id)
        ->with('questions.q_ans')
        ->first()
        ?->questions
        ?->select('id', 'question', 'q_image', 'q_ans');

        return response()->json([
            'quizs' => $quizs
        ]);
    }
}
