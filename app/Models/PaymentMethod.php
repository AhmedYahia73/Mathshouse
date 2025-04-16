<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_method';

    protected $fillable = [
        'payment',
        'description',
        'logo',
        'statue',
    ];


     public function getCreatedAtAttribute($date){
     return date('d-m-Y',strtotime($date));
     }

       public function getUpdatedAtAttribute($date){
       return date('d-m-Y',strtotime($date));
       }


       public function payment_currancies(){
        return $this->belongsToMany(Currancy::class,'payment_currancies');
       }
       public function currency(){
        return $this->belongsToMany(Currancy::class,'payment_currancies','currancy_id');
       }
}
