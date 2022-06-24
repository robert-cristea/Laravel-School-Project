<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuestionChoice extends Model
{
    //
    protected $table = 'vieva_questions_possible_choices';
    protected $guarded = ['choice_id'];
    public $timestamps = false;

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
