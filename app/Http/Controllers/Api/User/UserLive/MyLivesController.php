<?php

namespace App\Http\Controllers\Api\User\UserLive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\SessionStudent;
use App\Models\SessionAttendance;
use App\Models\Category;
use App\Models\Course;
use App\Models\LiveLesson;
use App\Models\Session;

class MyLivesController extends Controller
{ 
    public function my_lives(Request $request){
        $sessions = SessionStudent::
        where('user_id', auth()->user()->id)
        ->with('session')
        ->orderByDesc('id')
        ->get()
        ?->pluck('session')
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'link' => $item->link,
                'date' => $item->date,
                'from' => $item->from,
                'to' => $item->to,
                'status' => count($item->user_attend) == 0 ? 'Missed' : 'Attend',
                'teacher' => $item?->teacher?->nick_name,
            ];
        });
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        // upcoming
        $upcoming_lives = $sessions->filter(function ($item) use ($currentDate, $currentTime) {
            return ($item['date'] > $currentDate) ||
                ($item['date'] == $currentDate && $item['to'] >= $currentTime);
        })->values();

        // history
        $history_lives = $sessions->filter(function ($item) use ($currentDate, $currentTime) {
            return ($item['date'] < $currentDate) ||
                ($item['date'] == $currentDate && $item['to'] < $currentTime);
        })->values();

        return response()->json([
            'upcoming_lives' => $upcoming_lives,
            'history_lives' => $history_lives,
        ]);
    }

    public function lessons_live(Request $request){
        
        $new_date = Carbon::now()->subDays(7);
        $lives1 = SessionAttendance::
        where('user_id', auth()->user()->id)
        ->whereHas('session', function($query) use($new_date){
            $query->where('date', '>=', $new_date)
            ->orWhereHas('lesson.extraDays', function($query1){
                $query1->where('user_id', auth()->user()->id)
                ->where('end_date','>=',date('Y-m-d'));
            });
        })
        ->with('session.lesson.chapter.course.category')
        ->get()
        ?->pluck('session')
        ?->pluck('lesson')
        ->unique('id')
        ->groupBy(function($lesson) {
            return $lesson->chapter->course->category->id;
        });
        $lives2 = LiveLesson::
        where('user_id', auth()->user()->id)
        ->where('created_at', '>=', $new_date)
        ->orWhereHas('lesson.extraDays', function($query){
            $query->where('end_date', '>=', date('Y-m-d'));
        })
        ->where('user_id', auth()->user()->id)
        ->with(['lesson' => function($query){
            $query->with(['chapter.course.category', 'sessions']);
        }])
        ->get()
        ?->pluck('lesson');

        return response()->json([
            'lives1' => $lives1,
            'lives2' => $lives2,
        ]);
        // $session->lesson?->chapter?->id &&
        //     $chapter_id == $session->lesson->chapter->id &&
        //     (\Carbon\Carbon::now()->subDays(7) <= $session->date ||
        //         $session->lesson->getExtraDays() >= date('Y-m-d')) &&
        //     !in_array($session->lesson->id, $arr_lessons))
            
        // @if (
        //     $live_item->lesson?->chapter?->id &&
        //         $chapter_id == $live_item->lesson->chapter->id &&
        //         \Carbon\Carbon::now()->subDays(7) <= $live_item->created_at &&
        //         !in_array($live_item->lesson->id, $arr_lessons))
    }

    public function private_request_lists(Request $request){ 
        $categories = Category::all();
        $courses = Course::all();

        return response()->json([
            'categories' => $categories,
            'courses' => $courses,
        ]);
    }

    public function private_request(Request $request){ 
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $course_id = $request->course_id;
        $private_req = Session::where('type', 'private')
        ->where('date', '>=', date('Y-m-d'))
        ->whereHas('lesson.chapter', function($query) use ($course_id){
            $query->where('course_id', $course_id);
        }) 
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'link' => $item->link,
                'from' => $item->from,
                'to' => $item->to,
                'date' => $item->date,
                'lesson' => $item?->lesson?->lesson_name,
                'teacher' => $item?->teacher?->nick_name,
                'chapter' => $item?->chapter?->chapter_name,
                'course' => $item?->chapter?->course?->course_name,
                'day' => Carbon::parse($item->to)->format('l'),
            ];
        });

        return response()->json([
            'private_requests' => $private_req
        ]);
    }
}
