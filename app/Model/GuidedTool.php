<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GuidedTool extends Model
{
    protected $table = 'vieva_guided_meditation';
    protected $guarded = ['guided_meditation_id'];
    public $timestamps = false;
}
