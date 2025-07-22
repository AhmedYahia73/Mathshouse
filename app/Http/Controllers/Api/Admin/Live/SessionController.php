<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Session;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\SessionGroup;

class SessionController extends Controller
{
    public function __construct(private Session $session, 
    private Category $category, private Course $course,
    private Chapter $chapter, private Lesson $lesson, 
    private User $user, private SessionGroup $session_group){}

    public $sessionRequest = [ 
        'date', 
        'name',
        'link', 
        'material_link',
        'from', 
        'to', 
        'lesson_id', 
        'course_id', 
        'teacher_id', 
        'group_id',
        'type',  
        'session_types',
        'teacher_material',
    ];

    public function view(Request $request){ 
        $sessions = $this->session
        ->orderByDesc('id')
        ->get()
        ->map(function($item){ 
            return [
                'id' => $item->id,
                'name' => $item->name,
                'date' => $item->date,
                'link' => $item->link,
                'material_link' => $item->material_link,
                'from' => $item->from,
                'to' => $item->to, 
                'type' => $item->type, 
                'access_dayes' => $item->access_dayes,
                'repeat' => $item->repeat,
                'session_types' => $item->session_types,
                'lesson_id' => $item->lesson_id,
                'teacher_id' => $item->teacher_id,
                'group_id' => $item->group_id,
                'course_id' => $item->course_id, 
                'course' => $item?->course?->course_name,
                'lesson' => $item?->session_lesson?->lesson_name,
                'teacher' => $item?->teacher?->nick_name,
                'group' => $item?->group?->name,
                'users' => $item?->users?->select('id', 'nick_name')
            ];
        });

        return response()->json([
            'sessions' => $sessions,
        ]);
    }

    public function lists(Request $request){  
        $categories = $this->category->get();
        $courses = $this->course->get();
        $chapters = $this->chapter->get();
        $lessons = $this->lesson->get();
        $teachers = $this->user
        ->where('position', 'teacher')
        ->get();
        $users = $this->user
        ->where('position', 'student')
        ->get();
        $groups = $this->session_group->get();
        $types = ['explanation','re_explanation', 'mistakes'];

        return response()->json([ 
            'categories' => $categories,
            'courses' => $courses,
            'chapters' => $chapters,
            'lessons' => $lessons,
            'teachers' => $teachers,
            'users' => $users,
            'groups' => $groups,
            'types' => $types,
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date'], 
            'name' => ['required'],
            'link' => ['required'], 
            'material_link' => ['required'],
            'from' => ['required', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'], 
            'to' => ['required', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'], 
            'lesson_id' => ['exists:lessons,id'], 
            'course_id' => ['exists:courses,id'], 
            'teacher_id' => ['required', 'exists:users,id'], 
            'group_id' => ['exists:session_groups,id'],
            'type' => ['required', 'in:group,private,session'],  
            'session_types' => ['required', 'in:explanation,re_explanation,mistakes'],
            'teacher_material'  => ['sometimes'],
            'users' => ['array'],
            'users.*' => ['exists:users,id'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $sessionRequest = $request->only($this->sessionRequest);
        $session = $this->session
        ->create($sessionRequest);
        if($request->users){
            $session->users()->attach($request->users);
        }

        return response()->json([
            'success' => 'You add session success',
        ]);
    }

    public function modify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'date' => ['nullable', 'date'], 
            'name' => ['nullable'],
            'link' => ['nullable'], 
            'material_link' => ['nullable'],
            'from' => ['nullable', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'], 
            'to' => ['nullable', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'], 
            'lesson_id' => ['nullable', 'exists:lessons,id'], 
            'course_id' => ['exists:courses,id'], 
            'teacher_id' => ['nullable', 'exists:users,id'], 
            'group_id' => ['exists:session_groups,id'],
            'type' => ['nullable', 'in:group,private,session'],  
            'session_types' => ['nullable', 'in:explanation,re_explanation,mistakes'],
            'teacher_material'  => ['sometimes']
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $session = $this->session
        ->where('id', $id)
        ->first();
        $session->date = $request->date ?? $session->date;
        $session->name = $request->name ?? $session->name;
        $session->link = $request->link ?? $session->link;
        $session->material_link = $request->material_link ?? $session->material_link;
        $session->from = $request->from ?? $session->from;
        $session->to = $request->to ?? $session->to;
        $session->lesson_id = $request->lesson_id ?? $session->lesson_id;
        $session->course_id = $request->course_id ?? $session->course_id;
        $session->teacher_id = $request->teacher_id ?? $session->teacher_id;
        $session->group_id = $request->group_id ?? $session->group_id;
        $session->type = $request->type ?? $session->type;
        $session->session_types = $request->session_types ?? $session->session_types;
        $session->teacher_material = $request->teacher_material ?? $session->teacher_material;
        $session->save();
        if($request->users){
            $session->users()->sync($request->users);
        }

        return response()->json([
            'success' => 'You update session success'
        ]);
    }

    public function delete(Request $request, $id){ 
        $session = $this->session
        ->where('id', $id)
        ->delete();

        return response()->json([
            'success' => 'You delete session success'
        ]);
    }
}
