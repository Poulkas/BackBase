<?php

namespace App\Ship\Models;

use App\Parents\Models\Model;

class Permission extends Model
{
    protected $fillable = [
        'name',
        'label'
    ];

}
