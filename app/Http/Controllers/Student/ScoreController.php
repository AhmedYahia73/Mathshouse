<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\StudentQuizze;
use App\Models\LiveCourse;
use App\Models\Session;
use App\Models\SessionStudent;

class ScoreController extends Controller
{
    public function score_sheet(){
        $lessons = Lesson::
        with('quizze')
        ->get();
        $chapters = Chapter::all();
        $courses = Course::all();

        return view('Student.ScoreSheet.ScoreSheet', compact('lessons', 'chapters', 'courses'));
    }

    public function lesson_score_sheet( Request $req ) {
        $data = StudentQuizze::
        where('student_id', auth()->user()->id)
        ->where('lesson_id', $req->lesson_id)
        ->with('quizze')
        ->get();
        $arr = [];
        foreach ( $data as $item ) {
            $arr[$item->quizze_id] = $item;
        }

        return response()->json([
            'data' => array_values($arr)
        ]);
    }

    public function course_score_sheet( Request $req ) {
        // https://login.mathshouse.net/api/course_score_sheet
        // Keys
        // course_id
        $studentId = auth()->user()->id;
        $data = Chapter::
        where('course_id', $req->course_id)
        ->with(['lessons.quizs.student_quizs' => function($query) use ($studentId) {
            $query->where('student_id', $studentId);
        }])
        ->get();
        foreach ($data as $item) {
            foreach ($item->lessons as $element) {
                $sessions = Session::where('lesson_id', $element->id)
                ->get();
                $live_attend = SessionStudent::
                whereIn('session_id', $sessions->pluck('id'))
                ->where('user_id', auth()->user()->id)
                ->first();
                $element->live_attend = empty($live_attend) ? 'Absent' : 'Attend';
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }

    // public function fetchChapters(Request $request) {
    //     // Fetch the specific chapter by chapter_id with its associated lessons
    //     $studentId = auth()->user()->id;

    //     $chapter = Chapter::where('id', $request->chapter_id)
    //         ->with(['lessons.quizs.student_quizs' => function($query) use ($studentId) {
    //             $query->where('student_id', $studentId);
    //         }])
    //         ->first();

    //     // Loop through the lessons to determine attendance
    //     foreach ($chapter->lessons as $element) {
    //         // Get sessions for each lesson
    //         $sessions = Session::where('lesson_id', $element->id)->get();

    //         // Check attendance for the logged-in user
    //         $live_attend = SessionStudent::whereIn('session_id', $sessions->pluck('id'))
    //             ->where('user_id', $studentId)
    //             ->first();

    //         // Set attendance status
    //         $element->live_attend = empty($live_attend) ? 'Absent' : 'Attend';
    //     }

    //     // Return the chapter and its lessons as JSON response
    //     return response()->json(['chapter' => $chapter]);
    // }

    // public function fetchLessons(Request $request) {
    //     $studentId = auth()->user()->id;

    //     // Fetch lessons along with chapter name and associated quizzes for the logged-in student
    //     $lessons = Lesson::select('lessons.*', 'chapters.chapter_name')
    //         ->join('chapters', 'lessons.chapter_id', '=', 'chapters.id')
    //         ->where('lessons.chapter_id', $request->chapter_id)
    //         ->with(['quizs.student_quizs' => function($query) use ($studentId) {
    //             $query->where('student_id', $studentId); // Filter student quizzes by student ID
    //         }])
    //         ->get();

    //     // Loop through each lesson to determine attendance
    //     foreach ($lessons as $lesson) {
    //         // Get sessions for each lesson
    //         $sessions = Session::where('lesson_id', $lesson->id)->get();

    //         // Check attendance for the logged-in user
    //         $live_attend = SessionStudent::whereIn('session_id', $sessions->pluck('id'))
    //             ->where('user_id', $studentId)
    //             ->first();

    //         // Set attendance status
    //         $lesson->live_attend = empty($live_attend) ? 'Absent' : 'Attend';
    //     }

    //     // Return the lessons along with attendance status as JSON response
    //     return response()->json(['lessons' => $lessons]);
    // }



    // public function fetchChapters(Request $request) {
    //     $chapters = Chapter::where('course_id', $request->course_id)->get();
    //     return response()->json(['chapters' => $chapters]);
    // }

    // public function fetchChapters(Request $request) {
    //     // Fetch the specific chapter by chapter_id with its associated lessons
    //     $studentId = auth()->user()->id;
    //     $chapter = Chapter::where('id', $request->chapter_id)
    //                         ->with(['lessons.quizs.student_quizs' => function($query) use ($studentId) {
    //                             $query->where('student_id', $studentId);
    //                         }])
    //                         ->first();

    //     // Return the chapter and its lessons as JSON response
    //     return response()->json(['chapter' => $chapter]);
    // }

    // public function fetchLessons(Request $request) {
    //     $studentId = auth()->user()->id;
    //     $lessons = Lesson::select('lessons.*', 'chapters.chapter_name')
    //     ->join('chapters', 'lessons.chapter_id', '=', 'chapters.id')
    //     ->where('lessons.chapter_id', $request->chapter_id)
    //     ->with(['quizs.student_quizs' => function($query) use ($studentId) {
    //         $query->where('student_id', $studentId); // Filter student quizzes by student ID
    //     }])
    //     ->get();
    //     return response()->json(['lessons' => $lessons]);
    // }

    public function student_courses( Request $req ) {
        // https://login.mathshouse.net/api/student_courses
        $courses = LiveCourse::
        where('user_id', auth()->user()->id)
        ->with('course')
        ->get();

        return response()->json([
            'courses' => $courses
        ]);
    }

}
