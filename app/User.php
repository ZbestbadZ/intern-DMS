<?php

namespace App;

use App\Models\UserHobby;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD
use App\Models;
use App\Models\UserHobby;
=======
>>>>>>> 117f107d0059ae9b52407e41490162a96f39ce5b

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
        'username',
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
        'pickup_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'datetime:Y-m-d'
    ];

    protected $appends = [
        'age',
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

    public function getHobbiesParsed($id) {
        $hobbiesRaw = User::with('hobbies')->find($id);
        $result = array_map(function($hobby) {
            $hobby['hobby'] = config('masterdata.hobby.'.$hobby['hobby']);
            return $hobby;
        },$hobbiesRaw->hobbies->toArray());
        return $result;
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->diffInYears(Carbon::now());
    }

    public static function getPickup($filter, $orderByParams, $start)
    {
        $orderBy = array_key_first($orderByParams);
        $orderDir = $orderByParams[$orderBy];
        $searchName = $filter['name'];
        $searchPhone = $filter['phone'];

        $searchAge = $filter['age'];

        $searchBirthDate = empty($searchAge) ? Carbon::now() : Carbon::now()->year($searchAge);

        $query = User::with(['hobbies'])
            ->where('pickup_status', PICKUP_STATUS)
            ->orderBy($orderBy, $orderDir);

        if (!is_null($searchName)) {
            $query->where('name', 'like', '%' . $searchName . '%');
        }

        if (!is_null($searchPhone)) {
            $query->where('phone', 'like', '%' . $searchPhone . '%');
        }
        if (!is_null($searchAge)) {
            $searchBirthDate = Carbon::now()->year(Carbon::now()->format('yy') - $searchAge);
            $searchBirthYear = Carbon::now()->year(Carbon::now()->format('yy') - $searchAge)->startOfYear();
           
            $query->whereBetween('birthday', array($searchBirthYear, $searchBirthDate));
            

        }

        $recordsFiltered = clone ($query);
        $users = $query->skip($start)->take(PAGINATION)->get();
        $recordsFiltered = $recordsFiltered->select('id')->count();
        return compact(['users', 'recordsFiltered']);
    }

}
