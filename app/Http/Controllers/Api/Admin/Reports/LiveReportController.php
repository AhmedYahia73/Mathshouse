<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class LiveReportController extends Controller
{
    public function __construct(){}

    public function view(Request $request){
        $users = $this->user
        ->whereHas('session_attendance')
        ->with('session_attendance')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'student' => $item->nick_name,
                'session' => $item->session_attendance->select('name', 'date'), 
            ];
        });

        return response()->json([
            'users' => $users
        ]);
    }

    public function filter(Request $request){
        $validator = Validator::make($request->all(), [
            'from' => ['sometimes'], 
            'to' => ['sometimes'], 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $users = $this->user 
        ->with('session_attendance');
         
        $from = $request->from;
        $to = $request->to;
        $users = $users
        ->whereHas('session_attendance', function($query) use($from, $to){
            if(!empty($from) && !empty($to)){
                $query->where('date', '>=', $from)
                ->where('date', '<=', $to);
            }
            if(!empty($from)){
                $query->where('date', '>=', $from);
            }
            if(!empty($to)){
                $query->where('date', '<=', $to);
            }
        });

        $users = $users->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'student' => $item->nick_name,
                'session' => $item->session_attendance->select('name', 'date'), 
            ];
        });
        return response()->json([
            'users' => $users
        ]);
    }
}
