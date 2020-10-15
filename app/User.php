<?php

namespace App;

use App\Models\UserHobby;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

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

    protected $appends = [
        'age', 'job_parsed', 'tabaco_parsed', 'alcohol_parsed', 'height_parsed', 'figure_parsed', 'income_parsed', 'expect_parsed', 'holiday_parsed', 'aca_parsed', 'housemate_parsed', 'birthplace_parsed'
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

    public function likes()
    {
        return $this->belongsToMany(User::class, 'user_likes', 'target_id', 'user_id');
    }

    public function reports()
    {
        return $this->belongsToMany(User::class, 'user_reports', 'target_id', 'user_id');
    }

    public function blocks()
    {
        return $this->belongsToMany(User::class, 'user_blocks', 'target_id', 'user_id');
    }

    public function images()
    {
        return $this->hasMany(UserImage::class, 'user_id', 'id');
    }

    public function hobbies()
    {
        return $this->hasMany(UserHobby::class, 'user_id', 'id');
    }

    public function getJobParsedAttribute()
    {
        return $this['job'] = config('masterdata.job.' . $this['job'] . '.' . $this['sex']);
    }
    public function getTabacoParsedAttribute()
    {
        return $this['tabaco'] = config('masterdata.tabaco.' . $this['tabaco'] . '.' . $this['sex']);
    }
    public function getAlcoholParsedAttribute()
    {
        return $this['alcohol'] = config('masterdata.alcohol.' . $this['alcohol'] . '.' . $this['sex']);
    }
    public function getHeightParsedAttribute()
    {
        return $this['height'] = config('masterdata.height.' . $this['height']);
    }
    public function getFigureParsedAttribute()
    {
        return $this['figure'] = config('masterdata.figure.' . $this['figure']);
    }
    public function getIncomeParsedAttribute()
    {
        return $this['anual_income'] = config('masterdata.anual_income.' . $this['anual_income'] . '.' . $this['sex']);

    }
    public function getExpectParsedAttribute()
    {
        return $this['matching_expect'] = config('masterdata.matching_expect.' . $this['matching_expect']);

    }
    public function getHolidayParsedAttribute()
    {
        return $this['holiday'] = config('masterdata.holiday.' . $this['holiday'] . '.' . $this['sex']);

    }
    public function getAcaParsedAttribute()
    {
        return $this['aca_background'] = config('masterdata.aca_background.' . $this['aca_background'] . '.' . $this['sex']);

    }
    public function getHousemateParsedAttribute()
    {
        return $this['housemate'] = config('masterdata.housemate.' . $this['housemate'] . '.' . $this['sex']);

    }public function getBirthplaceParsedAttribute()
    {
        return $this['birthplace'] = config('masterdata.birthplace.' . $this['birthplace']);

    }
    public function getAgeAttribute()
    {
        return Carbon::parse($this->birthday)->diffInYears(Carbon::now());
    }

    public static function filterJob($query, $searchJob)
    {
        $allJobs = config('masterdata.job');

        $maleSearchJobIndex = null;
        $femaleSearchJobIndex = null;

        foreach ($allJobs as $key => $value) {
            foreach ($value as $gender => $job) {
                if ($job == $searchJob) {
                    if ($gender) {
                        $maleSearchJobIndex = $key;
                    } else {
                        $femaleSearchJobIndex = $key;
                    }
                }

            }

        }
        $query->where(function ($q) use ($maleSearchJobIndex, $femaleSearchJobIndex) {
            if (!is_null($maleSearchJobIndex)) {
                $q->where(function ($q) use ($maleSearchJobIndex) {
                    $q->where(['sex' => MALE, 'job' => $maleSearchJobIndex]);

                });

            }
            if (!is_null($femaleSearchJobIndex)) {
                $q->orWhere(function ($q) use ($femaleSearchJobIndex) {
                    $q->where(['sex' => FEMALE, 'job' => $femaleSearchJobIndex]);

                });
            }
        });
    }
    public static function setFilterQuery($query, $filter, $orderParams)
    {
        $orderBy = array_key_first($orderParams);
        $orderDir = $orderParams[$orderBy];
        $filterGender = $filter['sex'];
        $searchName = $filter['name'];
        $searchAge = $filter['age'];
        $searchPhone = $filter['phone'];
        $searchAge = $filter['age'];
        $filterJob = $filter['job'];

        $query->orderBy($orderBy, $orderDir);

        if (!is_null($filterGender)) {
            $query->where('sex', '=', $filterGender);
        }

        if (!is_null($filterJob) && $filterJob != -1) {
            self::filterJob($query, $filterJob);
        }

        if (!is_null($searchName)) {
            $query->where('name', 'like', '%' . $searchName . '%');
        }

        if (!is_null($searchPhone)) {
            $query->where('phone', 'like', '%' . $searchPhone . '%');
        }
        if (!is_null($searchAge)) {
            $query->where(DB::raw('TIMESTAMPDIFF(YEAR,birthday,CURDATE())'), $searchAge);

        }
    }

    public static function getRecommended($filter, $orderParams, $start)
    {

        $query = User::withCount(['likes as likes', 'reports as reports'])
            ->having('likes', '>=', RECOMMEND_STANDARD_LIKE)
            ->having('reports', '<=', RECOMMEND_STANDARD_REPORT);

        $recordsTotal = clone ($query);
        $recordsTotal = count($recordsTotal->get());

        self::setFilterQuery($query, $filter, $orderParams);

        $recordsFiltered = clone ($query);
        $recordsFiltered = count($recordsFiltered->get());

        $users = $query->skip($start)->take(PAGINATION)->get();

        return compact(['users', 'recordsFiltered', 'recordsTotal']);
    }

    public static function getPickup($filter, $orderByParams, $start)
    {
        $query = User::with(['hobbies'])
            ->where('pickup_status', PICKUP_STATUS);

        $recordsTotal = clone ($query);
        $recordsTotal = $recordsTotal->select('id')->count();

        self::setFilterQuery($query, $filter, $orderByParams);

        $recordsFiltered = clone ($query);
        $recordsFiltered = $recordsFiltered->select('id')->count();

        $users = $query->skip($start)->take(PAGINATION)->get();

        return compact(['users', 'recordsFiltered','recordsTotal']);
    }

}
