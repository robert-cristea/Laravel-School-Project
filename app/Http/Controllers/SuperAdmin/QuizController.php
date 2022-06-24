<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Model\Challenge;
use App\Model\Lessons;
use App\Model\Question;
use App\Model\Quiz;
use App\Model\Quiz_Question;
use App\Model\Series;
use App\Model\Tools;
use App\User;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizes = Quiz::all();
        $questions = Question::all();
        $lessons = Lessons::orderby('order_number')->get();
        $series = Series::orderby('display_order')->get();
        $tools = Tools::all();
        $challenges = Challenge::all();
        $coaches = User::where('user_level', 6)->get();

        return view('backend.superadmin.quizes', compact(
            'quizes',
            'questions',
            'lessons',
            'series',
            'tools',
            'challenges',
            'coaches'
        ));
    }

    public function findQuestion(Request $request, $question_id){
        $question = Question::where('question_id',$question_id)->with("choices")->get();
        return $question;
    }

    public function getQuiz(Request $request, $quiz_id){
        $quiz = Quiz::where('id',$quiz_id)->first();
        $questions = array();
        foreach ($quiz->questions as $question){
            $question['choices'] = $question->choices;
            array_push($questions,$question);
        }
        $quiz['questions'] = $questions;

        return $quiz;
    }

}
