<?php

namespace App\Http\Middleware;

use App\Containers\Authentication\Actions\AuthUser;
use App\Ship\Serializer\ResponseSerializer;
use Illuminate\Http\Request;
use Closure;
use Exception;

class Authenticate {
    private const TYPE_OPTIONAL = "optional";
    private const TYPE_OPTIONAL_VALIDATED = "optional.validated";
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next, $type = "") {
        $response = null;

        switch($type){
            self::TYPE_OPTIONAL: $response = $this->_optional($request, $next);
                break;
            self::TYPE_OPTIONAL_VALIDATED: $response = $this->_optionalValidated($request, $next);
                break;
            default: $response = $this->auth($request, $next);
        }

        return $response;
    }

    private function auth(Request $request, Clousere $next){
        $user = null;
        try {
            $user = AuthUser::authenticate($request);
            $request->add(['user' => $user]);
        }catch (Exception $e) {
            return ResponseSerializer::error($e->getMessage(), null, $e->getCode());
        }
        return $next($request);
    }

    private function _optional(Request $request, Clousere $next){
        $user = null;
        try {
            $user = AuthUser::authenticate($request);
        }catch (Exception $e) {}
        $request->add(['user' => $user]);
        return $next($request);
    }

    private function _optionalValidated(Request $request, Clousere $next){
        $user = null;
        try {
            if($request->hasHeader('authorization')){
                $user = AuthUser::authenticate($request);
                $request->add(['user' => $user]);
            }
        }catch (Exception $e) {}
        return $next($request);
    }
}
