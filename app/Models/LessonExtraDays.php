<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonExtraDays extends Model
{
    use HasFactory;

    protected $fillable = [
        'extra_days',
        'user_id',
        'lesson_id',
        'end_date'
    ];
}
