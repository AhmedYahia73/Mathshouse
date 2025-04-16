<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PromoCode;
use App\Models\Package;

class PromoPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_id',
        'package_id',
    ];

    public function promo()
    {
        return $this->belongsTo(PromoCode::class, 'promo_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
