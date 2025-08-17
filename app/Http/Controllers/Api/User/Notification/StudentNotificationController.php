<?php

namespace App\Http\Controllers\Api\User\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Notification;

class StudentNotificationController extends Controller
{ 
    public function __construct(private Notification $notifications){}

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

        return response()->json([
            'notifications' => $notifications
        ]);
    }
}
