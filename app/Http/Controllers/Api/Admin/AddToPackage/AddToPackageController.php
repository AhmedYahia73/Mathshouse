<?php

namespace App\Http\Controllers\Api\Admin\AddToPackage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\SmallPackage;

class AddToPackageController extends Controller
{

    public function stu_package_add( Request $request ){
        $validator = Validator::make($request->all(), [
            'category_id'  => ['required', 'exists:categories,id'],
            'course_id'  => ['required', 'exists:courses,id'],
            'chapter_id'  => ['exists:chapters,id'],
            'lesson_id' => ['required_with:attendance_status', 'exists:lessons,id'],
            'group_ids'  => ['array'],
            'group_ids.*'  => ['exists:session_groups,id'], 
            'students_ids'  => ['array'],
            'students_ids.*'  => ['exists:users,id'],
            'attendance_status' => ['nullable', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        if ($req['student']['number'] < 0) {
            return response()->json([
                'errors' => 'Number must be greater than 0'
            ], 400);
        }
        SmallPackage::create([
            'module' => $req['student']['module'],
            'number' => $req['student']['number'],
            'user_id' => $req['student']['userid'],
            'admin_id' => auth()->user()->id,
        ]);
        
        return response()->json([
            'success' => 'You Add Data Success'
        ]);
    }
}
