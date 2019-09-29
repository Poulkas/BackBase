<?php

namespace App\Parents\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest {
    protected $access = [];
    protected $urlParameters = [];
    protected $decode = [];

    public function all($keys = null){
        $data = parent::all();
        foreach ($this->urlParameters as $key => $param) {
            $data[$param] = $this->route($param);
        }
        return $this->decodeAll($data);
    }

    public function check(Array $methods){
        $iter = 0;
        $countMethods = count($methods);
        $hasAccess = $this->onCheck();

        while($hasAccess && $iter<$countMethods){
            $hasAccess = call_user_func(array($this, $methods[$iter]), $this->route()->getParameters(), $this->input());
            $iter++;
        }

        return $hasAccess;;
    }

    protected function decodeAll($data){
        foreach ($this->decode as $key => $field) {
            $data[$field] = $data[$field]; //DECODE
        }
        return $data;
    }

    protected function onCheck(){
        $hasAccess = true;
        if(count($this->access)>0){
            $hasAccess = $this->_onCheck($this->parseAccess($this->access));
        }
        return $hasAccess;
    }

    protected function parseAccess(Array $access){
        $parsedAccess = [];
        foreach ($access as $key => $value) {
            $parsedAccess[$key] = explode(',', $value);
        }
        return $parsedAccess;
    }

    protected function validateUserRoles($user, $roles){
        return $this->user->hasRoles($roles);
    }

    protected function validateUserPermissions($user, $permissions){
        return $this->user->hasPermissions($permissions);
    }

    private function _onCheck($access){
        $hasAccess = true;
        $user = $this->user();
        if($user){
            if(isset($access['roles'])){
                $hasAccess = $this->validateUserRoles($user, $access['roles']);
            }
            if(isset($access['permission'])){
                $hasAccess = $this->validateUserRoles($user, $access['permission']);
            }
        }else {
            $hasAccess = false;
        }
        return $hasAccess;
    }
}

?>
