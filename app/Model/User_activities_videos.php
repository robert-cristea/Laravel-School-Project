<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_activities_videos extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_user_activities_videos';
    protected $fillable = [
        'user_id',
        'video_id',
        'status',
        'date'
    ];
}
