<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quote_likes extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_quote_likes';
    protected $fillable = [
        'quote_id',
        'user_id',
        'creation_date'
    ];
}
