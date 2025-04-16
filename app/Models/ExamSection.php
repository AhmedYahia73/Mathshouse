<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;

class ExamSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'timer',
        'exam_id',
    ];
    
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_questions', 'section_id', 'question_id');
    }
}
