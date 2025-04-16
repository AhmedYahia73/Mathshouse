<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Exam;
use App\Models\ExamMistake;

class ExamHistory extends Model
{
    use HasFactory;

    protected $table = 'exam_history';
    
    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'time',
        'r_questions',
        'date',
    ];

    public function getdateAttribute($date){
        return date('d-m-Y', strtotime($date));
    }
    
    public function exams(){
        return $this->belongsTo(Exam::class, 'exam_id');
    }

    public function mistakes(){
        return $this->hasMany(ExamMistake::class, 'student_exam_id');
    }
}
