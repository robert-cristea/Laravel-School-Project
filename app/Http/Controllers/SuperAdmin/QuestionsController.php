<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Model\Lessons;
use App\Model\Question;
use App\Model\QuestionChoice;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        $lessons = Lessons::orderby('order_number')->get();
        $choices = QuestionChoice::all();
        return view('backend.superadmin.questions', compact(
            'questions',
            'choices',
            'lessons'
        ));
    }
}
