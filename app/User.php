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

    protected $appends = [
        'job_parsed', 'tabaco_parsed', 'alcohol_parsed', 'height_parsed', 'figure_parsed', 'income_parsed', 'expect_parsed', 'holiday_parsed', 'aca_parsed', 'housemate_parsed', 'birthplace_parsed',
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
    public static function getRecommended($data)
    {
        $orderBy = $data['order'][0]['column'];
        $orderDir = $data['order'][0]['dir'];
        $start = $data['start'];
        $sexFilter = !isset($data['columns']['6']['search']['value'])?"":$data['columns']['6']['search']['value'];


        $users = User::withCount(['likes', 'reports'])
            ->having('likes_count', '>=', RECOMMEND_STANDARD_LIKE)
            ->having('reports_count', '<=', RECOMMEND_STANDARD_REPORT)
            ->where('sex','like','%'.$sexFilter.'%')
            ->get();

        return $users;
    }
}
