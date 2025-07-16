<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'category_id'  => ['required', 'exists:categories,id'],
            'course_id'  => ['required', 'exists:courses,id'],
            'chapter_id'  => ['exists:chapters,id'],
            'lesson_id' => ['required_with:attendance_status', 'exists:lessons,id'],
            'group_ids'  => ['array'],
            'group_ids.*'  => ['exists:session_groups,id'], 
            'students_ids'  => ['array'],
            'students_ids.*'  => ['exists:users,id'],
            'attendance_status' => ['nullable', 'boolean'],
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $lessons = collect([]);
        if($request->lesson_id){
            $lessons = $this->lessons
            ->select('id', 'lesson_name')
            ->where('id', $request->lesson_id)
            ->get();
        }
        elseif($request->chapter_id){
            $lessons = $this->lessons
            ->select('id', 'lesson_name')
            ->where('chapter_id', $request->chapter_id)
            ->get();
        }
        elseif($request->course_id){
            $lessons = $this->lessons
            ->select('id', 'lesson_name')
            ->whereHas('chapter', function($query) use($request){
                $query->where('course_id', $request->course_id);
            })
            ->get();
        }

        $students = collect([]);
        if ($request->students_ids && count($request->students_ids) > 0) {
            $users = $this->students
            ->whereIn('id', $request->students_ids)
            ->get();
            $students = $students->merge($users);
        }
        if ($request->group_ids && count($request->group_ids) > 0) {
            $users = $this->groups
            ->whereIn('id', $request->group_ids)
            ->with('students')
            ->get()
            ?->pluck('students')
            ->flatten(1);
            $students = $students->merge($users);
        }
        $users = $this->students;

        if (!isset($request->attendance_status) || empty($request->attendance_status)) {
            $students = $students
            ->map(function($item) use($lessons, $users){
                $item->lessons = clone $lessons->map(function($element) use($item, $users){
                    $element = clone $element;
                    $element->attendance = !empty($users
                    ->where('id', $item->id)
                    ->first()
                    ?->attendance($element->id)?->first());
                    return $element;
                });
                return $item;
            });
        }
        else{
            if ($request->attendance_status) {
                $students = $students
                ->map(function($item) use($lessons, $users){
                    $item->lessons = clone $lessons->map(function($element) use($item, $users){
                        $element = clone $element;
                        $element->attendance = !empty($users
                        ->where('id', $item->id)
                        ->first()
                        ?->attendance($element->id)?->first());
                        return $element;
                    });
                    if(@$item->lessons[0]->attendance){
                        return $item;
                    }
                    else{
                        return null;
                    }
                });
            }
            else{
                $students = $students
                ->map(function($item) use($lessons, $users){
                    $item->lessons = clone $lessons->map(function($element) use($item, $users){
                        $element = clone $element;
                        $element->attendance = !empty($users
                        ->where('id', $item->id)
                        ->first()
                        ?->attendance($element->id)?->first());
                        return $element;
                    });
                    if(@$item->lessons[0]->attendance){
                        return null;
                    }
                    else{
                        return $item;
                    }
                });
            }
        }

        return response()->json([
            'lessons' => $lessons,
            'students' => $students,
        ]);
    }
}
