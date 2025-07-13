<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SessionGroup;
use App\Models\GroupDay;
use App\Models\User;

class GroupController extends Controller
{
    public function __construct(private SessionGroup $session_group,
    private User $user, private GroupDay $group_day){}

    public $groupRequest = [
        'name', 
        'teacher_id', 
        'state',
    ];

    public function view(Request $request){ 
        $groups = $this->session_group
        ->orderByDesc('id')
        ->get()
        ->map(function($item){ 
            return [
                'id' => $item->id,
                'name' => $item->name,
                'teacher_id' => $item->teacher_id,
                'state' => $item->state,
                'teacher' => $item?->teacher?->nick_name,
                'students' => $item?->students?->select('id', 'nick_name'),
                'days' => $item?->days, 
            ];
        });
        $teachers = $this->user
        ->where('position', 'teacher')
        ->get();
        $students = $this->user
        ->where('position', 'student')
        ->get();

        return response()->json([
            'groups' => $groups, 
            'teachers' => $teachers, 
            'students' => $students, 
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'teacher_id' => ['required', 'exists:users,id'], 
            'state' => ['required', 'boolean'],
            'student_ids' => ['required'],
            'student_ids.*' => ['required', 'exists:users,id'],
            'group_days' => ['required'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $groupRequest = $request->only($this->groupRequest);
        $session_group = $this->session_group
        ->create($sessionRequest);
        $session_group->students()->attach($request->student_ids);
        $group_day;

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
