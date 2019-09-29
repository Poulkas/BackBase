<?php

namespace App\Ship\Models;

use App\Parents\Models\Model;

class UserRole extends Model
{
    protected $fillable = [
        'role_id',
        'user_id'
    ];

}
