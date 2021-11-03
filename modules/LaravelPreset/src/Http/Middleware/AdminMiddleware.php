<?php

namespace Modules\LaravelPreset\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
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
      if (!$request->user()) {
         return abort(401);
      }
      $user = $request->user();
      $canAccessAdmins = ['admin'];
      if (in_array($user->role_code, $canAccessAdmins)) {
         return $next($request);
      }
      return abort(401);
   }
}
