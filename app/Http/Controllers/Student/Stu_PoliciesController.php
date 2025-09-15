<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Stu_PoliciesController extends Controller
{
    public function privacy(){
        return view('Student.Privacy.Privacy');
    } 

    public function support(){
        return view('Student.Privacy.Support');
    }
}
