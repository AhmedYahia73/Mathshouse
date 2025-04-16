<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ScoreSheet;
use App\Models\ScoreList;
use App\Models\Category;
use App\Models\Course;
use App\Models\Question;
use App\Models\ExamCodes;
use App\Models\Chapter;
use App\Models\Exam;
use App\Models\ExamSection;
use App\Models\ExamHistorySection;
use App\Models\ExamQuestion;

class ExamController extends Controller
{
    
    public function index(){
        $questions = Question::
        select('*', 'questions.id as question_id')
        ->leftJoin('lessons', 'questions.lesson_id', '=', 'lessons.id')
        ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
        ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
        ->orderByDesc('question_id')
        ->get();
        $exams = Exam::
        orderByDesc('id')
        ->simplePaginate(10);
        $categories = Category::all();
        $courses = Course::all();
        $scores = ScoreSheet::all();
        $codes = ExamCodes::all();
        $chapters = Chapter::all();

        return view('Admin.courses.Exam.Exam', 
        compact('questions', 'exams', 'categories', 'courses', 'scores', 'codes', 'chapters'));
    }

    public function add_exam( Request $req ){
        $req->validate([
            'title' => 'required',
            'score'   => 'required|numeric', 
            'pass_score'    => 'required|numeric',
            'course_id'    => 'required|numeric',
            'score_id'    => 'required|numeric',
           ]);
        $arr = $req->only('title', 'description', 'score', 'pass_score', 'type',
        'year', 'month', 'code_id', 'course_id', 'score_id', 'state');
        $arr['time'] = $req->time_h . ':' . $req->time_m . ':00';
        $arr['sections'] = $req->num_section;
        $exam = Exam::create($arr);
        if( json_decode($req->section_0) ){
            $questions = json_decode($req->section_0);
            $exam_section = ExamSection::create([
                'name' => $req->section_name[0],
                'description' => $req->section_description[0],
                'timer' => $req->section_hour[0] . ':' . $req->section_minutes[0] . ":" . $req->section_seconds[0],
                'exam_id' => $exam->id,
            ]);

            foreach ($questions as $ques) {
                ExamQuestion::create([
                    'exam_id' => $exam->id,
                    'question_id' => $ques->id,
                    'section_id' => $exam_section->id,
                ]);
            }
        }
        
        if( json_decode($req->section_1) ){
            $questions = json_decode($req->section_1);
            $exam_section = ExamSection::create([
                'name' => $req->section_name[1],
                'description' => $req->section_description[1],
                'timer' => $req->section_hour[1] . ':' . $req->section_minutes[1] . ":" . $req->section_seconds[1],
                'exam_id' => $exam->id,
            ]);
            foreach ($questions as $ques) { 
                ExamQuestion::create([
                    'exam_id' => $exam->id,
                    'question_id' => $ques->id,
                    'section_id' => $exam_section->id,
                ]);
            }
        }
        
        if( json_decode($req->section_2) ){
            $questions = json_decode($req->section_2);
            $exam_section = ExamSection::create([
                'name' => $req->section_name[2],
                'description' => $req->section_description[2],
                'timer' => $req->section_hour[2] . ':' . $req->section_minutes[2] . ":" . $req->section_seconds[2],
                'exam_id' => $exam->id,
            ]);
            foreach ($questions as $ques) { 
                ExamQuestion::create([
                    'exam_id' => $exam->id,
                    'question_id' => $ques->id,
                    'section_id' => $exam_section->id,
                ]);
            }
        }
        
        if( json_decode($req->section_3) ){
            $exam_section = ExamSection::create([
                'name' => $req->section_name[3],
                'description' => $req->section_description[3],
                'timer' => $req->section_hour[3] . ':' . $req->section_minutes[3] . ":" . $req->section_seconds[3],
                'exam_id' => $exam->id,
            ]);

            $questions = json_decode($req->section_3);
            foreach ($questions as $ques) {
                ExamQuestion::create([
                    'exam_id' => $exam->id,
                    'question_id' => $ques->id,
                    'section_id' => $exam_section->id,
                ]);
            }
        }

        return redirect()->back();
    }

    public function edit_exam( Request $req){
       $info = $req->data[0][0];
       $arr = [
            'title' => $info['title'],
            'description' => $info['description'],
            'score' => $info['score'],
            'pass_score' => $info['pass_score'],
            'score_id' => $info['score_id'],
            'state' => $info['state'],
            'time' => $info['time'],
        ];
       $exam = Exam::
       where('id', $info['exam_id'])
       ->update($arr);
       
       ExamQuestion::where('exam_id', $info['exam_id'])
       ->delete();
       for ( $i=1; $i < count($req->data); $i++ ) { 
            for ( $j=0; $j < count($req->data[$i]); $j++ ) {
                ExamQuestion::create([
                    'exam_id' => $info['exam_id'],
                    'question_id' => $req->data[$i][$j]['question_ID'],
                    'section_id' => $req->data[$i][$j]['question_SectionID'],
                ]);
            }
       }

       return response()->json([
        'success' => 'Exam Edited Success'
       ]);
    }

