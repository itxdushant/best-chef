<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ChefCheckMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()):
            $type = Auth::user()->user_type; 
            if ($type == 'chef'):
                return $next($request);
            else:
                return \Redirect::to('login');
            endif;
        endif;
        return \Redirect::to('login');
    }

}
