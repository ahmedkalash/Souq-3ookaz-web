<?php

namespace App\Http\Middleware\Admin;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guest()){
            return redirect(route('admin.login.show'));
        }
        if(!Auth::user()->isAdmin()){
            if(Auth::user()->isCustomer()) {
                return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
