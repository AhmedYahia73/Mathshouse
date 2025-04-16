<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Question;
class Q_ans extends Model
{
    use HasFactory;

    protected $fillable = [
        'ans_pdf',
        'ans_video',
        'Q_id',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'Q_id');
    }
}
