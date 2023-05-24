<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard('student')->check()) {
                if (Auth::guard('student')->user()->verify=='active') {
                    return redirect()->route('user.student');
                }
            }
            if (Auth::guard('admin')->check()) {
                return redirect()->route('user.admin');
            }
            if (Auth::guard('bank')->check()) {
                return redirect()->route('user.bank');
            }
        }

        return $next($request);
    }
}
