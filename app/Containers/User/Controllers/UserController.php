<?php

namespace App\Containers\User\Controllers;

use App\Ship\Controllers\Controller;
use App\Containers\User\Actions\UserAction;
use App\Containers\User\Transformers\UserTransformer;
use App\Containers\User\Requests\GetByIdRequest;
use Request;

class UserController extends Controller
{
    public function Create(Request $request){
        $data = $this->callActionMethod('createUser', new UserAction(), $request);
        return $this->transform('item', $data, new UserTransformer());
    }

    public function Update(Request $request, $id){
        $data = $this->callActionMethod('updateUser', new UserAction(), $request, $id);
        return $this->transform('item', $data, new UserTransformer());
    }

    public function Delete(Request $request, $id){
        $data = $this->callActionMethod('deleteUser', new UserAction(), $request, $id);
        return $this->response();
    }

    public function GetById(GetByIdRequest $request, $id){
        $data = $this->callActionMethod('getUserById', new UserAction(), $request, $id);
        return $this->transform('item', $data, new UserTransformer());
    }

    public function GetAll(Request $request){
        $data = $this->callActionMethod('getAll', new UserAction(), $request);
        return $this->transform('paginate', $data, new UserTransformer(), $request);
    }
}
