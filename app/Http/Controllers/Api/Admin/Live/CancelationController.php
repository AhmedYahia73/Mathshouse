<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\CancelSession;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;

class CancelationController extends Controller
{
    public function cancelation(){
        $cancelations = CancelSession::
        orderByDesc('id')
        ->where('statue', '!=', 'Approve')
        ->with(['user', 'session' => function($query){
            $query->with(['lesson.chapter.course.category', 'course.category'
            , 'teacher']);
        }])
        ->get()
        ->map(function($item){
            $course =  $item?->session?->lesson?->chapter?->course;
            return [
                'id' => $item->id,
                'student' => $item?->user?->nick_name,
                'date' => $item->date,
                'time' => $item->time,
                'category' => $course?->category?->cate_name ?? $item?->course?->category?->cate_name,
                'course' => $course?->course_name ?? $item?->course?->course_name,
                'session_type' => $item?->session?->type,
                'session' => $item?->session?->name,
                'teacher' => $item?->session?->teacher?->nick_name,
                'status' => $item?->statue,
            ];
        });
        $categories = Category::
        select('id', 'cate_name')
        ->get();
        $courses = Course::
        select('id', 'course_name')
        ->get();
        $teachers = User::
        select('id', 'nick_name')
        ->where('position', 'teacher')
        ->get();

        return response()->json([
            'cancelations' => $cancelations,
            'categories' => $categories,
            'courses' => $courses,
            'teachers' => $teachers,
        ]);
    }
}
