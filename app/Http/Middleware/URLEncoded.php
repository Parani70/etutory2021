<?php

namespace App\Http\Middleware;

use Closure;

class URLEncoded
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
      //  $request->headers->set('Accept', 'application/x-www-form-urlencoded');
        return $next($request);
    }
}
