<?php

namespace App\Http\Middleware;

use Closure;
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
        switch ($guard) {
            case 'admin':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('login');
              }
              break;

            case 'memberandsale':
              if (!(Auth::guard('sales_members')->check() || Auth::guard('member')->check())){
                return redirect()->route('member.login');
              }
              break;

            case 'sales_members':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('member.login');
              }
              break;

            case 'member':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('member.login');
              }
              break;
              
            case 'staff':
              if (Auth::guard($guard)->check()) {
                return redirect()->route('staff.login');
              }
              break;
            
  
        }
        return $next($request);
    }
}
