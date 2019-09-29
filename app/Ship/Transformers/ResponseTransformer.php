<?php

namespace App\Ship\Transformers;

use League\Fractal\TransformerAbstract;

class ResponseTransformer extends TransformerAbstract{

    public function transform($data){
        return $data;
    }
}

?>
