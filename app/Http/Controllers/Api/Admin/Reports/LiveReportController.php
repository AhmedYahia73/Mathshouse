<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
