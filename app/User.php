<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function likes()
    {
        return $this->belongsToMany(User::class, 'user_likes', 'user_id', 'target_id');
    }

    public function reports()
    {
        return $this->belongsToMany(User::class, 'user_reports', 'user_id', 'target_id');
    }

    public function blocks()
    {
        return $this->belongsToMany(User::class, 'user_blocks', 'user_id', 'target_id');
    }

    public function images()
    {
        return $this->hasMany(UserImage::class, 'user_id', 'id');
    }

    public function hobbies()
    {
        return $this->hasMany(UserHobby::class, 'user_id', 'id');
    }

    /**
     * Convert data response
     * $user array
     * @return array
     */
    public static function mapUsers($users)
    {
      
        $result = array_map(function ($user) {
            
            $user['birthplace'] = config('masterdata.birthplace.' .$user['birthplace']);
            $user['housemate'] = config('masterdata.housemate.'.$user['housemate'].'.'.$user['sex'] );
            $user['aca_background'] = config('masterdata.aca_background.'.$user['aca_background'].'.'.$user['sex'] );
            $user['holiday'] = config('masterdata.holiday.'.$user['holiday'].'.'.$user['sex'] );
            $user['matching_expect'] = config('masterdata.matching_expect.'.$user['matching_expect'] );
            $user['anual_income'] = config('masterdata.anual_income.'.$user['anual_income'].'.'.$user['sex'] );
            $user['figure'] = config('masterdata.figure.'.$user['figure'] );
            $user['height'] = config('masterdata.height.'.$user['height'] );
            $user['alcohol'] = config('masterdata.alcohol.'.$user['alcohol'].'.'.$user['sex'] );
            $user['tabaco'] = config('masterdata.tabaco.'.$user['tabaco'].'.'.$user['sex'] );
            $user['job'] = config('masterdata.job.'.$user['job'].'.'.$user['sex'] );
            return $user;
        }, $users->toArray());
      
        return $result;

    }
    public static function mapUser($user)
    {
            $user['birthplace'] = config('masterdata.birthplace.' .$user['birthplace']);
            $user['housemate'] = config('masterdata.housemate.'.$user['housemate'].'.'.$user['sex'] );
            $user['aca_background'] = config('masterdata.aca_background.'.$user['aca_background'].'.'.$user['sex'] );
            $user['holiday'] = config('masterdata.holiday.'.$user['holiday'].'.'.$user['sex'] );
            $user['matching_expect'] = config('masterdata.matching_expect.'.$user['matching_expect'] );
            $user['anual_income'] = config('masterdata.anual_income.'.$user['anual_income'].'.'.$user['sex'] );
            $user['figure'] = config('masterdata.figure.'.$user['figure'] );
            $user['height'] = config('masterdata.height.'.$user['height'] );
            $user['alcohol'] = config('masterdata.alcohol.'.$user['alcohol'].'.'.$user['sex'] );
            $user['tabaco'] = config('masterdata.tabaco.'.$user['tabaco'].'.'.$user['sex'] );
            $user['job'] = config('masterdata.job.'.$user['job'].'.'.$user['sex'] );
            return $user;
    }
    public static function getRecommended()
    {
       
        $users = User::where(
            function ($query) {
                $query->selectRaw('count(id) as total')
                    ->from('user_likes')
                    ->whereColumn('target_id', 'users.id');

            }, '>=', config('const.RECOMMEND_STANDARD.LIKE')
        )
            ->where(
                function ($query) {
                    $query->selectRaw('count(id) as total')
                        ->from('user_reports')
                        ->whereColumn('target_id', 'users.id');

                }, '<=', config('const.RECOMMEND_STANDARD.REPORT')
            )
            ->get();
            
        return $users;
    }
}
