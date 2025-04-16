<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lesson;
use App\Models\Question;
use App\Models\StudentQuizze;

class quizze extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 
        'time', 
        'score',
        'pass_score',
        'description',
        'lesson_id',
        'state',
        'quizze_order',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function question()
    {
        return $this->belongsToMany(Question::class, 'q_quizes');
    }

    public function question_api()
    {
        return $this->belongsToMany(Question::class, 'q_quizes')
        ->with('mcq')->with('g_ans');
    }

    public function mistakes()
    {
        return $this->belongsToMany(Question::class, 'student_quizze_mistakes');
    }

    public function student_quizzes( $id ){
        return $this->hasMany(StudentQuizze::class, 'quizze_id')
        ->where('student_id', $id)
        ->orderByDesc('created_at')
        ->first();
    }

    public function student_quizs(){
        return $this->hasMany(StudentQuizze::class, 'quizze_id')
        ->orderByDesc('created_at');
    }
}
