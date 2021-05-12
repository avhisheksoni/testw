<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class test
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

        if (!Auth::check()) {
            return redirect('/home');
        }

        return $next($request);
        //  $user = Auth::user()->name;
        //  $name = user::where('name', $user)->first();
        //  if(!$name){

        //     return redirect('/home');
        //  }
        // return $next($request);
    }
}
