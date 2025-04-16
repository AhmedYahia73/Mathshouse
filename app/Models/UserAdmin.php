<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Admin_role;

class UserAdmin extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_admin',
    ];

    public function user_role()
    {
        return $this->hasMany(Admin_role::class, 'user_admin_id');
    }
}
