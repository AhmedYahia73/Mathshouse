<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\AffilateService;
use App\Models\Commission;

class Affilate extends Model
{
    use HasFactory;
    protected $table = 'affilate';
    
    protected $fillable = [
        'user_id', 
        'organization', 
        'wallet', 
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function services(){
        return $this->hasMany(AffilateService::class, 'affilate_id');
    }

    public function total_earned(){
        return $this->hasMany(AffilateService::class, 'affilate_id');
    }

    public function commisions()
    {
        return $this->hasMany(Commission::class, 'user_id');
    }

}
