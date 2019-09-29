<?php

namespace App\Containers\User\Actions;

use App\Containers\User\Tasks\UserTask;
use Request;

class UserAction {

    public function createUser(Request $request){
        $data = UserTask::getDataFillable($request->input());
        $model = UserTask::create($data);
        return $model;
    }

    public function updateUser(Request $request, $id){
        $data = UserTask::getModelFillable($request->input());
        $model = UserTask::update($id, $data);
        return $model;
    }

    public function deleteUser(Request $request, $id){
        $model = UserTask::delete($id);
        return true;
    }

    public function getUserById(Request $request, $id){
        $model = UserTask::getById($id);
        return $model;
    }

    public function getAll(Request $request){
        $paginate = UserTask::getBuilder();
        return $paginate;
    }
}

?>
