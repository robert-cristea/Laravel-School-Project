<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'vieva_quizes';
    
    protected $fillable = [
        'quiz_text', 'lesson_id', 'is_active'
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'vieva_quiz_questions', 'quiz_id', 'question_id', null, 'question_id');
    }
}
