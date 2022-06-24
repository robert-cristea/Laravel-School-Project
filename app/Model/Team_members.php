<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Team_members extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_team_members';
    protected $fillable = [
        'corporate_client_id',
        'corporate_group_admin_id',
        'user_id'
    ];
}
