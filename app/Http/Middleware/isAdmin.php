<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class isAdmin
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
        //use Illuminate\Support\Facades\Auth;
        if(Auth::user()->is_admin()){
            //跳转下一个请求
            return $next($request);
        }else{
            return redirect('/');
        }

    }
}
