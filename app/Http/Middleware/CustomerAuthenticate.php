<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CustomerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="customer")
    {
        $segments = $request->segments();
        $currentURL = implode('/', $segments);
        
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                if ($currentURL != '/customer/login') {
                    $request->session()->put('hi', $currentURL);
                }

                return redirect('/customer/login');
            }
        }
        return $next($request);
    }
}
