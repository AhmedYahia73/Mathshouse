<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MarketingPopup;

class Stu_DashboardController extends Controller
{
    
    public function index( Request $req ){
        
        $popup = MarketingPopup::
        where('starts', '<=', now())
        ->where('ends', '>=', now())
        ->whereHas('popup_pages', function($query){
            $query->where('page_name', 'Student Dashboard');
        })
        ->get();

        return view('Student.Dashboard.Dashboard', compact('popup'));
    }
    
}
