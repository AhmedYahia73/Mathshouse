<?php

namespace App\Http\Controllers\Api\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;

class HomeController extends Controller
{
    public function view(Request $request){
        $active_students = User::
        where('position', 'student')
        ->where('state', 'Show')
        ->count();
        $banned_students = User::
        where('position', 'student')
        ->where('state', 'hidden')
        ->count();
        $teachers = User::
        where('position', 'teacher') 
        ->count();
        $affilates = User::
        where('position', 'affilate') 
        ->count();
        $all_students = $active_students + $banned_students;
        $categories = Category::
        count(); 
        $courses = Course::
        count();
        $chapter = Chapter::
        count();
        $lessons = Lesson::
        count();

        return response()->json([
            'active_students' => $active_students,
            'banned_students' => $banned_students,
            'teachers' => $teachers,
            'affilates' => $affilates,
            'all_students' => $all_students,
            'categories' => $categories,
            'courses' => $courses,
            'chapter' => $chapter,
            'lessons' => $lessons,
        ]);
    }
}
