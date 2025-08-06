<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class GradeReportController extends Controller
{
    public function __construct(private User $users){}

    public function view(Request $request){
        $users = $this->users
        ->where('position', 'student')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'email' => $item->email,
                'phone' => $item->phone,
                'nick_name' => $item->nick_name,
                'grade' => 'Grade ' . $item->grade,
            ];
        });

        return response()->json([
            'users' => $users
        ]);
    }

    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'grade' => ['numeric', 'min:1', 'max:13'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $users = $this->users
        ->where('position', 'student')
        ->where('grade', $request->grade)
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'email' => $item->email,
                'phone' => $item->phone,
                'nick_name' => $item->nick_name,
                'grade' => 'Grade ' . $item->grade,
            ];
        });

        return response()->json([
            'users' => $users
        ]);
    }
}
