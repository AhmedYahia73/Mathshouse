<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TScheduleController extends Controller
{
    public function view(Request $request){
        $page_name = 'Schedule'; 
        return view('Teacher.Schedule.Schedule', compact('page_name'));
    }
}
