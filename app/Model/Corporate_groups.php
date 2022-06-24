<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Corporate_groups extends Model
{
    //
    protected $table = 'vieva_corporate_groups';
    public $timestamps = false;
    protected $fillable = [
        'corporate_client_id',
        'group_name',
        'creation_date',
        'corporate_group_admin_id',
        'corporate_user_id'
    ];
}
