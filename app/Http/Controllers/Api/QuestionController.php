<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAllQuestions(){

        $questions = Question::get();
        return response($questions,200);
    }

    public function createQuestion(Request $request) {
        // logic to create a Question record goes here

        Question::create($request->all());
        return response()->json(['message'=>'new question has been made!'], 201);
    }

    public function getQuestion($id) {
        // logic to get a Question record goes here

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
        // logic to update a Question record goes here
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
        // logic to delete a Question record goes here
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
