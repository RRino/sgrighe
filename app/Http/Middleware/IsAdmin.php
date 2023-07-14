<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check() && auth()->user()->is_admin == 1){
            return $next($request);
        }else if(auth()->check() && auth()->user()->is_admin == 2){
            return $next($request);
       }else if(auth()->check() && auth()->user()->is_admin == 0){
            return $next($request);
        }
        //return response('not allowed to take this action', 500);
       return redirect('/nonAut');   
    }

    /*
            if (auth()->user()->is_admin == 1) {
                return redirect()->route('admin.home');
            } else if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            } else if (auth()->user()->type == 2) {
                return redirect()->route('manager.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')
                ->with('error', 'Email-Address And Password Are Wrong.');
        }
    */
}
