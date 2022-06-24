<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MindfulnessTool extends Model
{
    protected $table = 'vieva_mindfulness_tool';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Model\MindFulnessCategory', 'category_id');
    }
}
