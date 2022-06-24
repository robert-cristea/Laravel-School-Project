<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Videos_comments extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_video_comments';
    protected $fillable = [
        'user_id',
        'video_id',
        'comment',
        'likes',
        'dislikes',
        'reply_id',
        'note',
        'answer1',
        'answer2',
        'date',
    ];
}
