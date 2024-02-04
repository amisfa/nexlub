<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MavensGuardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((request()->has('Password') && request('Password') == env('MAVENSE_CALLBACK_KEY')) && request()->ip() == '37.60.232.88')
            return $next($request);
        return response()->json([], 403);
    }
}
