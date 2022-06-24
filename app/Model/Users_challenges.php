<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Users_challenges extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_users_challenges';
    protected $fillable = [
        'user_id',
        'challenge_id',
        'accepted',
        'date',
    ];
}
