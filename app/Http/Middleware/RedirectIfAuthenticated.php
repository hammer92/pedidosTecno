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

        if (Auth::guard($guard)->check()) {
            if(Auth::user()->rol === 'cliente'){
                switch ($request->path()){
                    case '/':
                        return $next($request);
                        break;
                    default:
                        return redirect('/');
                }
            }else{
                return $next($request);
            }
        }else{
            switch ($request->path()){
                case '/':
                    return $next($request);
                    break;
                case 'login':
                    return $next($request);
                    break;
                case 'register':
                    return $next($request);
                    break;
                case 'password/reset':
                    return $next($request);
                    break;
                default:
                    return redirect('/login');
            }

        }


    }

}
