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
    public function __construct(private Session $session, 
    private Category $category, private Course $course,
    private Chapter $chapter, private Lesson $lesson, 
    private User $user, private SessionGroup $session_group){}

    public function view(Request $request){ 
        $sessions = $this->session
        ->orderByDesc('id')
        ->simplePaginate(10);
        $categories = $this->category->get();
        $courses = $this->course->get();
        $chapters = $this->chapter->get();
        $lessons = $this->lesson->get();
        $teachers = $this->user
        ->where('position', 'teacher')
        ->get();
        $users = $this->user
        ->where('position', 'student')
        ->get();
        $groups = $this->session_group->get();
        $types = ['explanation','re_explanation', 'mistakes'];

        return response()->json([
            'sessions' => $sessions,
            'categories' => $categories,
            'courses' => $courses,
            'chapters' => $chapters,
            'lessons' => $lessons,
            'teachers' => $teachers,
            'users' => $users,
            'groups' => $groups,
            'types' => $types,
        ]);
    }

    public function create(Request $request){
        
    }

    public function modify(Request $request){
        
    }

    public function delete(Request $request){
        
    }
}
