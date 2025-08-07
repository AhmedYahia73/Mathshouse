<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        'phone', 'parent_phone', 'email', 'image')
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

    public function quiz_report(Request $request, $id){
        $quizs = $this->student_quiz
        ->where('id', $id)
        ->with('lesson.chapter.course', 'student')
        ->first();
        $student = $quizs?->student?->nick_name;
        $course = $quizs?->lesson?->chapter?->course?->course_name;
        $date = $quizs->date;
        $day = Carbon::parse($quizs->date)->format('l');
        $time = $quizs->time;
        $score = $quizs->score;
        
        // Assume input format is 'H:i:s', e.g., '01:00:00' and '00:10:00'
        // Retrieve quiz period and solve period from the request
        $quizPeriod = Carbon::createFromTimeString($quizs?->quizze?->time ?? '01:00:00');
        $solvePeriod = Carbon::createFromTimeString($quizs->time);

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

        return response()->json([
            'student' => $student,
            'course' => $course,
            'date' => $date,
            'day' => $day,
            'time' => $time,
            'score' => $score,
            'delay' => $delay,
        ]);
    }
 
    public function generatePdf(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'selected_ids' => ['required', 'array'],
            'selected_ids.*' => ['required', 'exists:student_quizzes,id'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $user = User::find($request->user_id);   
        $questions = $this->student_quiz
        ->whereIn('student_quizzes.id', $request->selected_ids)
        ->with(['questions' => function($query){
            $query->select('questions.id', 'question', 'q_url', 'lesson_id')
            ->with(['lessons' => function($q1){
                $q1->select('lessons.id', 'lesson_name', 'chapter_id')
                ->with(['chapter' => function($q2){
                    $q2->select('chapters.id', 'chapter_name', 'course_id')
                    ->with(['course' => function($q3){
                        $q3->select('courses.id', 'course_name', 'category_id')
                        ->with('category:id,cate_name');
                    }]);
                }]);
            }]);
        }])->get();
                
        $questions = $questions->pluck('questions')->flatten(1);

        // Get unique lessons
        $lessons = $questions->pluck('lessons')->filter()->unique('id')->values();

        // Get unique chapters
        $chapters = $lessons->pluck('chapter')->filter()->unique('id')->values();

        // Get unique courses
        $courses = $chapters->pluck('course')->filter()->unique('id')->values();

        // Get unique categories
        $categories = $courses->pluck('category')->filter()->unique('id')->values(); 

        $pdf_name =  'Questions ' . ( $questions->count()) . ' for ' .  $user->f_name . ' ' . $user->l_name;
        return response()->json([
            'questions' => $questions->select('id', 'question', 'q_image'),
            'pdf_name' => $pdf_name,
            'student' => $user,
            'lessons' => $lessons->select('id', 'lesson_name'),
            'chapters' => $chapters->select('id', 'chapter_name'),
            'courses' => $courses->select('id', 'course_name'),
            'categories' => $categories->select('id', 'cate_name'),
        ]);
    }

    
    public function generateAnsPdf(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'selected_ids' => ['required', 'array'],
            'selected_ids.*' => ['required', 'exists:student_quizzes,id'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $user = User::find($request->user_id);   
        $questions = $this->student_quiz
        ->whereIn('student_quizzes.id', $request->selected_ids)
        ->with(['questions' => function($query){
            $query->select('questions.id', 'question', 'q_url', 'lesson_id')
            ->with(['q_ans', 'lessons' => function($q1){
                $q1->select('lessons.id', 'lesson_name', 'chapter_id')
                ->with(['chapter' => function($q2){
                    $q2->select('chapters.id', 'chapter_name', 'course_id')
                    ->with(['course' => function($q3){
                        $q3->select('courses.id', 'course_name', 'category_id')
                        ->with('category:id,cate_name');
                    }]);
                }]);
            }]);
        }])->get();
                
        $questions = $questions->pluck('questions')->flatten(1);
        // Get unique lessons
        $lessons = $questions->pluck('lessons')->filter()->unique('id')->values();

        // Get unique chapters
        $chapters = $lessons->pluck('chapter')->filter()->unique('id')->values();

        // Get unique courses
        $courses = $chapters->pluck('course')->filter()->unique('id')->values();

        // Get unique categories
        $categories = $courses->pluck('category')->filter()->unique('id')->values(); 

        // Get unique answers
        $answers = $questions->pluck('q_ans')->select('id', 'ans_pdf_link');

        $pdf_name =  'Questions ' . ( $questions->count()) . ' for ' .  $user->f_name . ' ' . $user->l_name;
        return response()->json([
            'answers' => $answers,
            'pdf_name' => $pdf_name,
            'student' => $user,
            'lessons' => $lessons->select('id', 'lesson_name'),
            'chapters' => $chapters->select('id', 'chapter_name'),
            'courses' => $courses->select('id', 'course_name'),
            'categories' => $categories->select('id', 'cate_name'),
        ]);
    }
}
