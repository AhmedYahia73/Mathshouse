<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;

class DaiExamMistake extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_exam_id',
        'question_id',
    ];
    
    public function question(){
        return $this->belongsTo(Question::class, 'question_id')
        ->with('mcq')->with('g_ans')->with('q_ans');
   }

   public function exam(){
       return $this->belongsTo(DiagnosticExamsHistory::class, 'student_exam_id');
   }
}
