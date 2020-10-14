<?php

namespace App;

use App\Models\UserHobby;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models;

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
        'housemate',
        'pickup_status',
        'api_token'
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
        'age', 'job_parsed', 'tabaco_parsed', 'alcohol_parsed', 'height_parsed', 'figure_parsed', 
        'income_parsed', 'expect_parsed', 'holiday_parsed', 'aca_parsed', 'housemate_parsed', 
        'birthplace_parsed', 'sex_parsed'
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

    public function getJobParsedAttribute() {
        return config('masterdata.job.' . $this['job'] . '.' . $this['sex']);
    }

    public function getHeightParsedAttribute() {
        return config('masterdata.height.' . $this['height']);
    }

    public function getFigureParsedAttribute() {
        return config('masterdata.figure.' . $this['figure']);
    }

    public function getIncomeParsedAttribute() {
        return config('masterdata.anual_income.' . $this['anual_income'] . '.' . $this['sex']);
    }

    public function getExpectParsedAttribute() {
        return config('masterdata.matching_expect.' . $this['matching_expect'] );
    }

    public function getHolidayParsedAttribute() {
        return config('masterdata.holiday.' . $this['holiday'] . '.' . $this['sex']);
    }

    public function getAcaParsedAttribute() {
        return config('masterdata.aca_background.' . $this['aca_background'] . '.' . $this['sex']);
    }

    public function getAlcoholParsedAttribute() {
        return config('masterdata.alcohol.' . $this['alcohol'] . '.' . $this['sex']);
    }

    public function getTabacoParsedAttribute() {
        return config('masterdata.tabaco.' . $this['tabaco'] . '.' . $this['sex']);
    }

    public function getBirthplaceParsedAttribute() {
        return config('masterdata.birthplace.' . $this['birthplace']);
    }

    public function getHousemateParsedAttribute() {
        return config('masterdata.housemate.' . $this['housemate'] . '.' . $this['sex']);
    }

    public function getSexParsedAttribute() {
        if ($this->sex == 1) {
            return "Male";
        }
        return "Female";
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
