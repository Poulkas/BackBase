<?php

namespace App\Ship\Models;

use App\Parents\Models\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
        'label'
    ];

}
