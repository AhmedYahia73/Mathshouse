<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TScheduleController extends Controller
{
    public function view(Request $request){
        $page_name = 'Schedule'; 
        $courses = $request->user()->teacher_courses;
        $courses->load([
            'chapter.lessons.sessions' => function ($query) {
                $query->where(function($q) {
                    $q->where('date', '>', date('Y-m-d'))
                    ->orWhere(function($q2) {
                        $q2->where('date', date('Y-m-d'))
                            ->where('from', '>=', date('H:i:s'));
                    });
                })
                ->orderByDesc('sessions.id')
                ->with('users');
            }
        ]); 

        return view('Teacher.Schedule.Schedule', compact('page_name', 'courses'));
    }
}
