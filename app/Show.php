<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    //The attributes that are mass assignable.
    // @var array
    protected $fillable = [
        'show_name', 'genre', 'imdb_rating', 'leader_actor'
    ];
}
