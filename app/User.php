<?php

namespace App;

use App\Models\UserHobby;
use Carbon\Carbon;
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
