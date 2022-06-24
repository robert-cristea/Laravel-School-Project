<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quote_video_related extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_quote_video_related';
    protected $fillable = [
        'video_id',
    ];
}
