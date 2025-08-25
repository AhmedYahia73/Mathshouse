<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'material_link', 
        'material_file', 
        'text',
        'date',
        'is_sent',
    ];
    protected $appends = ['material_file_link'];
    
    public function getMaterialFileLinkAttribute(){
        if($this->attributes['material_file']){
            return url($this->attributes['material_file']);
        }
        return null;
    }

    public function parent(){
        return $this->belongsToMany(SupParent::class, 'notification_user', 'notification_id', 'parent_id');
    }
    
    public function user(){
        return $this->belongsToMany(User::class, 'notification_user', 'notification_id', 'user_id')
        ->withPivot('read_notification');
    }
}
