<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Week_progress extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_week_progress';
    protected $fillable = [
        'user_id',
        'stress_level',
        'workload_level',
        'energy_level',
        'highlight_of_week',
        'date',
    ];

    protected $appends = ['ymd'];

    public function getYmdAttribute()
    {
        $ymd = explode(' ', $this->date)[0];
        return $ymd;
    }
}
