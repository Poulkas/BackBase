<?php

namespace App\Ship\Models;

use App\Ship\Models\User\UserAbstract;
use Role;
use UserRole;
use Permission;
use UserPermission;

class User extends UserAbstract {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function userRoles(){
        return $this->hasMany(UserRole::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class, 'userRoles');
    }

    public function userPermissions(){
        return $this->hasMany(UserPermission::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class, 'userPermissions');
    }

    public function hasRoles(Array $roles){
        return $this->roles()->whereIn('label', $roles)->get()->count()>0;
    }

    public function hasRole(String $role){
        return $this->roles('label',$role)->first()!=null;
    }

    public function hasPermissions(Array $permissions){
        return $this->permissions()->whereIn('label', $permissions)->get()->count()>0;
    }

    public function hasPermission(String $permission){
        return $this->permissions('label', $permission)->first()!=null;
    }
}
