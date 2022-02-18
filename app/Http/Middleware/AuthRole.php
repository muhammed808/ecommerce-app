<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next ,$role)
    {
        if($role === 'ADMIN'){
            if( Auth::user()->user_type === $role){

                return $next($request);
    
            }else{
                session()->flush();

                return redirect()->route('login');
            }
        }elseif($role === 'USER'){
            
            if( Auth::user()->user_type === $role ){

                return $next($request);

            }else{
                session()->flush();

                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
