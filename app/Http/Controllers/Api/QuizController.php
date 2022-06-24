<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function getAllQuizes(){

        $quizes = Quiz::get();
        return response()->json($quizes,200);
    }

    public function createQuiz(Request $request) {

        Quiz::create($request->all());
        return response()->json(['message'=>'New quiz has been made!'], 201);
    }

    public function getQuestion($id) {

        if (Question::where('question_id', $id)->exists()) {
            $question = Question::where('question_id', $id)->get();
            return response($question, 200);
        } else {
            return response()->json([
                "message" => "Question not found"
            ], 404);
        }
    }

    public function updateQuestion(Request $request, $id) {

        if(Question::where('question_id', $id)->exists()) {
            Question::where('question_id', $id)->update($request->except(['_token', '_method']));

            return response()->json(['message'=>'successfully updated!'],200);
        } else {
            return response()->json([
                "message" => "Question not found"
            ], 404);
        }
    }

    public function deleteQuestion ($id) {

        if(Question::where('question_id', $id)->exists()) {
            Question::where('question_id', $id)->delete();

            return response()->json([
                "message" => "records deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Question not found"
            ], 404);
        }
    }
}
