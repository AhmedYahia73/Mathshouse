<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currancy extends Model
{
    use HasFactory;
    protected $fillable = [
        'currency', 
        'amount',
    ];



    public function paymentMethod(){
        return $this->belongsTo(PaymentMethod::class,'payment_currancies','payment_method_id');
    }
}
