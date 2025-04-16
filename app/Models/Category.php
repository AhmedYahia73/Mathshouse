<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
     
    protected $fillable = [
        'cate_name',
        'cate_des',
        'teacher_id', 
        'cate_url',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id')->with('prices')->with('chapterWithPrice');
    }
    public function courses_live()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}
