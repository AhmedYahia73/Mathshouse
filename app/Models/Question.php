<?php

namespace App\Models;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Mcq_ans;
use App\Models\Q_ans;
use App\Models\ExamCodes;
use App\Models\Exam;
use App\Models\Grid_ans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'lesson_id', 
        'question',
        'q_code',  
        'q_type',  
        'month',   
        'year',  
        'section',  
        'difficulty',  
        'q_url',
        'q_num',
        'ans_type',
        'state',
    ];

    public function code()
    {
        return $this->belongsTo(ExamCodes::class, 'q_code');
    }

    public function lessons()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function api_lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id')
        ->with('api_chapter');
    }

    public function mcq(){
        return $this->hasMany(Mcq_ans::class, 'q_id');
    }

    public function q_ans(){
        return $this->hasMany(Q_ans::class, 'Q_id');
    }

    public function g_ans(){
        return $this->hasMany(Grid_ans::class, 'q_id');
    }

    public function exam(){
        return $this->belongsToMany(Exam::class, 'exam_questions');
    }
}
