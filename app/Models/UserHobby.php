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

    public static function mapUsers($userHobby)
    {
        $result = array_map(function ($userHobby) {
            $userHobby['hobby'] = config('masterdata.hobby.'.$userHobby['hobby']);
            return $userHobby;
        }, $userHobby->toArray());
      
        return $result;
    }
}
