<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MindfulnessCategory extends Model
{
    protected $table = 'vieva_mindfulness_categories';
    protected $guarded = ['id'];
    public $timestamps = false;
}
