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
            ];
        });
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
            'sessions' => $sessions,
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
            'lesson_id' => ['required', 'exists:lessons,id'], 
            'course_id' => ['exists:courses,id'], 
            'teacher_id' => ['required', 'exists:users,id'], 
            'group_id' => ['exists:session_groups,id'],
            'type' => ['required', 'in:group,private,session'],  
            'session_types' => ['required', 'in:explanation,re_explanation,mistakes'],
            'teacher_material'  => ['sometimes']
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $sessionRequest = $request->only($this->sessionRequest);
        $this->session
        ->create($sessionRequest);

        return response()->json([
            'success' => 'You add session success',
        ]);
    }

    public function modify(Request $request, $id){
        
    }

    public function delete(Request $request, $id){
        
    }
}
