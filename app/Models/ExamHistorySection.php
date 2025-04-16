<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamHistorySection extends Model
{
    use HasFactory;

    protected $table = 'exam_history_sections';
    
    protected $fillable = [
        'exam_history_id',
        'exam_section_id',
        'timer',
        'score',
    ];
}
