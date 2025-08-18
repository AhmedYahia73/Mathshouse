<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notification;

class TNotificationController extends Controller
{
    public function __construct(private Notification $notifications){}

    public function view(Request $request){
        $notifications = $this->notifications
        ->whereHas('user', function($query) use($request){
            $query->where('users.id', $request->user()->id);
        })
        ->where('date', '<=', now())
        ->orderByDesc('id')
        ->get();

        return view('Student.Notification.Notification', 
        compact('notifications'));
    }
}
