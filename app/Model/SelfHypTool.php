<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SelfHypTool extends Model
{
    //
    protected $table = 'vieva_self_hypnosis';
    protected $guarded = ['self_hypnosis_id'];
    // protected $fillable = ['title_frensh', 'title_english', 'description_frensh', 'description_english', 'file_name_frensh', 'file_name_english'];
    public $timestamps = false;
}
