<?php

namespace App\Parents\Models;

use Illuminate\Support\Facades\Hash;

interface ModelInterface {
    public function getHashedKey(){
        return $this->getKey();
        return Hash::make($this->getKey());
    }
}

?>
