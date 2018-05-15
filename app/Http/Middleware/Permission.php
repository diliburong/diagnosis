<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->url();
        $path = $request->path();

        // if($path == 'users' ||)
        if($path == 'users' || $path=='user_add' ) {
            if(Auth::user()->role_id == 1) {
                return redirect()->route('permission');
            }
        }

        return $next($request);
    }
}
