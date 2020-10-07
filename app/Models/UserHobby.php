<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserHobby extends Model
{
    protected $table = 'user_hobbies';
    
    protected $fillable = [
        'user_id', 'hobby'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }
}
