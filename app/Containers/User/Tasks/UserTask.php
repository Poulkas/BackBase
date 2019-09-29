<?php

namespace App\Containers\User\Tasks;

use App\Containers\User\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserTask {

    public static function create(Array $data){
        $model = null;
        try{
            $data['password'] = Hash::make($data['password']);
            $model = User::create($data);
            $model->refresh();
        }catch(Exception $e){
            throw new Exception(Lang::get('error.create'), ['model' => 'User']);
        }
        return $model;
    }

    public static function update($id, Array $data){
        $model = User::find($id);
        try{
            $model = $model->update($data);
        }catch(Exception $e){
            throw new Exception(Lang::get('error.update'), ['model' => 'User']);
        }
        return $model;
    }

    public static function delete($id){
        $model = User::find($id);
        try{
            $model->delete();
        }catch(Exception $e){
            throw new Exception(Lang::get('error.delete'), ['model' => 'User']);
        }
        return $model;
    }

    public static function getById($id, Array $includes = []){
        return User::with($includes)->find($id);
    }

    public static function exists($value, $column = 'id'){
        return User::where($column, $value)->count()>0;
    }

    public static function getBuilder(){
        return User::query();
    }

    public static function getDataFillable($data){
        $fillable = (new User())->getFillable();
        $newData = [];
        foreach ($fillable as $key => $value) {
            if(array_key_exists($value, $data)){
                $newData[$value] = $data[$value];
            }
        }
        return $newData;
    }
}

?>
