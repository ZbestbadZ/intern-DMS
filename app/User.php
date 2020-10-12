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

    /**
     * Convert data response
     * $user array
     * @return array
     */
    public static function mapUsers($users)
    {

        $result = array_map(function ($user) {

            $user['birthplace'] = config('masterdata.birthplace.' . $user['birthplace']);
            $user['housemate'] = config('masterdata.housemate.' . $user['housemate'] . '.' . $user['sex']);
            $user['aca_background'] = config('masterdata.aca_background.' . $user['aca_background'] . '.' . $user['sex']);
            $user['holiday'] = config('masterdata.holiday.' . $user['holiday'] . '.' . $user['sex']);
            $user['matching_expect'] = config('masterdata.matching_expect.' . $user['matching_expect']);
            $user['anual_income'] = config('masterdata.anual_income.' . $user['anual_income'] . '.' . $user['sex']);
            $user['figure'] = config('masterdata.figure.' . $user['figure']);
            $user['height'] = config('masterdata.height.' . $user['height']);
            $user['alcohol'] = config('masterdata.alcohol.' . $user['alcohol'] . '.' . $user['sex']);
            $user['tabaco'] = config('masterdata.tabaco.' . $user['tabaco'] . '.' . $user['sex']);
            $user['job'] = config('masterdata.job.' . $user['job'] . '.' . $user['sex']);
            return $user;
        }, $users->toArray());

        return $result;

    }

    public static function getPickup($data)
    {
        $orderBy = $data['columns'][$data['order'][0]['column']]['name'];
        $orderDir = $data['order'][0]['dir'];
        $searchName = $data['columns']['1']['search']['value'];
        $searchPhone = $data['columns']['3']['search']['value'];
        $searchAge = isset($data['columns']['2']['search']['value']) ? Carbon::now()->format('yy') - $data['columns']['2']['search']['value'] : "";

        if ($orderBy == 'age') {
            $orderBy = 'birthday';
        }

        $users = User::with(['hobbies'])
            ->where('pickup_status', PICKUP_STATUS)
            ->where('name', 'like', '%' . $searchName . '%')
            ->whereYear('birthday', 'like', '%' . $searchAge . '%')
            ->where('phone', 'like', '%' . $searchPhone . '%')
            ->orderBy($orderBy, $orderDir)
            ->skip($data['start'])->take(PAGINATION)
            ->get();

        $users = User::mapUsers($users);

        return $users;
    }

}
