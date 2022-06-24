<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'vieva_questions';
    protected $guarded = ['question_id'];
    public $timestamps = false;

    public function choices(){
        return $this->hasMany(QuestionChoice::class,'question_id', 'question_id');
    }

}
