<?php

namespace App\Http\Controllers\Api\Parent\AddStudent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyEmail; 
use App\Mail\ForgetPassword as ForgetPasswordEmail;

use App\Models\ParentCode;
use App\Models\User;
use App\Models\SupParent;

class AddStudentController extends Controller
{
    public function __construct(private ParentCode $parent_code,
    private User $user, private SupParent $parent){}

    public function add_student(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        } 
        $user = $this->user
        ->where('id', $request->user_id)
        ->first();
        $code = rand(100000, 999999);
        $this->parent_code
        ->create([
            'parent_id' => $request->user()->id,
            'student_id' => $request->user_id,
            'code' => $code,
        ]);
        Mail::To($user->email)->send(new ForgetPasswordEmail($user->id, $code));
        
        return response()->json([
            'success' => 'Check student email'
        ]);
    }

    public function check_code(Request $request){
        $validator = Validator::make($request->all(), [
            'code' => 'required',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        } 
        $parent_code = $this->parent_code
        ->where('parent_id', $request->user()->id)
        ->where('code', $request->code)
        ->first();
        if(empty($parent_code)){
            return response()->json([
                'errors' => 'Code is wrong',
            ], 400);
        }
        $request->user()->students()->attach($parent_code->student_id);
        return response()->json([
            'success' => 'You check data success'
        ]);
    }
}
