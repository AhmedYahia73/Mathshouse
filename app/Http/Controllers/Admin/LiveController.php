<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\SessionGroup;
use App\Models\GroupDay;
use App\Models\SessionDay;
use App\Models\PrivateRequest;
use App\Models\CancelSession;
use App\Models\SessionStudent;
use App\Models\SessionAttendance;
use App\Models\AcademicCart;
use App\Models\GroupStudent;
use App\Models\TeacherCourse;

class LiveController extends Controller
{
    
    public function index(){
        $sessions = Session::
        orderByDesc('id')
        ->simplePaginate(10);
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();
        $users = User::
        where('position', 'student')
        ->get();
        $groups = SessionGroup::get();
        $types = ['explanation','re_explanation', 'mistakes'];
        return view('Admin.Live.Live', 
        compact('sessions', 'groups', 'users', 'categories', 
        'courses', 'chapters', 'lessons','types', 'teachers'));
    }

    public function live_calender(){
        $sessions = Session::
        with('days')
        ->get();

        return view('Admin.Live.Calender');
    }

    public function session_edit( $id, Request $req ){
        $arr = $req->only('link', 'name', 'date', 'from', 'to', 'lesson_id', 
        'type', 'access_dayes', 'price', 'session_types','teacher_id', 'group_id', 
        'material_link', 'teacher_material');
        $req->validate([
            'link' => 'required',
            'date' => 'required',
            'from' => 'required',
            'to' => 'required',
            'lesson_id' => 'sometimes',
            'type' => 'required',
            'teacher_id' => 'required|numeric',
            'teacher_material' => 'required',
        ]);
        if($arr['session_types'] == 'mistakes'){
            $arr['lesson_id'] = Null;
        }
        $sessions = Session::
        where('id', $id)
        ->update($arr);

        if ( !empty($req->group_id)  && !empty($req->user_id) ) {
            $group_students = GroupStudent::
            where('group_id', $req->group_id)
            ->pluck('stu_id');
            $arr = array_merge( $group_students->toArray(), $req->user_id);
            $arr = array_unique($arr);
            $arr = array_values($arr);
            
            SessionStudent::where('session_id', $id)
            ->delete();

            for ($i=0, $end = count($arr); $i < $end; $i++) { 
                SessionStudent::create([
                    'session_id' => $id,
                    'user_id' => intval($arr[$i]),
                ]);
            }
        }
        elseif ( !empty($req->group_id) ) {
            $group_students = GroupStudent::
            where('group_id', $req->group_id)
            ->pluck('stu_id');

            SessionStudent::where('session_id', $id)
            ->delete();

            for ($i=0, $end = count($group_students); $i < $end; $i++) { 
                SessionStudent::create([
                    'session_id' => $id,
                    'user_id' => $group_students[$i],
                ]);
            }
        }
        elseif ( !empty($req->user_id) ) {
            SessionStudent::where('session_id', $id)
            ->delete();

            for ($i=0, $end = count($req->user_id); $i < $end; $i++) { 
                SessionStudent::create([
                    'session_id' => $id,
                    'user_id' => $req->user_id[$i],
                ]);
            }
        }
        
        return redirect()->back();
    }
    

    public function filter_live( Request $req ){
        $sessions = SessionStudent::
        where('user_id', auth()->user()->id)
        ->orderByDesc('id');
        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();
        $data = $req->all();
        if ( !empty($req->course_id) ) {
            $course_id = $req->course_id;
            $sessions = $sessions->whereHas('session.lesson.chapter', function($query) use($course_id){
                $query->where('course_id', $course_id);
            })
            ->get();
        }
        elseif ( !empty($req->category_id) ) {
            $category_id = $req->category_id;
            $sessions = $sessions->whereHas('session.lesson.chapter.course', function($query) use($category_id){
                $query->where('category_id', $category_id);
            })
            ->get();
        } 
        if ( !empty($req->teacher_id) ) {
            $teacher_id = $req->teacher_id;
            $sessions = $sessions->whereHas('session', function($query) use($teacher_id){
                $query->where('teacher_id', $teacher_id);
            })
            ->get();
        }
        if ( !empty($req->date) ) { 
            $date = $req->date;
            $sessions = $sessions->whereHas('session', function($query) use($date){
                $query->where('date', $date);
            })
            ->get();
        }
        if ( empty($req->course_id) && empty($req->category_id) && empty($req->teacher_id) && empty($req->date) ) {
            
            $sessions = $sessions->get();
        }
        
        return view('Student.Live.Live', compact('sessions', 'categories', 'courses', 'teachers', 'data'));
    }

    public function del_session( $id ){
        Session::
        where('id', $id)
        ->delete();
        
        return redirect()->back();
    }

