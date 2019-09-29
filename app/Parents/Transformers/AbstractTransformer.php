<?php

namespace App\Parents\Transformers;

use League\Fractal\TransformerAbstract;

abstract class AbstractTransformer extends TransformerAbstract {
    protected function item($data, $transformer, $resourceKey = null){
        if($data===null){
            return $this->null();
        }
        return parent::item($data, $transformer, $resourceKey);
    }

    protected function collection($data, $transformer, $resourceKey = null){
        if($data===null){
            $data = [];
        }
        return parent::collection($data, $transformer, $resourceKey);
    }

    protected function paginte($model, $transformer, $resourceKey = null){
        return $this->null();
    }
}

?>
