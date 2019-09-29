<?php

namespace App\Ship\Models;

use App\Parents\Models\Model;

class UserPermission extends Model
{
    protected $fillable = [
        'permission_id',
        'user_id'
    ];

}
