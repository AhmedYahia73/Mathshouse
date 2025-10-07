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
        return redirect('https://mathshouse.net');
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
