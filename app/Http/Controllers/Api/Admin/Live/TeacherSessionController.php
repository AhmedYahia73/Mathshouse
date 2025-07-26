<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;

class TeacherSessionController extends Controller
{
    public function view(){
        $upcoming = Session::
        where('date', '>', date('Y-m-d'))
        ->orWhere('date', date('Y-m-d'))
        ->Where('to', '>=', date('H:i:s'))
        ->limit(1000)
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'teacher' => $item?->teacher?->nick_name,
                'name' => $item->name,
                'date' => $item->date,
                'from' => $item->from,
                'to' => $item->to,
                'type' => $item->type,
                'session_types' => $item->session_types,
            ];
        });
        $history = Session::
        where('date', '<', date('Y-m-d'))
        ->orWhere('date', date('Y-m-d'))
        ->Where('to', '<', date('H:i:s'))
        ->limit(1000)
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'teacher' => $item?->teacher?->nick_name,
                'name' => $item->name,
                'date' => $item->date,
                'from' => $item->from,
                'to' => $item->to,
                'type' => $item->type,
                'session_types' => $item->session_types,
            ];
        });

        return response()->json([
            'upcoming' => $upcoming,
            'history' => $history,
        ]);
    }

    public function lists(){
        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();

        return response()->json([
            'categories' => $categories,
            'courses' => $courses,
            'teachers' => $teachers,
        ]);
    }

    public function filter_teacher_session( Request $request ){
        $sessions = Session::orderByDesc('id'); 
        if ( !empty($request->teacher_id) ) {
            $teacher_id = $request->teacher_id;
            $sessions = $sessions->where('teacher_id', $teacher_id);
        }
        if ( !empty($request->date) ) { 
            $date = $request->date;
            $sessions = $sessions->where('date', $date);
        }
        if ( !empty($request->course_id) ) {
            $course_id = $request->course_id;
            $sessions = $sessions
            ->where(function($query) use($course_id){
                $query->whereHas('lesson.chapter', function($query) use($course_id){
                    $query->where('course_id', $course_id);
                })
                ->orWhere('course_id', $course_id);
            })
            ->get();
        }
        elseif ( !empty($request->category_id) ) {
            $category_id = $request->category_id;
            $sessions = $sessions
            ->where(function($query) use($category_id){
                $query->whereHas('lesson.chapter.course', function($query) use($category_id){
                    $query->where('category_id', $category_id);
                })
                ->orWhereHas('course', function($query) use($category_id){
                    $query->where('category_id', $category_id);
                });
            })
            ->get();
        }
        if ( empty($request->course_id) && empty($request->category_id) ) {
            $sessions = $sessions->get();
        }
        
        return response()->json([
            'sessions' => $sessions,
        ]);
    }
}
