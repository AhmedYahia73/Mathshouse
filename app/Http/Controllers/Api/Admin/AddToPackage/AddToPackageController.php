<?php

namespace App\Http\Controllers\Api\Admin\AddToPackage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\SmallPackage;
use App\Models\User;

class AddToPackageController extends Controller
{
    public function lists(Request $request){
        $students = User::
        select('id', 'nick_name', 'phone')
        ->where('position', 'student')
        ->get();
        $modules = ['Exam', 'Question', 'Live'];

        return response()->json([
            'students' => $students,
            'modules' => $modules,
        ]);
    }

    public function stu_package_add( Request $request ){
        $validator = Validator::make($request->all(), [
            'module'  => ['required', 'in:Exam,Question,Live'],
            'number'  => ['required', 'numeric'],
            'user_id'  => ['required', 'exists:users,id'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $packageRequest = $validator->validated();
        $packageRequest['admin_id'] = auth()->user()->id;
        SmallPackage::create($packageRequest);
        
        return response()->json([
            'success' => 'You Add Data Success'
        ]);
    }
}
