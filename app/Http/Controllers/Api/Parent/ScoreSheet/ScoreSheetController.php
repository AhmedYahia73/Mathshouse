<?php

namespace App\Http\Controllers\Api\Parent\ScoreSheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Session;
use App\Models\SessionStudent;
use App\Models\User;

class ScoreSheetController extends Controller
{
    public function __construct(public Course $courses,
    private User $user){}

    public function lists(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $user = $this->user
        ->where('id', $request->user_id)
        ->first();
        $courses = $this->courses
        ->select('id', 'course_name')
        ->where('category_id', $user->category_id)
        ->get();

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function scoreSheet(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id', 
            'user_id' => 'required|exists:users,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
 
        $user = $this->user
        ->where('id', $request->user_id)
        ->first();
        $data = Chapter::
        select('id', 'chapter_name')
        ->where('course_id', $request->course_id)
        ->with(['lessons' => function($query) use($request) {
            $query
            ->select('id', 'lesson_name', 'chapter_id')
            ->with(['quizs' => function($query2) use($request){
                $query2->select('id', 'title', 'score', 'pass_score', 'lesson_id')
                ->with(['student_quizs' => function($query3) use($request){
                    $query3->select('id', 'quizze_id', 'score', 'time', 'date')
                    ->where('student_id', $request->user_id)
                    ->first();
                }]);
            }]);
        }])
        ->get();
        foreach ($data as $item) {
            foreach ($item->lessons as $element) {
                $sessions = Session::where('lesson_id', $element->id)
                ->get();
                $live_attend = SessionStudent::
                whereIn('session_id', $sessions->pluck('id'))
                ->where('user_id', $request->user_id)
                ->first();
                $element->live_attend = empty($live_attend) ? 'Absent' : 'Attend';
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }
}
