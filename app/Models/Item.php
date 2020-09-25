<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $hidden = [
        'name', 'pice','image_path'
    ];
}
