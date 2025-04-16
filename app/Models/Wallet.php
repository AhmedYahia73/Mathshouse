<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\PaymentMethod;
use App\Models\PaymentRequest;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'rejected_reason',
        'wallet', 
        'date',
        'image',
        'payment_method_id',
        'state',
        'payment_request_id',
        'currency',
    ];

    public function getdateAttribute($date){
        return date('d-m-Y', strtotime($date));
    }
    
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function method()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function payment_req()
    {
        return $this->belongsTo(PaymentRequest::class, 'payment_request_id');
    }
}
