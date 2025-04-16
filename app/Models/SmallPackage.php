<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PaymentPackageOrder;

class SmallPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 
        'category_id',
        'course_id',
        'module',
        'number',
        'admin_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function purchases( $id )
    {
        return PaymentPackageOrder::where('user_id', $id)
        ->where('state', 1)
        ->with('package')
        ->get();
    }
}
