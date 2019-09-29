<?php

namespace App\Containers\User\Requests;

use Request;
use App\Ship\Traits\MultiRequestTrait;

class GetByIdRequest extends Request {
    use MultiRequestTrait;

    protected function allGetById(){
        $this->access = [
        ];

        $this->urlParameters = [
            'id'
        ];

        $this->decode = [
            'id'
        ];
    }

    protected function rulesGetById(){
        return [
            'id' => 'exists:users'
        ];
    }

    protected function authorizeGetById(){
        return [];
    }
}

?>
