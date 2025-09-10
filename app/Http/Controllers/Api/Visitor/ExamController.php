<?php

namespace App\Http\Controllers\Api\Visitor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Course;
use App\Models\ExamCodes;
use App\Models\Question;
use App\Models\Exam;

class ExamController extends Controller
{
    public function exam_lists(Request $request){
        $categories = Category::
        select('id', 'cate_name')
        ->get();
        $courses = Course::
        select('id', 'course_name', 'category_id')
        ->get();
        $exam_codes = ExamCodes::
        select('id', 'exam_code')
        ->get();

        return response()->json([
            'categories' => $categories,
            'courses' => $courses,
            'exam_codes' => $exam_codes,
        ]);
    }

    public function filter_exam(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'course_id' => 'exists:courses,id',
            'code_id' => 'exists:exam_codes,id',
            'year' => 'numeric',
            'month' => 'numeric',
        ], [
            'category_id.required' => 'category is required',
            'category_id.exists'   => 'category not exist',
            'course_id.exists'     => 'category not exist',
            'code_id.exists'       => 'course not exist',
            'year.numeric'         => 'year must be numeric',
            'month.numeric'        => 'month must be number',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $exams = Exam::
        with('code', 'course');
        if($request->category_id){
            $exams = $exams
            ->whereHas('course', function($query) use($request){
                $query->where('category_id', $request->category_id);
            });
        }
        if($request->course_id){
            $exams = $exams
            ->where('course_id', $request->course_id);
        }
        if($request->year){
            $exams = $exams
            ->where('year', $request->year);

        }
        if($request->month){
            $exams = $exams
            ->where('month', $request->month);
        }
        if($request->code_id){
            $exams = $exams
            ->where('code_id', $request->code_id);
        }
        $exams = $exams
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'exam_name' => $item->title,
                'year' => $item->year,
                'month' => $item->month,
                'code' => $item?->code?->exam_code,
                'course' => $item?->course?->course_name,
            ];
        });

        return response()->json([
            'exams' => $exams
        ]);
    }

    public function filter_question(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'course_id' => 'exists:courses,id',
            'code_id' => 'exists:exam_codes,id',
            'year' => 'numeric',
            'month' => 'numeric',
            'section' => 'numeric',
            'q_num' => 'numeric',
        ], [
            'category_id.required' => 'category is required',
            'category_id.exists'   => 'category not exist',
            'course_id.exists'     => 'category not exist',
            'code_id.exists'       => 'course not exist',
            'year.numeric'         => 'year must be numeric',
            'month.numeric'        => 'month must be number',
            'section.numeric'      => 'section must be number',
            'q_num.numeric'        => 'Question Number must be number',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $questions = Question::
        with('code');
        if($request->category_id){
            $questions = $questions
            ->whereHas('lessons.chapter.course', function($query) use($request){
                $query->where('courses.category_id', $request->category_id);
            });
        }
        if($request->course_id){
            $questions = $questions
            ->whereHas('lessons.chapter', function($query) use($request){
                $query->where('chapters.course_id', $request->category_id);
            });
        }
        if($request->year){
            $questions = $questions
            ->where('year', $request->year);

        }
        if($request->month){
            $questions = $questions
            ->where('month', $request->month);
        }
        if($request->code_id){
            $questions = $questions
            ->where('q_code', $request->code_id);
        }
        if($request->section){
            $questions = $questions
            ->where('section', $request->section);
        }
        if($request->q_num){
            $questions = $questions
            ->where('q_num', $request->q_num);
        }
        $questions = $questions
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id, 
                'year' => $item->year,
                'month' => $item->month,
                'code' => $item?->code?->exam_code,
                'section' => $item->section,
            ];
        });

        return response()->json([
            'questions' => $questions
        ]);
    }
}
