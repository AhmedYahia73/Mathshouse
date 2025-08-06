<?php

namespace App\Http\Controllers\Api\Admin\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\Exam;

class ExamReportController extends Controller
{
    public function lists(Request $request){ 
        $categories = Category::
        select('id', 'cate_name')
        ->get();
        $courses = Course::
        select('id', 'course_name')
        ->get();
        $chapters = Chapter::
        select('id', 'chapter_name')
        ->get();
        $lessons = Lesson::
        select('id', 'lesson_name')
        ->get();
        $exam_items = Exam::
        select('id', 'title')
        ->get(); 
        $types = [
            'Trail', 'Parallel', 'Extra'
        ];

        return response()->json([
            'categories' => $categories,
            'courses' => $courses,
            'chapters' => $chapters,
            'lessons' => $lessons,
            'exam_items' => $exam_items,
            'types' => $types,
        ]);
    }

    public function exam_questions(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => ['exists:categories,id'],
            'course_id' => ['exists:courses,id'],
            'chapter_id' => ['exists:chapters,id'],
            'lesson_id' => ['exists:lessons,id'],
            'exam_id' => ['exists:exam,id'],
            'type' => ['in:Trail,Parallel,Extra'],
            'month' => ['numeric', 'min:1', 'max:12'],
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        if($request->exam_id){
            $questions = Exam::
            where('id', $request->exam_id)
            ->with(['question' => function($query){
                $query->with('mcq:id,mcq_num,mcq_answers,q_id', 'g_ans:id,grid_ans,q_id',
                'lessons.chapter.course');
            }])
            ->first()?->question ?? collect([]);
        }
        else{
            $questions = Question:: 
            with([ 'mcq:id,mcq_num,mcq_answers,q_id', 'g_ans:id,grid_ans,q_id',
                'lessons.chapter.course'
            ])
			->whereHas('lessons.chapter.course')
            ->get();
        } 
		 
        if($request->category_id){
            $questions = $questions->filter(function ($item) use($request) {
                return optional($item->lessons->chapter->course)->category_id == $request->category_id;
            }); 
        }
        if($request->course_id){
            $questions = $questions->filter(function ($item) use($request) {
                return optional($item->lessons->chapter)->course_id == $request->course_id;
            }); 
        }
        if($request->chapter_id){
            $questions = $questions->filter(function ($item) use($request) {
                return optional($item->lessons)->chapter_id == $request->chapter_id;
            });
        }
        if($request->lesson_id){
            $questions = $questions->filter(function ($item) use($request) {
                return $item->lesson_id == $request->lesson_id;
            });
        }
        if($request->type){
            $questions = $questions->filter(function ($item) use($request) {
                return $item->q_type == $request->type;
            });
        }
        if($request->month){
            $questions = $questions->filter(function ($item) use($request) {
                return $item->month == $request->month;
            });
        }
		
		
		$questions = $questions->select('id',
            'month', 'ans_type',
            'q_num', 'mcq', 'g_ans',
            'year',
            'section',
			'q_code')->values();

        return response()->json([
            'questions' => $questions
        ]);
    }
}
