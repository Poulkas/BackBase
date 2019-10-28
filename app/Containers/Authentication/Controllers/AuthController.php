<?php

namespace App\Containers\Authentication\Controllers;

use App\Ship\Controllers\Controller;
use App\Containers\User\Transformers\UserTransformer;
use App\Containers\User\Models\User;
use Request;
use Exception;

class AuthController extends Controller {
    public function Login(Request $request){
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
            $user = JWTAuth::user();
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return [
            "data" => [
                'user' => $user,
                'token' => $token
            ]
        ];
    }

    public function Logout(Request $request, $id){
        return ["data" => "Logout"];
    }
}
