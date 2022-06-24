<?php

namespace App\Http\Controllers\SuperAdmin\Quiz;

use App\Http\Controllers\Controller;
use App\Model\Question;
use App\Model\QuestionChoice;
use App\Model\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function store(Request $request)
    {
        $new = Quiz::create(['quiz_text' => $request->quiz_text, 'is_active' => $request->is_active, 'lesson_id' => $request->lesson_id]);
        $questionIds = $request->questionIds;
        $choices = $request->choice;

        foreach($choices as $choice_id => $value){
            QuestionChoice::where('choice_id', $choice_id)->update(['is_right_choice'=>$value]);
        }

        $quiz = Quiz::find($new->id);

        $quiz->questions()->detach();
        $quiz->questions()->attach($questionIds);

        $notification = array(
            'message' => 'Quiz created successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        Quiz::where('id', $id)->update($request->except(['_token', '_method','choice','questionIds','question_select']));

        $questionIds = $request->questionIds;
        $choices = $request->choice;

        foreach($choices as $choice_id => $value){
            QuestionChoice::where('choice_id', $choice_id)->update(['is_right_choice'=>$value]);
        }

        $quiz = Quiz::find($id);
        $quiz->questions()->detach();
        $quiz->questions()->attach($questionIds);

        $notification = array(
            'message' => 'Quiz updated successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function destroy($id)
    {
        Quiz::where('id', $id)->delete();
        $notification = array(
            'message' => 'Quiz deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
