<?php

namespace App\Http\Middleware;

use Closure;

class checkAge
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
        echo 'Group MiddleWare';
        //if($request->age > 10) {
          //  return redirect('customer'); 
        //}
        
        return $next($request);
    }
}
