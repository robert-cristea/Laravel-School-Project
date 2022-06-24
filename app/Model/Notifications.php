<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notifications extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_notifications';
    protected $fillable = [
        'notification_name',
        'content_frensh',
        'content_english',
        'date',
        'target',
    ];

    public function getNotifyList()
    {

        $return = DB::table('vieva_notifications')
            ->join('vieva_notification_listing', 'vieva_notifications.notification_id', '=', 'vieva_notification_listing.notification_id')
            ->select('*')
            ->orderByRaw('vieva_notifications.notification_id ASC')->get();
        return $return;
    }
}
