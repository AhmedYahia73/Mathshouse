<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Course;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'module',
        'course_id',
        'number',
        'price',
        'duration',
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_packages');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

}
