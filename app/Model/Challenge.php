<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    public $timestamps = false;
    protected $table = 'vieva_challenges';

    protected $guarded = ['challenge_id'];
}
