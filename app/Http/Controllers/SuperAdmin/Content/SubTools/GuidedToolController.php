<?php

namespace App\Http\Controllers\SuperAdmin\Content\SubTools;

use App\Http\Controllers\Controller;
use App\Model\GuidedTool;
use Illuminate\Http\Request;

class GuidedToolController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {

        $nowtime = date('Y_m_d');
        $path = "uploads/";
        $file_link = "";

        if ($request->hasFile('file_link')) {
            $extension = $request->file('file_link')->getClientOriginalExtension();
            $type_mime_shot = $request->file('file_link')->getMimeType();
            $sizeFile = $request->file('file_link')->getSize();
            $file_link = $request->file_name_english . '-' . mt_rand(10, 100) . '.' . $extension;
            $request->file('file_link')->move($path, $file_link);
        }
        $tool = $request->input();
        $tool['file_link'] = $file_link;
        GuidedTool::create($tool);
        $notification = array(
            'message' => 'Guided Meditation Tool created successfuly!',
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
        GuidedTool::where('guided_meditation_id', $id)->delete();
        $notification = array(
            'message' => 'Guided Meditation Tool deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
}
