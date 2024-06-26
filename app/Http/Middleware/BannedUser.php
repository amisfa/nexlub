<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    public function handle($request, Closure $next): mixed
    {
        if (DB::connection()->getDatabaseName()) {
            $userLogged = Auth::check();
            if ($userLogged) {
                $user = Auth::user();
                if ($user and $user->banned_id) {
                    Auth::logout();
                    return redirect('auth/login')->withErrors(['password' => 'User banned, please contact support']);
                }
            }
        }
        return $next($request);
    }
}
