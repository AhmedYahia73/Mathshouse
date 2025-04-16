<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Course;

class StudentSession extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'course_id', 
        'student_id',
    ];

    public function course_api()
    {
        return $this->belongsTo(Course::class, 'course_id')
        ->with('category');
    }
}
