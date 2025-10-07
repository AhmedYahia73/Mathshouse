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
        ->whereHas('chapters_order', function ($q) {
            $q->whereRaw('NOW() <= DATE_ADD(payment_orders.updated_at, INTERVAL payment_orders.duration DAY)');
        })
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

        foreach($courses as $key => $item){
            $chapters = collect($item['chapters'])
            ->unique('id')
            ->sortBy('id')
            ->values();

            $courses[$key]['chapters'] = $chapters->all();
        }

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
        $quiz = quizze::where('id', $request->quiz_id)
        ->with(['question' => function($query){
            $query->with(['g_ans', 'mcq']);
        }])
        ->first();
        $iter = 0;
        foreach($request->answers as $answer){
            $question = $quiz->question[$iter++];
            if ($question->ans_type == 'MCQ') {
                $q_answer = $question->mcq;
                if(isset($q_answer[0]) && $q_answer[0]->mcq_answers == $answer){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            }
            else {
                $q_answer = $question->g_ans;
                $grade =  $this->grid_answer($q_answer?->pluck('grid_ans'), $answer);
                if($q_answer->count() > 0 && $grade){
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
            'quiz_history_id' => $student_quize_id,
            'score' => $score,
            'time' => $request->timer,
            'right_questions' => $right_questions,
            'quiz_name' => $quiz->title,
            'pass_score' => $quiz->pass_score,
        ]);
    }
       
    public function grid_answer($answers, $my_answer){
        foreach ($answers as $item) {
            if($item >= $my_answer - 0.04 && $item <= $my_answer + 0.04 && is_numeric($my_answer)){
                return true;
            }
            elseif($my_answer == $item){
                return true;
            }
        }
        return false;
    } 

    public function quiz_mistakes(Request $request, $id){
        $mistakes = StudentQuizzeMistake::
        where('student_quizze_id', $id)
        ->with(['question' => function($query){
            $query->with(['mcq' => function($query1){
                $query1->select('id', 'mcq_num', 'mcq_answers', 'q_id', 'mcq_ans');
            } , 'g_ans' => function($query1){
                $query1->select('id', 'grid_ans', 'q_id');
            }]);
        }])
        ->get()
        ->map(function($item){
            return [
                'id' => $item->question->id,
                'q_image' => $item->question->q_image,
                'question' => $item->question->question,
                'ans_type' => $item->question->ans_type,
                'mcq' => $item->question->mcq,
                'g_ans' => $item->question->g_ans,
            ];
        });

        return response()->json([
            'mistakes' => $mistakes
        ]);
    }
}
