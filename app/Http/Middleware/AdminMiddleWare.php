<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LoginUser;
use Carbon\Carbon;

class AdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // $now = Carbon::now();
        // $timeMinus120Minutes = $now->subMinutes(300);
        // $l_user = LoginUser::
        // where('type', 'web')
        // ->where('user_id', auth()->user()->id)
        // // ->where('updated_at', '>=', $timeMinus120Minutes)
        // ->first();
        // if( (!empty($l_user) && auth()->user()->position == 'admin') || (!empty($l_user) &&auth()->user()->position == 'user_admin' )){
        //     return $next($request);
        // }
        // else{
        //     return redirect()->route('login.index');
        // }
        
        $user = auth()->user();

        // Check if user is authenticated
        if ($user) {
            $l_user = LoginUser::where('type', 'web')
                ->where('user_id', $user->id)
                ->first();

            // Check if the logged-in user has the appropriate position
            if (!empty($l_user) && ($user->position == 'admin' || $user->position == 'user_admin')) {
                return $next($request);
            }
        }

        // Redirect to login page if user is not authenticated or does not have the appropriate position
        return redirect()->route('login.index');
    }
}
