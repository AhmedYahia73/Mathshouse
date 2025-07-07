<?php

namespace App\Http\Controllers\Api\User\MyCourses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PaymentRequest;

class MyCoursesController extends Controller
{
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
}
