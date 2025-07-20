<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PrivateRequest;
use App\Models\Session;
use App\Models\User;

class PrivateSession extends Controller
{
    public function view(Request $request){
        $private_sessions = Session::
        where('type', 'private')
        ->with(['teacher', 'users:id,nick_name']) 
        ->get()
        ->map(function($item){
            $users = $item->users->map(function ($user) {
                return $user->makeHidden('pivot');
            });
            return [
                'id' => $item?->id,
                'name' => $item?->name,
                'date' => $item?->date,
                'from' => $item?->from,
                'to' => $item?->to,
                'teacher' => $item?->teacher?->nick_name,
                'student' => $users,
            ];
        });

        return response()->json([
            'private_sessions' => $private_sessions,
        ]);
    }

    public function private_requests(Request $request){
        $private_request = PrivateRequest::
        where('status', 'Pendding')
        ->get();

        return response()->json([
            'private_request' => $private_request,
        ]);
    }
}
