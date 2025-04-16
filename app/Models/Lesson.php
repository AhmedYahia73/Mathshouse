<?php

namespace App\Models;

use App\Models\User;
use App\Models\Chapter;
use App\Models\IdeaLesson;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'lesson_name', 
        'teacher_id', 
        'chapter_id', 
        'lesson_des', 
        'lesson_url',
        'pre_requisition',
        'gain',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function live_lesson( $id )
    {
        return $this->belongsToMany(User::class, 'live_lessons')
        ->where('users.id', $id);
    }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
    public function api_chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id')
        ->with('price');
    }
    public function course()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id')->with('course');
    }
    public function chapterMyLive()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id')->with('course');
    }
    public function chapter_api()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id')->with('course');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'lesson_id');
    }
    public function quizze()
    {
        return $this->hasMany(quizze::class)->orderBy('quizze_order');
    }
    public function quizzes()
    {
        return $this->hasMany(quizze::class)
        ->orderByDesc('quizze_order');
    }
    public function quizs()
    {
        return $this->hasMany(quizze::class)
        ->orderBy('quizze_order');
    }
    public function quizze_api()
    {
        return $this->hasMany(quizze::class)->orderBy('quizze_order')
        ->with('question_api');
    }
    public function ideas()
    {
        return $this->hasMany(IdeaLesson::class, 'lesson_id');
    }
    public function sessions()
    {
        return $this->hasMany(Session::class, 'lesson_id');
    }
    public function sessions_private()
    {
        return $this->hasMany(Session::class, 'lesson_id')->where('type','private');
    }
 
    public function extraDays()
    {
        return $this->hasOne(LessonExtraDays::class);
    }
    public function getExtraDays()
    {
        return $this->hasOne(LessonExtraDays::class, 'lesson_id')->where('end_date','>=',date('Y-m-d'))->max('end_date');
    }
}
