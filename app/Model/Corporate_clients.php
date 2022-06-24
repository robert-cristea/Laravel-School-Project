<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Corporate_clients extends Model
{
    //
    protected $table = 'vieva_corporate_clients';
    public $timestamps = false;
    protected $fillable = [
        'corporate_name',
        'admin_id',
        'creation_date',
        'plan_starting_date',
        'plan_expiration_date',
        'Number_licences',
    ];

    // relationships
    public function corporate_settings()
    {
        return $this->hasOne('App\Model\Corporate_clients_settings', 'corporate_id', 'corporate_client_id');

    }

}
