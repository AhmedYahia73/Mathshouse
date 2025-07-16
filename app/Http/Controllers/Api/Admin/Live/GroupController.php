<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'group_days' => ['required', 'array'],
            'group_days.*.day' => ['required', 'in:Sat,Sun,Mon,Tues,Wed,Thurs,Fri'],
            'group_days.*.from' => ['required', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'],
            'group_days.*.to' => ['required', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'],
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
        $group_days = $request->group_days;
        foreach($group_days as $item){
            $this->group_day
            ->create([
                'group_id' => $session_group->id,
                'day' => $item['day'],
                'from' => $item['from'],
                'to' => $item['to'],
            ]);
        }

        return response()->json([
            'success' => 'You add session success',
        ]);
    }

    public function modify(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => ['nullable'],
            'teacher_id' => ['nullable', 'exists:users,id'], 
            'state' => ['nullable', 'boolean'],
            'student_ids' => ['nullable'],
            'student_ids.*' => ['nullable', 'exists:users,id'],
            'group_days' => ['nullable', 'array'],
            'group_days.*.day' => ['nullable', 'in:Sat,Sun,Mon,Tues,Wed,Thurs,Fri'],
            'group_days.*.from' => ['nullable', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'],
            'group_days.*.to' => ['nullable', 'regex:/^([01]\d|2[0-3]):[0-5]\d:[0-5]\d$/'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        
        $session_group = $this->session_group
        ->where('id', $id)
        ->first();
        $session_group->name = $request->name ?? $session_group->name;
        $session_group->teacher_id = $request->teacher_id ?? $session_group->teacher_id;
        $session_group->state = $request->state ?? $session_group->state;
        $session_group->save();
        
        $group_days = $request->group_days;
        if (!empty($request->student_ids)) { 
            $session_group->students()->sync($request->student_ids);
        }
        if (!empty($group_days)) {
            $this->group_day
            ->where('group_id', $session_group->id)
            ->delete();
            foreach($group_days as $item){
                $this->group_day
                ->create([
                    'group_id' => $session_group->id,
                    'day' => $item['day'],
                    'from' => $item['from'],
                    'to' => $item['to'],
                ]);
            }
        }

        return response()->json([
            'success' => 'You update session success'
        ]);
    }

    public function delete(Request $request, $id){ 
        $session_group = $this->session_group
        ->where('id', $id)
        ->delete();

        return response()->json([
            'success' => 'You delete session success'
        ]);
    }
}
