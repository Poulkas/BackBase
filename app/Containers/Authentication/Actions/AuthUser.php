<?php

namespace App\Containers\Authentication\Actions;

use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Containers\User\Models\User;
use Exception;
use JWTAuth;
use Lang;

class AuthUser {
    public static function authenticate($request) {
        $user = null;
        try {
            if(!($user = JWTAuth::setRequest($request)->parseToken()->authenticate())) {
                throw new Exception(Lang::get('auth.user_not_found'), 403);
            }
        }catch(TokenExpiredException $e) {
            throw new Exception(Lang::get('auth.token_expired'), 403);
        }catch(TokenInvalidException $e) {
            throw new Exception(Lang::get('auth.token_invalid'), 403);
        }catch(JWTException $e) {
            throw new Exception(Lang::get('auth.token_absent'), 403);
        }catch(Exception $e){
            throw new Exception(Lang::get('auth.user_not_found'), 403);
        }
        return User::find($user->id);
    }
}

?>
