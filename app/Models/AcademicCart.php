<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\SessionGroup;
use App\Models\User;

class AcademicCart extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id',
        'course_id',
        'chapter_id',
        'lesson_id',
        'group_id',
        'student_id',
        'state',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');
    }

    public function group()
    {
        return $this->belongsTo(SessionGroup::class, 'group_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    
}
