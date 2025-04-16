<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffilateRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'affilate_id', 
        'service', 
        'earned', 
        'payment_req_id', 
    ];
}
