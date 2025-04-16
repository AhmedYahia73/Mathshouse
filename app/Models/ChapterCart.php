<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChapterCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketing', 
        'chapters_price', 
    ];

}
