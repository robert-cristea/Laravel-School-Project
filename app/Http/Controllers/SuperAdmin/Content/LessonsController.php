<?php

namespace App\Http\Controllers\SuperAdmin\Content;

use App\Http\Controllers\Controller;
use App\Model\Lessons;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    //
    //Adding Lessons
    public function addLesson(Request $request)
    {
        $nowtime = date('Y-m-d');
        $currenttime = date('Y-m-d-H:i:s');
        $path = "uploads/";

        if ($request->hasFile('video_upload')) {

            $extension = $request->file('video_upload')->getClientOriginalExtension();
            $type_mime_shot = $request->file('video_upload')->getMimeType();
            $sizeFile = $request->file('video_upload')->getSize();
            $video_upload = $nowtime . '_' . mt_rand(101, 200) . '.' . $extension;
            // dd($video_upload);
            $request->file('video_upload')->move($path, $video_upload);

            $lessons = $request->all();

            $max_order_val = Lessons::max('order_number');

            Lessons::create([
                'serie_id' => $lessons['serie'],
                'tools_id' => $lessons['tool'],
                'challenge_id' => $lessons['challenge_id'],
                'coach_id' => $lessons['coach_id'],
                'title_frensh' => $lessons['lessons_title_fr'],
                'title_english' => $lessons['lessons_title_en'],
                'description_frensh' => $lessons['lessons_description_fr'],
                'description_english' => $lessons['lessons_description_en'],
                'video_file' => $video_upload,
                'date_creation' => $currenttime,
                'order_number' => $max_order_val + 1,
            ]);
            $notification = array(
                'message' => 'Added successfuly!',
                'alert-type' => 'success',
            );

            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'You must select any video file.',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }

    }
    //Editing Lesson
    public function editLesson(Request $request, $id)
    {

        $lesson = $request->all();
        $nowtime = date('Y-m-d');
        $currenttime = date('Y-m-d-H:i:s');
        $path = "uploads/";

        if ($request->hasFile('video_upload1')) {

            $extension = $request->file('video_upload1')->getClientOriginalExtension();
            $type_mime_shot = $request->file('video_upload1')->getMimeType();
            $sizeFile = $request->file('video_upload1')->getSize();
            $video_upload1 = $nowtime . '_' . mt_rand(101, 200) . '.' . $extension;
            // dd($video_upload);
            $request->file('video_upload1')->move($path, $video_upload1);

            Lessons::whereLesson_id($id)->update([

                'serie_id' => $lesson['serie'],
                'tools_id' => $lesson['tool'],
                'challenge_id' => $lesson['challenge_id'],
                'coach_id' => $lesson['coach_id'],
                'title_frensh' => $lesson['lesson_edit_title_fr'],
                'title_english' => $lesson['lesson_edit_title_en'],
                'description_frensh' => $lesson['lessons_edit_des_fr'],
                'description_english' => $lesson['lessons_edit_desc_en'],
                'video_file' => $video_upload1,
                'date_creation' => $currenttime,

            ]);
        } else {
            Lessons::whereLesson_id($id)->update([

                'serie_id' => $lesson['serie'],
                'tools_id' => $lesson['tool'],
                'coach_id' => $lesson['coach_id'],
                'challenge_id' => $lesson['challenge_id'],
                'title_frensh' => $lesson['lesson_edit_title_fr'],
                'title_english' => $lesson['lesson_edit_title_en'],
                'description_frensh' => $lesson['lessons_edit_des_fr'],
                'description_english' => $lesson['lessons_edit_desc_en'],
                // 'video_file'  => '',
                'date_creation' => $currenttime,

            ]);
        }
        $notification = array(
            'message' => 'Updated successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
    //Deleting Lesson
    public function deleteLesson($id)
    {

        Lessons::whereLesson_id($id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!',
            'alert-type' => 'success',
        );

        return back()->with($notification);

    }
    // Order
    public function set_order($origin_id, $target_id, $origin_val, $target_val)
    {
        Lessons::where(["lesson_id" => $origin_id])->update(["order_number" => $target_val]);
        Lessons::where(["lesson_id" => $target_id])->update(["order_number" => $origin_val]);

        return back();
    }
}
