<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quotes extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_quotes';
    protected $fillable = [
        'content',
        'language',
        'video_id',
        'Author'
    ];
}
