<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\DiagnosticExam;
use App\Models\DaiExamMistake;

class DiagnosticExamsHistory extends Model
{
    use HasFactory;

    protected $table = 'diagnostic_exams_history';

    protected $fillable = [
        'user_id',
        'diagnostic_exams_id',
        'score',
        'time',
        'daily',
        'r_questions',
        'date',
    ];

    public function getdateAttribute($date){
        return date('d-m-Y', strtotime($date));
    }
    
    public function exams(){ 
        return $this->belongsTo(DiagnosticExam::class, 'diagnostic_exams_id');
    }

    public function mistakes(){
        return $this->hasMany(DaiExamMistake::class, 'student_exam_id');
    }
}