    public function edit_q_exam( Request $req ){
        Exam::where('id', $req->data[0][0]['diagnostic_ID'])
        ->update([
            'title' => $req->data[0][0]['title'],
            'description' => $req->data[0][0]['description'],
            'time' => $req->data[0][0]['time'],
            'score' => $req->data[0][0]['score'],
            'pass_score' => $req->data[0][0]['pass_score'],
            'score_id' => $req->data[0][0]['scoreId'],
            'state' => $req->data[0][0]['state'],
        ]);
        ExamQuestion::where('exam_id', $req->data[0][0]['diagnostic_ID'])
        ->delete();
        for ($i=1, $end = count($req->data); $i < $end; $i++) { 
            ExamQuestion::create([
                'exam_id' => $req->data[0][0]['diagnostic_ID'],
                'question_id' => $req->data[$i]['question_ID']
            ]);
        }
        return $req->all();
    }

    public function score_sheet(){
        $score_sheet = ScoreSheet::simplePaginate(10);
        $categories = Category::all();
        $courses = Course::all();

        return view('Admin.courses.score_sheet.Score_Sheet', 
        compact('score_sheet', 'categories', 'courses'));
    }

    public function addScore( Request $req ){
        if ( !isset(($req['question_num'][0])) || empty($req['question_num'][0]) ) {
            session()->flash('faild','You Must Fill Score Sheet. Click on Show List And Add Data');
            return redirect()->back();
        }

       $score_sheet = ScoreSheet::create(
        $req->only('name', 'course_id', 'score')
       );

       for ($i=0, $end = count($req->question_num); $i < $end; $i++) { 
            ScoreList::create([
                'score_id' => $score_sheet->id,
                'question_num' => $req->question_num[$i],
                'score' => $req->score_list[$i]
            ]);
       }

       return redirect()->back();
    }
    
    public function editScore( Request $req, $id ){ 
        if ( !isset(($req['question_num'][0])) || empty($req['question_num'][0]) ) {
            session()->flash('faild','You Must Fill Score Sheet. Click on Show List And Add Data');
            return redirect()->back();
        }

        $score_sheet = ScoreSheet::
        where('id', $id)
        ->update(
        $req->only('name', 'course_id', 'score')
        );

        ScoreList::where('score_id', $id)
        ->delete();

        for ($i=0, $end = count($req->score_list); $i < $end; $i++) {
            ScoreList::create([ 'score_id'=> $id,
            'question_num' => $req->question_num[$i],
            'score' => $req->score_list[$i]
            ]);
            }

            return redirect()->back();
        }

    
        public function scoreDelete( $id ){
        ScoreSheet::where('id', $id )
        ->delete();

        return redirect()->back();
    }

    public function exam_data ( Request $req ){
       
        if ( $req->month == null ) {
            $exam = Question::
            select('*', 'questions.id as question_id')
            ->leftJoin('lessons', 'questions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->where('courses.id', $req->course_id)
            ->get();
        }
        else {
            $exam = Question::
            select('*', 'questions.id as question_id')
            ->leftJoin('lessons', 'questions.lesson_id', '=', 'lessons.id')
            ->leftJoin('chapters', 'lessons.chapter_id', '=', 'chapters.id')
            ->leftJoin('courses', 'chapters.course_id', '=', 'courses.id')
            ->where('courses.id', $req->course_id)
            ->where('questions.month', $req->month)
            ->where('questions.year', $req->year)
            ->where('questions.q_code', $req->code)
            ->get();
        }

        return $exam;
    }

    public function del_exam( $id ){
        Exam::where('id', $id)
        ->delete();

        return redirect()->back();
    }

    public function scoreEdit( Request $req ){ 
        $data = $req->score_list;
        
        if ( !isset(($data['num'][0])) || empty($data['num'][0]) ) {
            session()->flash('faild','You Must Fill Score Sheet. Click on Show List And Add Data');
            return redirect()->back();
        }

       $score_sheet = ScoreSheet::
       where('id', $data['id'])
       ->update([
            'name' => $data['name'],
            'course_id' =>$data['course'],
            'score' => $data['score'],
        ]);

       ScoreList::where('score_id', $data['id'])
       ->delete();
       for ($i=0, $end = count($data['scores']); $i < $end; $i++) { 
            ScoreList::create([
                'score_id' => $data['id'],
                'question_num' => $i + 1,
                'score' => $data['scores'][$i]
            ]);
       }

       return response()->json([
        'success' => 'Data Is Updated'
       ]);
    }

}
