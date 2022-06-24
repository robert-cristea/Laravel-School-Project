<?php

namespace App\Http\Controllers\SuperAdmin\Content\SubTools;

use App\Http\Controllers\Controller;
use App\Model\MindfulnessTool;
use Illuminate\Http\Request;

class MindfulnessToolController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $nowtime = date('Y_m_d');
        $path = "uploads/";
        $image_url = "";
        $sound_link = "";
        if ($request->hasFile('image_url')) {
            $extension = $request->file('image_url')->getClientOriginalExtension();
            $type_mime_shot = $request->file('image_url')->getMimeType();
            $sizeFile = $request->file('image_url')->getSize();
            $image_url = $nowtime . '-' . mt_rand(10, 100) . '.' . $extension;
            $request->file('image_url')->move($path, $image_url);
        }
        if ($request->hasFile('sound_link')) {
            $extension = $request->file('sound_link')->getClientOriginalExtension();
            $type_mime_shot = $request->file('sound_link')->getMimeType();
            $sizeFile = $request->file('sound_link')->getSize();
            $sound_link = $nowtime . '-' . mt_rand(10, 100) . '.' . $extension;
            $request->file('sound_link')->move($path, $sound_link);
        }
        $tool = $request->input();
        $tool['image_url'] = $image_url;
        $tool['sound_link'] = $sound_link;
        MindfulnessTool::create($tool);

        $notification = array(
            'message' => 'Mindfulness Tool created successfuly!',
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
        //
        MindfulnessTool::where('id', $id)->delete();
        $notification = array(
            'message' => 'Mindfulness Tool deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);

    }
}
