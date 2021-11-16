<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DocenteAuth
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
        if(auth()->check()){
            if (auth()->user()->id_rol_usuario == '2') {
                return $next($request); 
            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }
    }
}
