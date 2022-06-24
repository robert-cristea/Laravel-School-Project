<?php

namespace App\Http\Controllers\SuperAdmin\Content\SubTools;

use App\Http\Controllers\Controller;
use App\Model\BreathingTool;
use Illuminate\Http\Request;

class BreathingToolController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        BreathingTool::create($request->input());
        $notification = array(
            'message' => 'Breathing Tool created successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        BreathingTool::where('id', $id)->delete();
        $notification = array(
            'message' => 'Breathing Tool deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
