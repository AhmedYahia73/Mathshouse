<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\MarketingPopup;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        $slider = Slider::all();
        $courses = Course::all();
        $popup = MarketingPopup::
        where('starts', '<=', now())
        ->where('ends', '>=', now())
        ->whereHas('popup_pages', function($query){
            $query->where('page_name', 'Home');
        })
        ->get();
        
        return view('Visitor.Home.Home', compact('slider', 'popup', 'courses'));
    }

    public function v_about(Request $request){
        return view('Visitor.About.About');
    }

    public function v_contact(Request $request){
        return view('Visitor.Contact.Contact');
    }

    public function home_data(Request $request){
    
        $courses = Course::count();
        $chapters = Chapter::count();
        $lessons = Lesson::count();
        $students = User::
        where('position', 'student')
        ->count();
        $teachers = User::
        where('position', 'teacher')
        ->count();

        return response()->json([
            'courses' => $courses,
            'chapters' => $chapters,
            'lessons' => $lessons,
            'students' => $students,
            'teachers' => $teachers,
        ]);
    }
}
