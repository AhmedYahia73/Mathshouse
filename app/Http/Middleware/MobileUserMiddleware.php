<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LoginUser;
use Carbon\Carbon;

class MobileUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Check if user is authenticated
        if ($user) {
            $l_user = LoginUser::where('type', 'mobile')
            ->where('user_id', $user->id)
            ->first();
            // Check if the logged-in user has the appropriate position
            if (!empty($l_user) && auth()->user()->position == 'student') {
                return $next($request);
            }
        }
    }
}
