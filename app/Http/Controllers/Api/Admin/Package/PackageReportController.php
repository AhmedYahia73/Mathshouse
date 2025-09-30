<?php

namespace App\Http\Controllers\Api\Admin\Package;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Course;

class PackageReportController extends Controller
{
    public function __construct(private Course $course){}

    public function lists(Request $request){
        $course = $this->course;
        $students = User::
        select('id', 'nick_name', 'phone')
        ->with('payment_package.package_order.package', 'small_package')
        ->get()
        ->map(function($item) use($course){
            $live_courses_ids = $item?->small_package?->where('module', 'Live')->pluck('course_id')?->values()?->toArray();
            $question_courses_ids = $item?->small_package?->where('module', 'Question')->pluck('course_id')?->values()?->toArray();
            $exam_courses_ids = $item?->small_package?->where('module', 'Exam')->pluck('course_id')?->values()?->toArray();

            $live_count = $item?->small_package?->where('module', 'Live')?->sum('number') ?? 0;
            $question_count = $item?->small_package?->where('module', 'Question')?->sum('number') ?? 0;
            $exam_count = $item?->small_package?->where('module', 'Exam')?->sum('number') ?? 0;
            $item?->payment_package?->map(function($element) use($live_count, $live_courses_ids){
                $live_count += $element?->package_order?->package?->where('module', 'Live')?->number ?? 0;
                $live = $element?->package_order?->package?->where('module', 'Live');
                $live_courses_ids[$live->course_id] = isset($live_courses_ids[$live->course_id] ) ? $live_courses_ids[$live->course_id] + $live->number : $live->number;
            });
            $item?->payment_package?->map(function($element) use($question_count){
                $question_count += $element?->package_order?->package?->where('module', 'Question')?->number ?? 0;
                $question = $element?->package_order?->package?->where('module', 'Question');
                $question_courses_ids[$question->course_id] = isset($question_courses_ids[$question->course_id] ) ? $question_courses_ids[$question->course_id] + $question->number : $question->number;
            });
            $item?->payment_package?->map(function($element) use($exam_count){
                $exam_count += $element?->package_order?->package?->where('module', 'Exam')?->number ?? 0;
                
                $exam = $element?->package_order?->package?->where('module', 'Exam');
                $exam_courses_ids[$exam->course_id] = isset($exam_courses_ids[$exam->course_id] ) ? $exam_courses_ids[$exam->course_id] + $exam->number : $exam->number;
            });
            $live_details = [];
            $question_details = [];
            $exam_details = [];
            foreach ($live_courses_ids as $key => $item) {
                $live_details[] = [
                    'course_name' => $course->where('id', $key)->first()?->course_name,
                    'number' => $key
                ];
            }
            foreach ($question_courses_ids as $key => $item) {
                $question_details[] = [
                    'course_name' => $course->where('id', $key)->first()?->course_name,
                    'number' => $key
                ];
            }
            foreach ($exam_courses_ids as $key => $item) {
                $exam_details[] = [
                    'course_name' => $course->where('id', $key)->first()?->course_name,
                    'number' => $key
                ];
            }

            $exam_history_count = $item?->exams_history?->count ?? 0;
            $question_history_count = $item?->questions_history?->count ?? 0;
            $live_history_count = $item?->lives_history?->count ?? 0;

            $exam_history = $item?->exams_history ?? [];
            $question_history = $item?->questions_history ?? [];
            $live_history = $item?->lives_history ?? [];

            $exam_history_details = [];
            $question_history_details = [];
            $live_history_details = [];

            foreach ($exam_history as $key => $element) {
                $course_id = $element?->exams?->course_id;
                $exam_history_details[$course_id] = [
                    'course' => $course->where('id', $course_id)->first()?->course_name,
                    'number' => isset($exam_history_details[$course_id]) ? 
                    ($exam_history_details[$course_id]['number'] + 1) : 1
                ];
            } 
            foreach ($question_history as $key => $element) {
                $course_id = $element?->exams?->course_id;
                $question_history_details[$course_id] = [
                    'course' => $course->where('id', $course_id)->first()?->course_name,
                    'number' => isset($question_history_details[$course_id]) ? 
                    ($question_history_details[$course_id]['number'] + 1) : 1
                ];
            } 
            foreach ($live_history as $key => $element) {
                $course_id = $element?->exams?->course_id;
                $live_history_details[$course_id] = [
                    'course' => $course->where('id', $course_id)->first()?->course_name,
                    'number' => isset($live_history_details[$course_id]) ? 
                    ($live_history_details[$course_id]['number'] + 1) : 1
                ];
            }
            return [
                'id' => $item->id,
                'nick_name' => $item->nick_name,
                'phone' => $item->phone,
                'live_count' => $live_count,
                'question_count' => $question_count,
                'exam_count' => $exam_count,
                
                'live_details' => $live_details,
                'question_details' => $question_details,
                'exam_details' => $exam_details,
                
                'exam_history_count' => $exam_history_count,
                'question_history_count' => $question_history_count,
                'live_history_count' => $live_history_count,
                
                'exam_history_details' => $exam_history_details,
                'question_history_details' => $question_history_details,
                'live_history_details' => $live_history_details,
            ];
        });
    }
}
