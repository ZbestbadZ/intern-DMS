<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models;
use App\Models\UserHobby;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'address',
        'phone',
        'sex',
        'birthday',
        'job',
        'about',
        'about_title',
        'pr_message',
        'height',
        'figure',
        'anual_income',
        'matching_expect',
        'holiday',
        'aca_background',
        'alcohol',
        'tabaco',
        'birthplace',
        'housemate',
        'pickup_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    public function likes(){
        return $this->belongsToMany(User::class, 'user_likes', 'user_id', 'target_id');
    }

    public function reports() {
        return $this->belongsToMany(User::class, 'user_reports', 'user_id', 'target_id');
    }
    
    public function blocks() {
        return $this->belongsToMany(User::class,'user_blocks','user_id', 'target_id');
    }

    public function images() {
        return $this->hasMany(UserImage::class, 'user_id', 'id');
    }

    public function hobbies()
    {
        return $this->hasMany(UserHobby::class, 'user_id', 'id');
    }

    public static function getPickup() 
    {
        $users  = User::where('pickup_status' ,'1')->get();
        return $users;
    }

    public function getHobbiesParsed() {
        $hobbiesRaw = $this->hobbies;
        $result = array_map(function($hobby) {
            
            $hobby['hobby'] = config('masterdata.hobby.'.$hobby['hobby']);
            return $hobby;
        },$hobbiesRaw->toArray());
        return $result;
    }
}

