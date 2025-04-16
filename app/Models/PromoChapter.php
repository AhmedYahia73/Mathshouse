<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PromoCode;
use App\Models\Chapter;

class PromoChapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'promo_id',
        'chapter_id',
    ];

    public function promo()
    {
        return $this->belongsTo(PromoCode::class, 'promo_id');
    }

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id');
    }
}
