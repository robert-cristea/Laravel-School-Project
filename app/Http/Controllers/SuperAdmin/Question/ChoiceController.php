<?php

namespace App\Http\Controllers\SuperAdmin\Question;

use App\Http\Controllers\Controller;
use App\Model\QuestionChoice;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    //
    public function store(Request $request)
    {
        QuestionChoice::create($request->input());
        $notification = array(
            'message' => 'Question Choice created successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        QuestionChoice::where('choice_id', $id)->update($request->except(['_token', '_method']));
        $notification = array(
            'message' => 'Question Choice updated successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function destroy($id)
    {
        QuestionChoice::where('choice_id', $id)->delete();
        $notification = array(
            'message' => 'Question Choice deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
