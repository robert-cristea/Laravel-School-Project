<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Coaching_reports extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_coaching_reports';
    protected $fillable = [

        // 'report_id',
        'user_id',
        'duration',
        'session_date',
        'motif_seance_id',
        'rating',
        'coach_name',
        'user_first_name',
        'user_last_name',
        'user_email',
        'language',
        'note',
        'report_date',
        'status',
        'client_feedbck',

    ];
    public function getCoachingReport()
    {
        $return = DB::table('vieva_coaching_reports')
            ->join('vieva_motif_seance', 'vieva_coaching_reports.motif_seance_id', '=', 'vieva_motif_seance.motif_seance_id')
            ->select('*')
            ->orderByRaw('vieva_coaching_reports.report_id ASC')->get();
        return $return;
    }

    public function getUserFirstNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
    public function getUserLastNameAttribute($value)
    {
        return ucfirst(strtolower($value));
    }
}
