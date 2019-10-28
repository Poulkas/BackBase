<?php

namespace App\Http\Controllers\Auth;

use App\Ship\Controllers\Controller;
use Request;

class VerificationController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    public function __invoke(Request $request, $token = ""){
        return true;
    }
}
