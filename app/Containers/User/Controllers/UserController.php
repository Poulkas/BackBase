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
        $data = $this->callActionMethod(new UserAction(), 'createUser', $request);
        return $this->transform('item', $data, new UserTransformer());
    }

    public function Update(Request $request, $id){
        $data = $this->callActionMethod(new UserAction(), 'updateUser', $request, $id);
        return $this->transform('item', $data, new UserTransformer());
    }

    public function Delete(Request $request, $id){
        $data = $this->callActionMethod(new UserAction(), 'deleteUser', $request, $id);
        return $this->response();
    }

    public function GetById(GetByIdRequest $request, $id){
        $data = $this->callActionMethod(new UserAction(), 'getUserById', $request, $id);
        return $this->transform('item', $data, new UserTransformer());
    }

    public function GetAll(Request $request){
        $data = $this->callActionMethod(new UserAction(), 'getAll', $request);
        return $this->transform('paginate', $data, new UserTransformer(), $request);
    }
}
