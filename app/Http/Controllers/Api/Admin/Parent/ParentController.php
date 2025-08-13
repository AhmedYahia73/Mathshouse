<?php

namespace App\Http\Controllers\Api\Admin\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\SupParent;
use App\Models\User;

class ParentController extends Controller
{
    public function __construct(private SupParent $parents,
    private User $student){}

    public function view(Request $request){
        $parents = $this->parents
        ->with('students:id,nick_name')
        ->get();
        $students = $this->student
        ->select('id', 'nick_name')
        ->where('position', 'student')
        ->get();

        return response()->json([
            'parents' => $parents,
            'students' => $students,
        ]);
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:sup_parents,email'],
            'phone' => ['required', 'unique:sup_parents,phone'],
            'password' => ['required'],
            'status' => ['required', 'boolean'],
            'student_ids.*' =>['exists:users,id'],
            'student_ids' =>['array'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $parentRequest = $validator->validated();
        $parent = $this->parents
        ->create($parentRequest);
        if($request->student_ids && count($request->student_ids) > 0){
            $parent->students()->attach($request->student_ids);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => ['sometimes'],
            'email' => ['sometimes', 'email', 'unique:sup_parents,email,' . $id],
            'phone' => ['sometimes', 'unique:sup_parents,phone,' . $id],
            'password' => ['sometimes'],
            'status' => ['sometimes', 'boolean'],
            'student_ids.*' =>['exists:users,id'],
            'student_ids' =>['array'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

       $parent = $this->parents
       ->where('id', $id)
        ->first();
        $parent->name = $request->name ?? $parent->name;
        $parent->email = $request->email ?? $parent->email;
        $parent->phone = $request->phone ?? $parent->phone;
        $parent->password = bcrypt($request->password) ?? $parent->password;
        $parent->status = $request->status ?? $parent->status;
        $parent->save();
        if($request->student_ids){
            $parent->students()->sync($request->student_ids);
        }

        return response()->json([
            'success' => 'You update data success'
        ]);
    }

    public function delete(Request $request, $id){
       $parent = $this->parents
       ->where('id', $id)
        ->delete();

        return response()->json([
            'success' => 'You delete data success'
        ]);
    }
}
