<?php

namespace App\Http\Controllers\SuperAdmin\Question;

use App\Http\Controllers\Controller;
use App\Model\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function store(Request $request)
    {
        Question::create($request->input());
        $notification = array(
            'message' => 'Question created successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        Question::where('question_id', $id)->update($request->except(['_token', '_method']));
        $notification = array(
            'message' => 'Question updated successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function destroy($id)
    {
        Question::where('question_id', $id)->delete();
        $notification = array(
            'message' => 'Question deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