    public function add_session( Request $req ){
         
        $arr = $req->only('link', 'date', 'from', 'to', 'lesson_id', 'name', 'material_link',
        'type', 'teacher_id', 'price', 'course_id','session_types','access_dayes', 'group_id', 
        'teacher_material');
        
        $req->validate([
            'link' => 'required',
            'name' => 'required',
            'date' => 'required',
            'from' => 'required',
            'to' => 'required',
            'lesson_id' => 'sometimes',
            'type' => 'required',
            'teacher_id' => 'required',
            'teacher_material' => 'required',
        ]);
        if($arr['session_types'] == 'mistakes'){
            $arr['lesson_id'] = Null;
        }
        $session = Session::create($arr);
        
        if ( !empty($req->group_id) ) {
            $group_students = GroupStudent::
            where('group_id', $req->group_id)
            ->pluck('stu_id');

            for ($i=0, $end = count($group_students); $i < $end; $i++) { 
                SessionStudent::create([
                    'session_id' => $session->id,
                    'user_id' => $group_students[$i],
                ]);
            }
        }
        if ( !empty($req->user_id) ) {
            for ($i=0, $end = count($req->user_id); $i < $end; $i++) { 
                SessionStudent::create([
                    'session_id' => $session->id,
                    'user_id' => $req->user_id[$i],
                ]);
            }
        }
        
        return redirect()->back();
    }

    public function session_g(){
        $session_g = SessionGroup::
        orderByDesc('id')
        ->simplePaginate(10);
        $teachers = User::where('position', 'teacher')
        ->get();
        $students = User::where('position', 'student')
        ->get();
        return view('Admin.Live.Groups', 
        compact('session_g', 'teachers', 'students'));
    }

    public function g_session_add( Request $req ){
        $arr = $req->only('name', 'teacher_id', 'state');
        $req->validate([
            'name' => 'required',
            'teacher_id' => 'required'
        ]);
        $session_g = SessionGroup::create($arr);
        for ($i=0, $end = count($req->stu_id); $i < $end; $i++) { 
            GroupStudent::create([
                'group_id' => $session_g->id,
                'stu_id' => $req->stu_id[$i],
            ]);
        }
        for ($i=0, $end = count($req->day); $i < $end; $i++) {
            GroupDay::create([
                'day' => $req->day[$i],
                'from' => $req->from[$i],
                'to' => $req->to[$i],
                'group_id' => $session_g->id,
            ]);
        }

        return redirect()->back();
    }

    public function g_session_edit( Request $req ){ 
        $arr = $req->only('name', 'teacher_id');
        $arr['state'] = isset($req->state) ? 1 : 0;
        $req->validate([
            'name' => 'required',
            'teacher_id' => 'required'
        ]);
        SessionGroup::where('id', $req->id)
        ->update($arr);
        
        GroupStudent::where('group_id', $req->id)
        ->delete();
        for ($i=0, $end = count($req->stu_id); $i < $end; $i++) { 
            GroupStudent::create([
                'group_id' => $req->id,
                'stu_id' => $req->stu_id[$i],
            ]);
        }

        GroupDay::where('group_id', $req->id)
        ->delete();
        if ($req->day) {
            for ($i=0, $end = count($req->day); $i < $end; $i++) { 
                GroupDay::create([
                    'day' => $req->day[$i],
                    'from' => $req->from[$i],
                    'to' => $req->to[$i],
                    'group_id' => $req->id
                ]);
            }
        }
        
        return redirect()->back();
    }

