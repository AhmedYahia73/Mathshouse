<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\Question;

class ReportQuestion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'date',
        'user_id', 
        'question_id',
        'list_id',
        'statues', 
        'details', 
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

}
