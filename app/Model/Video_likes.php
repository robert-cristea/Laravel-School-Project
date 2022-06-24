<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video_likes extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_video_likes';
    protected $fillable = [
        'user_id',
        'likes',
        'dislikes',
        'video_id',
        'date',
    ];
}
