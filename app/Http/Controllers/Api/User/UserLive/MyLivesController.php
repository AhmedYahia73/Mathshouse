<?php

namespace App\Http\Controllers\Api\User\UserLive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\SessionStudent;
use App\Models\SessionAttendance;
use App\Models\PaymentPackageOrder;
use App\Models\SmallPackage;
use App\Models\Category;
use App\Models\Course;
use App\Models\LiveLesson;
use App\Models\IdeaLesson;
use App\Models\Session;
use App\Models\quizze;

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
        ->with('session.lesson.chapter.course')
        ->get()
        ?->pluck('session')
        ?->pluck('lesson')
        ->unique('id');
        $lives2 = LiveLesson::
        where('user_id', auth()->user()->id)
        ->where('created_at', '>=', $new_date)
        ->orWhereHas('lesson.extraDays', function($query){
            $query->where('end_date', '>=', date('Y-m-d'));
        })
        ->where('user_id', auth()->user()->id)
        ->with(['lesson' => function($query){
            $query->with(['chapter.course', 'sessions']);
        }])
        ->get()
        ?->pluck('lesson');
        $lives = $lives1->merge($lives2)->unique('id')
        ->groupBy(function($lesson) {
            return $lesson->chapter->course->category->id;
        })
       ->map(function ($lessonsGroup) {
            $courseModel = $lessonsGroup->first()->chapter->course;
            return [
                'id' => $courseModel->id,
                'course_name' => $courseModel->course_name,
                'course_des' => $courseModel->course_des,
                'teacher' => $courseModel?->teacher?->nick_name,
                'image' => url("images/courses/" . $courseModel->course_url) ,
                'chapters' => $lessonsGroup
                    ->groupBy(fn($lesson) => $lesson->chapter->id)
                    ->map(function ($lessonsInChapter) {
                        $chapterModel = $lessonsInChapter->first()->chapter;

                        return [ 
                            'id' => $chapterModel->id,
                            'chapter_name' => $chapterModel->chapter_name, 
                            'image' => url("images/Chapters/" . $chapterModel->ch_url),
                            'teacher' => $chapterModel?->teacher?->nick_name,
                            'lessons' => $lessonsInChapter
                                ->unique('id')
                                ->map(fn($lesson) => [ 
                                    'id' => $lesson->id,
                                    'lesson_name' => $lesson->lesson_name,
                                    'description' => $lesson->lesson_des, 
                                    'teacher' => $lesson?->teacher?->nick_name,
                                    'image' => url('images/lesson/' . $lesson->lesson_url),
                                ])
                                ->values(),
                        ];
                    })
                    ->values(),   
                ];
            })
            ->values();

        return response()->json([
            'courses' => $lives,
        ]);
    }
    
    public function my_ideas(Request $request, $lesson_id){
        
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
        ->get()
        ?->pluck('session')
        ?->where('lesson_id', $lesson_id)
        ?->values();
        $material_link = null;
        $ans_teacher_material = null;
        if ($lives1->count() > 0) {
            $material_link = $lives1[0]['material_link'];
            $ans_teacher_material = url('storage/' . $lives1[0]['ans_teacher_material']);
        }
        $lives1 = $lives1?->pluck('lesson')
        ?->unique('id')?->values(); 
        $lives2 = LiveLesson::
        where('user_id', auth()->user()->id)
        ->where('created_at', '>=', $new_date)
        ->orWhereHas('lesson.extraDays', function($query){
            $query->where('end_date', '>=', date('Y-m-d'));
        })
        ->where('user_id', auth()->user()->id)
        ->with(['lesson' => function($query){
            $query->with(['chapter.course', 'sessions']);
        }])
        ->get()
        ?->pluck('lesson');
        $lives = $lives1->merge($lives2)->unique('id')
        ->where('id', $lesson_id)
        ->first();
        if(empty($lives)){
            return response()->json([
                'errors' => 'You must attend live'
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
            'material_link' => $material_link,
            'ans_teacher_material' => $ans_teacher_material,
        ]);
    }

    public function private_request_lists(Request $request){ 
        $courses = Course::
        select('id', 'course_name')
        ->where('category_id', $request->user()->category_id)
        ->get();

        return response()->json([ 
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

    public function private_request_booking( Request $request ){
        $validator = Validator::make($request->all(), [
            'session_id' => 'required|exists:sessions,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $session = SessionStudent::
        where('user_id', auth()->user()->id) 
        ->where('session_id', $request->session_id)
        ->first(); 
        if ( !empty($session) ) {  
            return response()->json([
                'errors' => 'You have booked session before'
            ], 400);
        } 
        SessionStudent::create([
            'session_id' => $request->session_id,
            'user_id' => auth()->user()->id,
        ]);
        $package = PaymentPackageOrder::
        leftJoin('packages', 'payment_package_order.package_id', '=', 'packages.id')
        ->where('payment_package_order.number', '>', 0)
        ->where('user_id', auth()->user()->id)
        ->orderByDesc('payment_package_order.id')
        ->get(); 
        $small_package = SmallPackage::where('user_id', auth()->user()->id)
        ->where('module', 'Live')
        ->where('course_id', $session?->lesson?->chapter?->course_id ?? $session?->course?->id)
        ->where('number', '>', 0)
        ->first();

        if ( !empty($small_package) || count($package) != 0 ) {
            return response()->json([
                'success' => 'You are booking success'
            ]);
        }
        else {
            return response()->json([
                'errors' => 'You must have live sessions in your live package to reserve any session'
            ]);
        }
    }
}
