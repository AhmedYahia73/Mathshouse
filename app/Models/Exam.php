<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Course;
use App\Models\Question;
use App\Models\ScoreSheet;
use App\Models\ExamCodes;
use App\Models\ExamSection;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exam';
    
    protected $fillable = [
        'title',
        'description',
        'time',
        'sections',
        'score',
        'pass_score',
        'year',
        'month',
        'code_id',
        'course_id',
        'score_id',
        'state',
        'type',
    ];
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function question(){
        return $this->belongsToMany(Question::class, 'exam_questions')
        ->orderBy('q_num');
    }

    public function exam_score(){
        return $this->belongsTo(ScoreSheet::class, 'score_id');
    }

    public function code(){
        return $this->belongsTo(ExamCodes::class, 'code_id');
    }

    public function sections_data(){
        return $this->hasMany(ExamSection::class, 'exam_id');
    }

}
