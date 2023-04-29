<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(explode('/',$request->path())[0] =='admin'){
                return route('admin.login.show');
            }
            if(explode('/',$request->path())[0] =='vendor'){
                return route('vendor.login.show');
            }
             return route('login.show');
        }
    }
}