    public function del_session_g( $id ){
        SessionGroup::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function ad_academic(){
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $students = User::where('position', 'student')->get();
        $groups = SessionGroup::all();

        return view('Admin.Live.Academic.Academic', compact('categories', 
        'courses', 'chapters', 'lessons', 'students', 'groups'));
    }

    public function ad_filter_academic( Request $req ){
        if ( !isset($req->category_id) || !isset($req->course_id) ) {
            session()->flash('faild','You Must Enter Category & Course & Chapter');
           return redirect()->back();
        }
        $users = [];

        if ( !isset($req->chapter_id) ) {
            $chapters = Chapter::where('course_id', $req->course_id)
            ->pluck('id');
            $u_lessons = Lesson::whereIn('chapter_id', $chapters)
            ->get();
        }
        elseif( !isset($req->lesson_id) ){
            $u_lessons = Lesson::where('chapter_id', $req->chapter_id)
            ->get();
        }
        else {
            $u_lessons = Lesson::where('id', $req->lesson_id)
            ->get();
        }

        if ( isset($req->group_id) && $req->group_id ) {
            $s_groups = SessionGroup::whereIn('id', $req->group_id)
            ->get();
            foreach ($s_groups as $key => $item) {
                foreach ( $item->students as $element ) {
                    $users[] = $element;
                }
            }
        }
        elseif ( isset($req->user_id) ) {
            $users = User::where('position', 'student')
            ->whereIn('id', $req->user_id)
            ->get();
        }
        else{
            $users = User::where('position', 'student') 
            ->get();
        }
        
        if( !isset($req->lesson_id) && isset($req->state) ){
            session()->flash('faild','You Must Enter Lesson');
           return redirect()->back();
        }
        $state = isset($req->state)  ? $req->state : null;
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $students = User::where('position', 'student')->get();
        $groups = SessionGroup::all();
        $data = $req->all();
        
        AcademicCart::truncate();
        $ac_data = $req->all();
        
        return view('Admin.Live.Academic.FilterAcademic', compact('u_lessons',
        'categories', 'courses', 'chapters', 'lessons', 'students', 'groups', 'users', 'state',
        'ac_data', 'data'));
    }

    public function cancelation(){
        $cancelations = CancelSession::
        orderByDesc('id')
        ->where('statue', '!=', 'Approve')
        ->get();
        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();

        return view('Admin.Live.Cancelation', 
        compact('cancelations', 'categories', 'courses', 'teachers'));
    }

    public function filter_cancelation( Request $req ){
        $cancelations = CancelSession::
        orderByDesc('id')
        ->where('statue', '!=', 'Approve');
        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();
        $data = $req->all();

        if ( !empty($req->date) ) { 
            $date = $req->date;
            $cancelations = $cancelations->where('date', $date);
        }
        if ( !empty($req->course_id) ) {
            $course_id = $req->course_id;
            $cancelations = $cancelations->whereHas('session.lesson.chapter', function($query) use($course_id){
                $query->where('course_id', $course_id);
            })->get();
        }
        elseif ( !empty($req->category_id) ) {
            $category_id = $req->category_id;
            $cancelations = $cancelations->whereHas('session.lesson.chapter.course', function($query) use($category_id){
                $query->where('category_id', $category_id);
            })->get();
        }
        if ( empty($req->course_id) && empty($req->category_id) ) {
            $cancelations = $cancelations->get();
        }
        if ( !empty($req->teacher_id) ) {
            $teacher_id = $req->teacher_id;
            $cancelations = $cancelations->filter(function($query) use ($teacher_id) {
                return $query->session->teacher_id == $teacher_id;
            });;
        }

        return view('Admin.Live.Cancelation', 
        compact('cancelations', 'categories', 'courses', 'teachers', 'data'));
    }

    public function approve_cancelation( $id ){
        CancelSession::
        where('id', $id)
        ->update([
            'statue' => 'Approve'
        ]);

        return redirect()->back();
    }

    public function reject_cancelation( $id ){
        CancelSession::
        where('id', $id)
        ->update([
            'statue' => 'Rejected'
        ]);

        return redirect()->back();
    }

    public function private_request( ){
        $users = User::
        get(); 
        
        return view('Admin.Live.PrivateRequest', compact('users'));
    }

    public function student_private_request( ){
    }

    public function private_session_approve( $id ){
        PrivateRequest::
        where('id', $id)
        ->update([
            'status' => 'Confirm',
        ]);

        return redirect()->route('sessions');
    }

    public function private_request_rejected( Request $req ){
        PrivateRequest::
        where('id', $req->id)
        ->update([
            'status' => 'Rejected',
            'rejected_reason' => $req->reject_reason,
        ]);

        return redirect()->back();
    }

    public function teacher_session(){
        $sessions = Session::get();

        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();

        return view('Admin.Live.SessionTeacher', compact('sessions', 'categories', 'courses', 'teachers'));
    }

    public function filter_teacher_session( Request $req ){
        $sessions = Session::orderByDesc('id');

        $categories = Category::all();
        $courses = Course::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();
        $data = $req->all();
        if ( !empty($req->teacher_id) ) {
            $teacher_id = $req->teacher_id;
            $sessions = $sessions->where('teacher_id', $teacher_id);
        }
        if ( !empty($req->date) ) { 
            $date = $req->date;
            $sessions = $sessions->where('date', $date);
        }
        if ( !empty($req->course_id) ) {
            $course_id = $req->course_id;
            $sessions = $sessions->whereHas('lesson.chapter', function($query) use($course_id){
                $query->where('course_id', $course_id);
            })->get();
        }
        elseif ( !empty($req->category_id) ) {
            $category_id = $req->category_id;
            $sessions = $sessions->whereHas('lesson.chapter.course', function($query) use($category_id){
                $query->where('category_id', $category_id);
            })->get();
        }
        if ( empty($req->course_id) && empty($req->category_id) ) {
            $sessions = $sessions->get();
        }
        
        
        return view('Admin.Live.SessionTeacher', 
        compact('sessions', 'categories', 'courses', 'teachers', 'data'));
    }

    public function ad_private_requests(){
        return view('Admin.Live.PrivateRequestsShow');
    }

    public function teacher_courses( Request $req ){
        $teacher = TeacherCourse::
        where( 'course_id', $req->course_id )
        ->with('user')
        ->get();

        return response()->json([
            'teacher' => $teacher,
        ]);
    }

}
