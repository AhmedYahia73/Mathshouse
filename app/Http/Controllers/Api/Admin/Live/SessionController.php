<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Session;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\SessionGroup;

class SessionController extends Controller
{
    public function __construct(private Session $session){}

    public function view(Request $request){
        
        $sessions = Session::
        orderByDesc('id')
        ->simplePaginate(10);
        $categories = Category::all();
        $courses = Course::all();
        $chapters = Chapter::all();
        $lessons = Lesson::all();
        $teachers = User::
        where('position', 'teacher')
        ->get();
        $users = User::
        where('position', 'student')
        ->get();
        $groups = SessionGroup::get();
        $types = ['explanation','re_explanation', 'mistakes'];
    }

    public function create(Request $request){
        
    }

    public function modify(Request $request){
        
    }

    public function delete(Request $request){
        
    }
}
