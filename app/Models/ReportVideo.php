<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\IdeaLesson;
use App\Models\Q_ans;

class ReportVideo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'user_id', 
        'lesson_video_id',
        'q_video_id',
        'list_id',
        'statues', 
        'details', 
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function video()
    {
        return $this->belongsTo(IdeaLesson::class, 'lesson_video_id');
    }

    public function q_video()
    {
        return $this->belongsTo(Q_ans::class, 'q_video_id');
    }
}
