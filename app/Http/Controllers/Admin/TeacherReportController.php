<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeacherReportResource;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Session;

class TeacherReportController extends Controller
{
    public function __construct(private Session $sessions, private User $users){}
    public function data(){
        // https://login.mathshouse.net/api/TeacherReport
        $teachers = $this->users
        ->with(['session_explanation' => function($query){
            return $query->withCount('attendce as student_count')
            ->with('lesson.chapter.course.category');
        }, 'session_re_explanation' => function($query){
            return $query->withCount('attendce as student_count')
            ->with('lesson.chapter.course.category');
        }, 'session_mistakes' => function($query){
            return $query->withCount('attendce as student_count')
            ->with('course.category');
        }])
        ->where('position', 'teacher')
        ->get(); 

        $teachers = TeacherReportResource::collection($teachers);
        return response()->json([
            'teachers' => $teachers
        ]);
    }

    public function filter(Request $request){
        // https://login.mathshouse.net/api/TeacherReport/Filter
        // Keys
        // from, to
        if ($request->from && $request->to) {
            $from = $request->from; 
            $to = $request->to;
            $teachers = $this->users
            ->with(['session_explanation' => function($query) use($from, $to){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category')
                ->where('date', '>=', $from)
                ->where('to', '<=', $to);
            }, 'session_re_explanation' => function($query) use($from, $to){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category')
                ->where('date', '>=', $from)
                ->where('to', '<=', $to);
            }, 'session_mistakes' => function($query) use($from, $to){
                return $query->withCount('attendce as student_count')
                ->with('course.category')
                ->where('date', '>=', $from)
                ->where('to', '<=', $to);
            }])
            ->where('position', 'teacher')
            ->get();
        }
        elseif($request->from ){
            $from = $request->from;
            $teachers = $this->users
            ->with(['session_explanation' => function($query) use($from){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category')
                ->where('date', '>=', $from);
            }, 'session_re_explanation' => function($query) use($from){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category')
                ->where('date', '>=', $from);
            }, 'session_mistakes' => function($query) use($from){
                return $query->withCount('attendce as student_count')
                ->with('course.category')
                ->where('date', '>=', $from);
            }])
            ->where('position', 'teacher')
            ->get();
        }
        elseif($request->to ){
            $to = $request->to; 
            $teachers = $this->users
            ->with(['session_explanation' => function($query) use($to){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category')
                ->where('to', '<=', $to);
            }, 'session_re_explanation' => function($query) use($to){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category')
                ->where('to', '<=', $to);
            }, 'session_mistakes' => function($query) use($to){
                return $query->withCount('attendce as student_count')
                ->with('course.category')
                ->where('to', '<=', $to);
            }])
            ->where('position', 'teacher')
            ->get();
        }
        else{
            $teachers = $this->users
            ->with(['session_explanation' => function($query){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category');
            }, 'session_re_explanation' => function($query){
                return $query->withCount('attendce as student_count')
                ->with('lesson.chapter.course.category');
            }, 'session_mistakes' => function($query){
                return $query->withCount('attendce as student_count')
                ->with('course.category');
            }])
            ->where('position', 'teacher')
            ->get();
        }

        $teachers = TeacherReportResource::collection($teachers);
        return response()->json([
            'teachers' => $teachers
        ]);
    }
}
