<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\PopupPage;

class MarketingPopup extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'starts',
        'ends',
        'image',
    ];

    
    public function popup_pages()
    {
        return $this->belongsToMany(PopupPage::class, 'popup_popup_pages');
    }


}
