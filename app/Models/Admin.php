<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name', 'username', 'email', 'password'
    ];
    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
}
