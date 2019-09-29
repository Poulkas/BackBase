<?php

namespace App\Containers\User\Transformers;

use App\Ship\Transformers\Transformer;
use App\Containers\User\Models\User;

class UserTransformer extends Transformer {
    protected $avialableIncludes = [];

    public function transform(User $model){
        $data = [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'email_verified_at' => $model->email_verified_at
        ];

        return $data;
    }
}

?>
