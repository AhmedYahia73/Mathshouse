<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Session;
use App\Models\User;

class SessionStudent extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'session_id', 
        'user_id',
    ];
 
    public function session()
    {
        return $this->belongsTo(Session::class, 'session_id');
    }
 
    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
