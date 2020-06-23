<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use function dd;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "funcionarios" && Auth::guard($guard)->check()) {
            dd("RedirectIfAuthenticated - funcionarios");
        }

        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
