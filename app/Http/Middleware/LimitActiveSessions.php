<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\LoginUser;
use App\Models\User;

class LimitActiveSessions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $user = User::where('email', $request->email)
        // ->first();
        // $l_user = LoginUser::where('type', 'mobile')
        // ->where('user_id', $user->id)
        // ->first();

        // if ( $l_user ) {
        //     return response()->json(['error' => 'You can only be logged in on two devices at the same time.'], 403);
        // }

        return $next($request);
    }
}
