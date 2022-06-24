<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Video_lessons extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_video_lessons';
    protected $fillable = [
        'serie_id',
        'tool_id',
        'title_frensh',
        'title_english',
        'description_frensh',
        'description_english',
        'video_file',
        'date_creation',
    ];
}
