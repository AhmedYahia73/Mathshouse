<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'marketing', 
        'min_price_data', 
    ];
}
