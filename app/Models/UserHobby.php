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

    protected $appends = [
        'hobby_parsed'
    ];



    public function users() {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }

    public function getHobbyParsedAttribute()
    {
        return config('masterdata.hobby.'.$this->hobby);
    } 

}
