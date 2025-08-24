<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class SupParent extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    
    protected $fillable = [
        'name', 
        'email',
        'phone',
        'password',
        'code',
        'status',
        'fcm_token',
    ];
    protected $appends = ['role'];

    public function getRoleAttribute(){
        return 'Parent';
    }

    protected $hidden = [
        'password', 
    ];

    public function students(){
        return $this->belongsToMany(User::class, 'parent_user', 'parent_id', 'user_id');
    }
}
