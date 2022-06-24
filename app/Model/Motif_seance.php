<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class Motif_seance extends Model
{
    //
    public $timestamps = false;
    protected $table = 'vieva_motif_seance';
    protected $fillable = [
        'motif_seance_id',
        'seance_name',
        'picture'      
        
    ];
   
}
