<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    public static $rules = array();
    protected $table = 'your_table';

    protected $fillable = [
        'name', 'username', 'email', 'password'
    ];
    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime'
    ];
    public $timestamps = true;
    
}
