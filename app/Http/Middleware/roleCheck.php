<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class roleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle(Request $request, Closure $next)
    {
        if(Auth::check() && Auth::user()->UserType =="admin"){
            return $next($request);
        }
            
        return redirect('home')->with('error',"You don't have admin access.");

        if(Auth::check() && Auth::user()->UserType =="restricted"){
            return redirect('login')->with('error',"You don't have access.");
        }   
        
    }
}
