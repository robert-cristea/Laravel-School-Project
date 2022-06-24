<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class All_checks extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_all_checks';
    protected $fillable = [
        'user_id',
        'checks_type',
        'score',
        'percent',
        'check_datetime',
        'QA1',
        'QA2',
        'QA3',
        'QA4',
        'QA5',
        'QA6',
    ];
}
