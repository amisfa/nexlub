<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class BannedUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userLogged = Auth::check();
        if ($userLogged) {
            $user = Auth::user();
            if ($user and $user->banned_id) {
                Auth::logout();
                return redirect('auth/login')->withErrors(['password' => 'User was banned, please contact us']);
            }
        }
        return $next($request);
    }
}
