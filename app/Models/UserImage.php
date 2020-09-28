<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserImage extends Model
{
    protected $table = 'user_images';

    protected $fillable = [
        'user_id', 'path', 'type'
    ];

    public function users()
    {
        return $this->beLongsTo(User::class, 'user_id', 'id');
    }
}
