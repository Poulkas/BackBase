<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;

class NoAuth {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next) {
        $request->add(['user' => null]);
        return $next($request);
    }
}
