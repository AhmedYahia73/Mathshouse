<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notification;
use App\Models\NotificationUser;

class Stu_NotificationController extends Controller
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
        ->get();
        $notification_ids = $notifications?->pluck('id')?->toArray() ?? [];
        $this->notification_user
        ->whereIn('notification_id', $notification_ids)
        ->where('user_id', $request->user()->id)
        ->update([
            'read_notification' => 1
        ]);

        return view('Student.Notification.Notification', 
        compact('notifications'));
    }
}
