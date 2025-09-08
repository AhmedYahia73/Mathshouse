<?php

namespace App\Http\Controllers\Api\User\ScoreSheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Course;
use App\Models\Chapter;
use App\Models\Session;
use App\Models\Exam;
use App\Models\SessionStudent;

class ScoreSheetController extends Controller
{
    public function __construct(public Course $courses){}

    public function lists(Request $request){
        $courses = $this->courses
        ->select('id', 'course_name')
        ->where('category_id', $request->user()->category_id)
        ->get();

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function scoreSheet(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
 
        $data = Chapter::
        select('id', 'chapter_name')
        ->where('course_id', $request->course_id)
        ->with(['lessons' => function($query) {
            $query
            ->select('id', 'lesson_name', 'chapter_id')
            ->with(['quizs' => function($query2){
                $query2->select('id', 'title', 'score', 'pass_score', 'lesson_id')
                ->with(['student_score_quiz' => function($query3){
                    $query3->select('id', 'quizze_id', 'score', 'time', 'date');
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
                ->where('user_id', auth()->user()->id)
                ->first();
                $element->live_attend = empty($live_attend) ? 'Absent' : 'Attend';
            }
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function scoreSheet_Exam(Request $request){
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id', 
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        $score_sheet = Exam::
        with('exam_history')
        ->where('course_id', $reqest->course_id)
        ->get()
        ->map(function($item){
            return [
                'id' => $item?->id,
                'score' => count($item?->exam_history) > 0 ? $item?->exam_history[0]?->score : [],
                'time' => $item?->exam_history?->time,
                'pass_score' => $item?->pass_score,
                'number_of_trial' => count($item?->exam_history),
            ];
        });

        return response()->json([
            'score_sheet' => $score_sheet
        ]);
    }
}
