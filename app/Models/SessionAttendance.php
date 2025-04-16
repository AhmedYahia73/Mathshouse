<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Session;
use App\Models\User;

class SessionAttendance extends Model
{
    use HasFactory;

    protected $table = 'session_attendance';
    
    protected $fillable = [
        'user_id', 
        'session_id',
    ];
 
    public function session_group()
    {
        return $this->belongsTo(Session::class, 'session_id')
        ->where('type', 'group');
    }
 
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
 
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function lessons_myLive_session()
    {
    return $this->hasMany(Lesson::class, 'lesson_id');
    }
}
