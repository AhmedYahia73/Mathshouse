<?php

namespace App\Models;

use app\Models\UserAdmin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin_role extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_admin_id',
        'admin_role',
    ];

    public function user_admin()
    {
        return $this->belongsTo(UserAdmin::class, 'user_admin_id');
    }
}
