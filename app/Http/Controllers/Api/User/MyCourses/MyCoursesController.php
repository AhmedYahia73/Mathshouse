<?php

namespace App\Http\Controllers\Api\User\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;
use App\Models\IdeaLesson;
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
        ->get();

        return response()->json([
            'ideas' => $ideas,
            'quizs' => $quizs,
        ]);
    }
}
