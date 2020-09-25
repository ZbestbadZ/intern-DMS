<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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
        'housemate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
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
        return $this->belongsToMany('App\User', 
        'user_likes', 'user_id','target_id'
    );
    }
    public function reports() {
        return $this->belongsToMany('App\User',
        'user_reports','user_id','target_id'
    );
    }
    
    public function blocks() {
        return $this->belongsToMany('App\User',
        'user_blocks','user_id','target_id'
    );
    }
    public function images() {
        return $this->hasMany('App\Models\UserImage');
    }
}
