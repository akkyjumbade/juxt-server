<?php

namespace LaravelPreset\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FirewallMiddleware
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
      return $next($request);
   }
}
