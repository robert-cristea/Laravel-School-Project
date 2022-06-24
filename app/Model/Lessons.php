<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lessons extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_video_lessons';
    protected $fillable = [
        'serie_id',
        'tools_id',
        'challenge_id',
        'coach_id',
        'title_frensh',
        'title_english',
        'description_frensh',
        'description_english',
        'video_file',
        'date_creation',
        'order_number',
    ];
    // protected $with = ['settings'];

    // relationships
    public function settings()
    {
        return $this->hasOne('App\Model\LessonSetting', 'settings_id', 'lesson_id');
    }
}
