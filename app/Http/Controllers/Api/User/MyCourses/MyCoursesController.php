<?php

namespace App\Http\Controllers\Api\User\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\PaymentRequest;
use App\Models\IdeaLesson;
use App\Models\Question;
use App\Models\Mcq_ans;
use App\Models\StudentQuizze;
use App\Models\StudentQuizzeMistake;
use App\Models\quizze;

class MyCoursesController extends Controller
{
    // user/my_course
    // user/my_ideas/{lesson_id}
    public function my_course(Request $request){
        $courses = [];
        $chapters = [];
        $payment_request = PaymentRequest::where('user_id', auth()->id())
        ->where('state', 'Approve')
        ->with(['order' => function ($query) {
            $query->with('course', 'lessons');
        }])
        ->orderByDesc('id')
        ->get();

        $course = [];

        foreach ($payment_request as $item) {
            foreach ($item->order as $chapter) { 
                $course = $chapter->course;
        
                if (!isset($courses[$course->id])) {
                    $courses[$course->id] = [
                        'id' => $course->id,
                        'course_name' => $course->course_name,
                        'course_des' => $course->course_des,
                        'teacher' => $course?->teacher?->nick_name,
                        'image' => url("images/courses/" . $course->course_url) ,
                        'chapters' => []
                    ];
                }
        
                $chapterData = [
                    'id' => $chapter->id,
                    'chapter_name' => $chapter->chapter_name, 
                    'image' => url("images/Chapters/" . $chapter->ch_url),
                    'teacher' => $chapter?->teacher?->nick_name,
                    'lessons' => $chapter->lessons->map(function ($lesson) {
                        return [
                            'id' => $lesson->id,
                            'lesson_name' => $lesson->lesson_name,
                            'description' => $lesson->lesson_des, 
                            'teacher' => $lesson?->teacher?->nick_name,
                            'image' => url('images/lesson/' . $lesson->lesson_url),
                        ];
                    })->toArray()
                ];

                $courses[$course->id]['chapters'][] = $chapterData;
            }
        }

        $courses = array_values($courses);

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function my_ideas(Request $request, $lesson_id){
        $payment_request = PaymentRequest::where('user_id', auth()->id())
        ->where('state', 'Approve')
        ->whereHas('order', function ($query) use($lesson_id) {
            $query->whereHas('lessons', function($q) use($lesson_id){
                $q->where('id', $lesson_id);
            });
        })
        ->first();
        if(empty($payment_request)){
            return response()->json([
                'errors' => 'You must buy this course'
            ], 400);
        }

        $ideas = IdeaLesson:: 
        where('lesson_id', $lesson_id)
        ->orderBy('idea_order')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'idea' => $item->idea, 
                'v_link' => $item->v_link,
                'pdf' => url('files/lessons_pdf/' . $item->pdf),
            ];
        }); 
        $solve_quiz = (object)['value' => false];
        $quizs = quizze::
        select('id', 'title', 'time', 'score')
        ->where('lesson_id', $lesson_id)
        ->where('state', 1)
        ->with(['question' => function($query){
            $query
            ->select('questions.id', 'question', 'q_url', 'ans_type')
            ->with(['mcq:id,mcq_num,mcq_ans,q_id']);
        }])
        ->orderByDesc('quizze_order')
        ->get()
        ->map(function($item) use($solve_quiz){
            $solve_quiz_status = empty($item->student_success_quizzes(auth()->user()->id))
            ? false : true;
            if (!$solve_quiz_status && !$solve_quiz->value) {
                $solve_quiz->value = true;
                $item->solve_quiz = true;
            }
            else{ 
                $item->solve_quiz = false;
            }
            return $item;
        });

        return response()->json([
            'ideas' => $ideas,
            'quizs' => $quizs,
        ]);
    }

    public function quiz_score(Request $request){
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*' => 'required|array',
            'answers.*.0' => 'required|exists:questions,id',
            'answers.*.1' => 'required',
            'timer' => 'required',
            'quiz_id' => 'required|exists:quizzes,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $score = 0;
        $total = count($request->answers);
        $mistakes = [];
        foreach($request->answers as $answer){
            $question = Question::where('id', $answer[0])
            ->first();
            if ($question->ans_type == 'MCQ') {
                $q_answer = $question->mcq;
                if($q_answer->isNotEmpty() > 0 && $q_answer[0]->mcq_answers == $answer[1]){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            } 
            else {
                $q_answer = $question->g_ans;
                if($q_answer->isNotEmpty() > 0 && $q_answer->pluck('grid_ans')->contains($answer[1])){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            }
        }
        $right_questions = $score;
        $score = $score / $total *100; 
        $stu_qiuz = StudentQuizze::where('student_id', $request->user()->id)
        ->where('quizze_id', $request->quizze_id)
        ->pluck('id');
        StudentQuizzeMistake::
        whereIn('student_quizze_id', $stu_qiuz)
        ->delete();
        StudentQuizze::where('student_id', $request->user()->id)
        ->where('quizze_id', $request->quizze_id)
        ->delete();
        $quiz = quizze::where('id', $request->quiz_id)
        ->first();

        $stu_quizze = StudentQuizze::create([
            'date' => now(),
            'lesson_id' => $quiz->lesson_id,
            'quizze_id' => $request->quiz_id,
            'student_id' => $request->user()->id,
            'score' => $score,
            'time' => $request->timer,
            'r_questions' => $right_questions,
        ]);
        $student_quize_id = $stu_quizze->id;

        foreach ($mistakes as $item) {
            StudentQuizzeMistake::create([
                'student_quizze_id' => $student_quize_id,
                'question_id' => $item->id
            ]);
        }

        return response()->json([
            'score' => $score,
            'time' => $request->timer,
            'right_questions' => $right_questions,
            'quiz_name' => $quiz->title,
            'pass_score' => $quiz->pass_score,
        ]);
    }
}
