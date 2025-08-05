<?php

namespace App\Http\Controllers\Api\User\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\Models\Course;
use App\Models\DiagnosticExam;
use App\Models\ReportQuestionList;
use App\Models\DiagnosticExamsHistory;
use App\Models\DaiExamMistake;
use App\Models\Lesson;

class DiaExamController extends Controller
{
    public function __construct(private Course $course,
    private DiagnosticExam $exam,
    private ReportQuestionList $question_report, 
    private DiagnosticExamsHistory $exam_history, 
    private DaiExamMistake $exam_mistakes,
    private Lesson $lesson){}

    public function lists(Request $request){
        $courses = $this->course
        ->select('id', 'course_name')
        ->where('category_id', $request->user()->category_id)
        ->get(); 

        return response()->json([
            'courses' => $courses, 
        ]); 
    }

    public function show_exam(Request $request, $course_id){
        $exam = $this->exam
        ->where('course_id', $course_id)
        ->with(['question' => function($query){
            $query->select('questions.id', 'questions.question', 'ans_type', 'q_url')
            ->with(['mcq:id,mcq_num,q_id']);
        }])
        ->get();
        if($exam->count() == 0){
            return response()->json([
                'errors' => 'Exam is empty'
            ], 400);
        }
        $random = rand(0, $exam->count() - 1);
        $question = $exam[$random]?->question;

        return response()->json([
            'exam' => $question
        ]);
    }

    public function grade_exam(Request $request){ 
        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'timer' => 'required',
            'exam_id' => 'required|exists:diagnostic_exams,id',
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }
        $score = 0; 
        $total = count($request->answers);
        $mistakes = [];
        $iter = 0;
        $answer = $request->answers;
        $exam = $this->exam
        ->where('id', $request->exam_id)
        ->with(['question' => function($query){
            $query->select('questions.id', 'question', 'ans_type', 'q_url', 'lesson_id')
            ->with(['mcq', 'g_ans']);
        }])
        ->first(); 
        $questions = $exam?->question;
		$total_question = $questions->count();
        $pass_score = $exam->pass_score;
        $exam_name = $exam->title;
        foreach ($questions as $item) {
            $question = $item;
            if ($question->ans_type == 'MCQ') {
                $q_answer = $question->mcq;
                if($q_answer->count() > 0 && isset($answer[$iter]) && $q_answer[0]->mcq_answers == $answer[$iter++]){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            }
            else {
                $q_answer = $question->g_ans; 
                if($q_answer->count() > 0 && isset($answer[$iter]) && $q_answer->pluck('grid_ans')->contains($answer[$iter++])){
                    $score++;
                }
                else{
                    $mistakes[] = $question;
                }
            }
        }
  
        $right_questions = $score;
        $score = ($right_questions / $total_question) * 100; 
        $grade = $exam->pass_score < $score ? true : false;
        $timer = $request->timer;
        if (empty($stu_q)) {
            $stu_exam = $this->exam_history
            ->create([
                'date' => now(),
                'user_id' => auth()->user()->id,
                'diagnostic_exams_id' => $exam->id,
                'score' => $score,
                'time' => $timer, 
                'r_questions' => $right_questions, 
            ]);

            foreach ($mistakes as $item) {
                $this->exam_mistakes
                ->create([
                    'student_exam_id' => $stu_exam->id,
                    'question_id' => $item->id
                ]);
            }
        }
        $mistakes = collect($mistakes);
        $lessons_ids = $mistakes->pluck('lesson_id');
        $recommanditions = $this->lesson
        ->whereIn('id', $lessons_ids)
        ->with(['chapter' => function($query){
            $query->select('chapter_name', 'id');
        }])
        ->get()
        ->unique('chapter_id')
        ?->pluck('chapter');

        return response()->json([
            'grade' => $grade,
            'mistakes' => $mistakes,
            'score' => $score,
            'exam' => $exam,
            'right_question' => $right_questions,
            'total_question' => $total_question,
            'pass_score' => $pass_score,
            'exam_name' => $exam_name,
            'recommanditions' => $recommanditions,
        ]);
 
    }
}
