<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_series';
    protected $fillable = [
        'title_frensh', 
        'title_english', 
        'description_frensh', 
        'description_english', 
        'picture',
        'display_order'
    ];
}
