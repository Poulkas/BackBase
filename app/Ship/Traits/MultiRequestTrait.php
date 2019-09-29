<?php

namespace App\Ship\Traits;

trait MultiRequestTrait {
    protected $parsedMethod = null;

    public function authorize() {
        $this->parsedMethod = $this->route()->getActionMethod();
        return $this->check($this->getAuthorize());
    }

    public function rules() {
        return $this->getRules();
    }

    public function all($keys = null){
        $this->getAll();
        return parent::all($keys);
    }

    protected function getAll(){
        call_user_func(array($this, "all".$this->parsedMethod));
    }

    protected function getRules(){
        return call_user_func(array($this, "rules".$this->parsedMethod));
    }

    protected function getAuthorize(){
        return call_user_func(array($this, "authorize".$this->parsedMethod));
    }

}

?>
