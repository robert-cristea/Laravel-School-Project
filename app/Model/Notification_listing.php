<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Notification_listing extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_notification_listing';
    protected $fillable = [
        'notification_id',
        'user_id',
        'timestamp',
        'status'
        
    ];
   
}
