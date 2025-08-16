<?php

namespace App\Http\Controllers\Api\Parent\MyCourses;

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

class MyCouresController extends Controller
{
    public function my_course(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $courses = [];
        $chapters = [];
        $payment_request = PaymentRequest::where('user_id', $request->user_id)
        ->where('state', 'Approve')
        ->whereHas('chapters_order', function ($q) {
            $q->whereRaw('NOW() <= DATE_ADD(payment_orders.date, INTERVAL payment_orders.duration DAY)');
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
                ];

                $courses[$course->id]['chapters'][] = $chapterData;
            }
        }

        $courses = array_values($courses);

        return response()->json([
            'courses' => $courses
        ]);
    }

}
