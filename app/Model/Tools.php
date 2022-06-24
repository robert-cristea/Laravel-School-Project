<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_tools';
    protected $fillable = [
        'name_frensh',
        'name_english',
        'description_frensh',
        'description_english'
    ];

}
