<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\SessionGroup;
use App\Models\User;

class AcademicController extends Controller
{
    public function __construct(private Category $categories,
    private Course $courses, private Chapter $chapters,
    private Lesson $lessons, private SessionGroup $groups,
    private User $students){}

    public function lists(Request $request){
        $categories = $this->categories
        ->select('id', 'cate_name')
        ->get();
        $courses = $this->courses
        ->select('id', 'course_name')
        ->get();
        $chapters = $this->chapters
        ->select('id', 'chapter_name')
        ->get();
        $lessons = $this->lessons
        ->select('id', 'lesson_name')
        ->get();
        $groups = $this->groups
        ->select('id', 'name')
        ->get();
        $students = $this->students
        ->select('id', 'nick_name')
        ->where('position', 'student')
        ->get();

        return response()->json([
            'categories' => $categories,
            'courses' => $courses,
            'chapters' => $chapters,
            'lessons' => $lessons,
            'groups' => $groups,
            'students' => $students,
        ]);
    }

    public function academic(Request $request){

    }
}
