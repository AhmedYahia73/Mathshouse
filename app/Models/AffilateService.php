<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Affilate;

class AffilateService extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'affilate_id', 
        'service', 
        'earned', 
    ];

    public function affilate(){
        return $this->belongsTo(Affilate::class, 'affilate_id');
    }

}
