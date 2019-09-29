<?php

namespace App\Http\Middleware;

use App\Containers\Authentication\Actions\AuthUser;
use App\Ship\Serializer\ResponseSerializer;
use Illuminate\Http\Request;
use Closure;
use Exception;

class Authenticate {
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next) {
        $user = null;
        try {
            $user = AuthUser::authenticate($request);
            $request->add(['user' => $user]);
        } catch (Exception $e) {
            return ResponseSerializer::error($e->getMessage(), null, $e->getCode());
        }
        return $next($request);
    }
}
