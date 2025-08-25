<?php

namespace App\Http\Controllers\Api\User\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notification;
use App\Models\NotificationUser;

class StudentNotificationController extends Controller
{ 
    public function __construct(private Notification $notifications,
    private NotificationUser $notification_user){}

    public function view(Request $request){
        $notifications = $this->notifications
        ->whereHas('user', function($query) use($request){
            $query->where('users.id', $request->user()->id);
        })
        ->where('date', '<=', now())
        ->orderByDesc('id')
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'material_link' => $item->material_link,
                'material_file' => $item->material_file_link,
                'text' => $item->text, 
            ];
        });
        
        $notification_ids = $this->notifications
        ->whereHas('user', function($query) use($request){
            $query->where('users.id', $request->user()->id);
        })
        ->where('date', '<=', now())
        ->pluck('id');
        $this->notification_user
        ->whereIn('notification_id', $notification_ids->toArray())
        ->where('user_id', $request->user()->id)
        ->update([
            'read_notification' => 1
        ]);

        return response()->json([
            'notifications' => $notifications
        ]);
    }
}
