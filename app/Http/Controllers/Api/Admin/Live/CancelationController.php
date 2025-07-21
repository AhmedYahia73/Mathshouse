<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        select('id', 'course_name', 'category_id')
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

    public function cancelation_filter(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => ['exists:categories,id'], 
            'course_id' => ['exists:courses,id'],
            'teacher_id' => ['exists:users,id'],
            'date' => ['date'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
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
                'category_id' => $course?->category?->id ?? $item?->course?->category?->id,
                'category' => $course?->category?->cate_name ?? $item?->course?->category?->cate_name,
                'course' => $course?->course_name ?? $item?->course?->course_name,
                'course_id' => $course?->id ?? $item?->course?->id,
                'session_type' => $item?->session?->type,
                'session' => $item?->session?->name,
                'teacher' => $item?->session?->teacher?->nick_name,
                'teacher_id' => $item?->session?->teacher?->id,
                'status' => $item?->statue,
            ];
        });
        if (!empty($request->category_id)) {
            $cancelations = $cancelations->where('category_id', $request->category_id);
        }
        if (!empty($request->course_id)) {
            $cancelations = $cancelations->where('course_id', $request->course_id);
        }
        if (!empty($request->teacher_id)) {
            $cancelations = $cancelations->where('teacher_id', $request->teacher_id);
        }
        if (!empty($request->date)) {
            $cancelations = $cancelations->where('date', $request->date);
        }
        $cancelations = $cancelations->values()
        ->select('id', 'student', 'date', 'time', 'category'
        , 'course', 'session_type', 'session', 'teacher', 'status');

        return response()->json([
            'cancelations' => $cancelations
        ]);
    }

    public function cancelation_status(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:Approve,Rejected'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $cancelations = CancelSession:: 
        where('id', $id) 
        ->update([
            'statue' => $request->status
        ]);

        return response()->json([
            'success' => 'You update status success'
        ]);
    }
}
