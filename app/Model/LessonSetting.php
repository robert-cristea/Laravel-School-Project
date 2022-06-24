<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LessonSetting extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_video_lessons_settings';
    protected $guarded = ['id'];
}
