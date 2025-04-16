<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\LiveLesson;
use App\Models\SessionStudent;
use App\Models\PaymentPackageOrder;
use App\Models\User;
use App\Models\IdeaLesson;
use App\Models\SmallPackage; 
use App\Models\Category; 
use App\Models\Course; 
use App\Models\ReportVideoList; 
use App\Models\SessionAttendance;

use Carbon\Carbon;

class Stu_LiveController extends Controller
{

    public function stu_mysessions(){
        $sessions = SessionStudent::
        where('user_id', auth()->user()->id)
        ->orderByDesc('id')
        ->get();
        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();
        
        return view('Student.Live.Live', compact('sessions', 'categories', 'courses', 'teachers'));
    }

    public function stu_live_pdf( $file_name ){
    
        $path = public_path('files/lessons_pdf/' . $file_name);
        if (!file_exists($path)) {
            session()->flash('faild', 'PDF not Found');
            return redirect()->back();
        }

        return response()->file($path);
    }

    public function v_live( Request $req ){ 
        $categories = Category::all();
        $courses = Course::all();
        $sessions = [];
        $data = $req->all();
        
        if ( !empty($req->course_id) && !empty($req->from) && empty($req->to) ) {
            $sessions = Session::select('sessions.*', 'chapters.course_id', 'lessons.lesson_name')
            ->leftJoin('lessons', 'sessions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->where('chapters.course_id', $req->course_id)
            ->where('sessions.date', '>=', $req->from)
            ->where('sessions.type', '!=', 'private')
            ->get();
            
            return view('Student.VisitorLive.Live', compact('categories', 'courses', 'data', 'sessions'));
        }
        elseif ( !empty($req->course_id )&& empty($req->from) && !empty($req->to) ) {
            $sessions = Session::select('sessions.*', 'chapters.course_id', 'lessons.lesson_name')
            ->leftJoin('lessons', 'sessions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->where('chapters.course_id', $req->course_id)
            ->where('sessions.date', '<=', $req->to)
            ->where('sessions.type', '!=', 'private')
            ->get();
            
            return view('Student.VisitorLive.Live', compact('categories', 'courses', 'data', 'sessions'));
        }
        elseif ( !empty($req->course_id) && !empty($req->from )&& !empty($req->to) ) {
            $sessions = Session::select('sessions.*', 'chapters.course_id', 'lessons.lesson_name')
            ->leftJoin('lessons', 'sessions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->where('chapters.course_id', $req->course_id)
            ->where('sessions.date', '>=', $req->from )
            ->where('sessions.date', '<=', $req->to )
            ->where('sessions.type', '!=', 'private')
            ->get();
            
            return view('Student.VisitorLive.Live', compact('categories', 'courses', 'data', 'sessions'));
        }
        elseif ( !empty($req->course_id) ) {
            $sessions = Session::select('sessions.*', 'chapters.course_id', 'lessons.lesson_name')
            ->leftJoin('lessons', 'sessions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->where('chapters.course_id', $req->course_id)
            ->where('sessions.type', '!=', 'private')
            ->get();
            
            return view('Student.VisitorLive.Live', compact('categories', 'courses', 'data', 'sessions'));
        } 
        else {
            return view('Student.VisitorLive.Live', compact('categories', 'courses', 'sessions'));
        }
        
    }

    public function use_live($id){
        $session = Session::where('id', $id)
        ->first();
        $session_attendance = SessionAttendance::
        where('user_id', auth()->user()->id)
        ->where('session_id', $id)
        ->first();
        if ( !empty($session_attendance) ) {
            return redirect($session->link);
        }

        $package = PaymentPackageOrder::
        where('number', '>', 0)
        ->where('user_id', auth()->user()->id)
        ->where('state', 1)
        ->whereHas('package_live')
        ->with('package_live')
        ->orderByDesc('id')
        ->get();

        $small_package = SmallPackage::where('user_id', auth()->user()->id)
        ->where('module', 'Live')
        ->where('course_id', $session->lesson?->chapter?->course_id?? $session->course?->id)
        ->where('number', '>', 0)
        ->first();
        $small_package_count = SmallPackage::where('user_id', auth()->user()->id)
        ->where('module', 'Live')
        ->where('course_id', $session->lesson?->chapter?->course_id?? $session->course?->id)
        ->sum('number'); 
        if ( !empty($small_package) && $small_package->number > 0 && $small_package_count > 0 ) {
            $small_package->number = $small_package->number - 1; 
            $small_package->save();
            
            // Return Live
            if (!empty($session->lesson_id)) {
                LiveLesson::create([
                    'user_id' => auth()->user()->id,
                    'lesson_id' => $session->lesson_id
                ]);
            }
            SessionAttendance::create([
                'user_id' => auth()->user()->id,
                'session_id' => $id,
            ]); 

            return redirect($session->link);
        }
        
        foreach ( $package as $item ) {
            if ( $item->package_live != null ) {
                $newTime = Carbon::now()->subDays($item->package_live->duration);
                if ( $item->date >= $newTime && $item->package_live->course_id == $session->lesson?->chapter?->course_id ?? $session->course->id ) {
                    PaymentPackageOrder::
                    where('id', $item->id )
                    ->update([
                        'number' => $item->number - 1
                    ]);
            
                    SessionAttendance::create([
                        'user_id' => auth()->user()->id,
                        'session_id' => $session->id
                    ]); 

                    if (!empty($session->lesson_id)) {
                        LiveLesson::create([
                            'user_id' => auth()->user()->id,
                            'lesson_id' => $session->lesson_id
                        ]);
                    }
                    return redirect($session->link);
                }
            }
        }

        session()->flash('faild', 'Your package Expired');
        return redirect()->back();
    }

    public function stu_myLiveCourse(){
        $user = User::where('id', auth()->user()->id)
        ->first();
        $sessions = $user->session_attendance;

        return view('Student.Live.MyLiveCourses', compact('sessions'));
    }

    public function stu_live_chapters( $course_id ){
        $user = User::where('id', auth()->user()->id)
        ->first();
        $sessions = $user->session_attendance; 
        $course_id = $course_id;

        return view('Student.Live.MyLiveChapters', compact('sessions', 'course_id'));
    }

    public function stu_myLiveLesson( $chapter_id ){
        $user = User::where('id', auth()->user()->id)
        ->first();
        $sessions = $user->session_attendance;
        $chapter_id  = $chapter_id;

        return view('Student.Live.MyLiveLessons', compact('sessions', 'chapter_id'));
    }

    public function stu_live_lesson( Request $request ){
        $user = User::where('id', auth()->user()->id)
        ->first();
        $idea_num = $request->idea;
        $sessions = $user->session_attendance; 
        $idea = IdeaLesson::where('id', $request->idea)
        ->first();
        $reports = ReportVideoList::all();
        $chapter_id = $idea?->lesson?->chapter?->id ?? 0;

        return view('Student.Live.Idea', compact('sessions', 'idea_num', 'idea', 'reports', 'chapter_id'));
    }

    public function stu_private_req(){
        $categories = Category::all();
        $courses = Course::all();
        return view('Student.PrivateRequest.PrivateRequest', compact('categories', 'courses'));
    }

    public function private_req_api( Request $req ){
        $course_id = $req->course_id;
        $private_req = Session::where('type', 'private')
        ->where('date', '>=', date('Y-m-d'))
        ->whereHas('lesson.chapter', function($query) use ($course_id){
            $query->where('course_id', $course_id);
        })
        ->with('teacher')
        ->with('lesson')
        ->orderByDesc('id')
        ->get();

        return response()->json([
            'sessions' => $private_req
        ]);
    }

    public function private_req_book_api( Request $req ){
        $sessions = SessionStudent::
        where('user_id', auth()->user()->id)
        // Added at 25/5/2024
        ->where('session_id', $req->id)
        ->first();

        if ( !empty($sessions) ) { 
            session()->flash('faild','You have booked session before');
            return response()->json([
                'faild' => 'You have booked session before'
            ]);
        }

        SessionStudent::create([
            'session_id' => $req->id,
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
        ->where('course_id', $session->lesson?->chapter?->course_id ?? $session->course?->id)
        ->where('number', '>', 0)
        ->first();

        if ( !empty($small_package) || count($package) != 0 ) {
            session()->flash('success','You are booking success');
            return response()->json([
                'success' => 'You are booking success'
            ]);
        }
        else {
            session()->flash('faild','You must have live sessions in your live package to reserve any session');
            return response()->json([
                'msg' => 'You must have live sessions in your live package to reserve any session'
            ]);
        }
    }

    public function stu_sessions_api(){
        $currentDate = Carbon::now();
        $newDate = $currentDate->addDay();
        $booking = SessionStudent::
        where('user_id', auth()->user()->id)
        ->pluck('session_id');

        $private_req = Session::where('type', 'private')
        ->where('date', '<=', $newDate)
        ->where('date', '>=', now())
        ->whereIn('id', $booking)
        ->with('teacher')
        ->with('lesson')
        ->orderByDesc('id')
        ->get();

        return response()->json([
            'sessions' => $private_req
        ]);
    }

}
