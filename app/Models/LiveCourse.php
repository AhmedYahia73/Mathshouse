<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Course;

class LiveCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'course_id', 
        'state',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id')
        ->with('category');
    }

}
