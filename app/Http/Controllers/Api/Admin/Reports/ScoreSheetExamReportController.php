<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExamCodes;
use App\Models\User;
use App\Models\ExamHistory;
use App\Models\ExamMistake;
use App\Models\Course;

class ScoreSheetExamReportController extends Controller
{
    public function __construct(
    private User $users,
    private Course $course,
    private ExamCodes $exam_codes,
    private ExamHistory $exam_history,
    private ExamMistake $exam_mistakes){}

    public function exam_list(Request $request, $user_id){
        $student = $this->users
        ->select('id', 'f_name', 'l_name', 'nick_name', 'created_at')
        ->where('id', $user_id)
        ->first();
        $exam_codes = $this->exam_codes
        ->select('id', 'exam_code')
        ->get();
        $exam_lists = $this->exam_history
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'exam' => $item?->exams?->title,
                'score' => $item->score,
                'total_score' => $item?->exams?->score,
                'time' => $item->time,
                'date' => $item->date,
            ];
        });

        return response()->json([
            'student' => $student,
            'exam_codes' => $exam_codes,
            'exam_lists' => $exam_lists,
        ]);
    }

    public function exam_mistakes(Request $request, $id){
        $mistakes = $this->exam_mistakes
        ->where('student_exam_id', $id)
        ->with('questions.q_ans')
        ->get()
        ?->pluck('questions')
        ?->select('id', 'question', 'q_image', 'q_ans') ?? [];

        return response()->json([
            'mistakes' => $mistakes
        ]);
    }
 
    public function generatePdf(Request $request) {
        $validator = Validator::make($request->all(), [
            'user_id' => ['required', 'exists:users,id'],
            'selected_ids' => ['required', 'array'],
            'selected_ids.*' => ['required', 'exists:exam_history,id'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $user = User::find($request->user_id);   
        $questions = $this->exam_mistakes
        ->whereIn('exam_mistakes.student_exam_id', $request->selected_ids)
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
            'selected_ids.*' => ['required', 'exists:exam_history,id'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $user = User::find($request->user_id);   
        $questions = $this->exam_mistakes
        ->whereIn('exam_mistakes.student_exam_id', $request->selected_ids)
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
        $answers = $questions->pluck('q_ans')->flatten(1);

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
