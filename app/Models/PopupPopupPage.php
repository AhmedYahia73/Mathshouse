<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupPopupPage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'marketing_popup_id',
        'popup_page_id',
    ];
}
