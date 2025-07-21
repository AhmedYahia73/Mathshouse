<?php

namespace App\Http\Controllers\Api\Admin\Live;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

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
        ->get()
        ->map(function($item){
            return [
                'id' => $item->id,
                'student' => $item?->user?->nick_name,
                'day' => Carbon::parse($item->date)->format('l'),
                'date' => $item->date,
                'from' => $item->from,
                'to' => $item->to,
                'teacher' => $item?->teacher?->nick_name,
            ];
        });

        return response()->json([
            'private_request' => $private_request,
        ]);
    }

    public function private_request_status( Request $request, $id ){
        $validator = Validator::make($request->all(), [
            'status' => ['required', 'in:Confirm,Rejected'],
            'rejected_reason' => ['required_if:status,Rejected']
        ]);
        if ($validator->fails()) { // if Validate Make Error Return Message Error
            return response()->json([
                'errors' => $validator->errors(),
            ],400);
        }

        if ($request->status == 'Confirm') {
            PrivateRequest::
            where('id', $id)
            ->update([
                'status' => $request->status,
            ]);
        } 
        else {
            PrivateRequest::
            where('id', $id)
            ->update([
                'status' => $request->status,
                'rejected_reason' => $request->rejected_reason,
            ]);
        }

        return response()->json([
            'success' => 'You change status success'
        ]);
    }
}
