<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Model\Challenge;
use Illuminate\Http\Request;
use Validator;

class ChallengeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $current_model;
    public function __construct()
    {
        $this->middleware('auth');
        $this->current_model = new Challenge();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $challenges = Challenge::all();

        return view('backend.superadmin.challenge', compact(
            'challenges'
        ));
    }

    // Save coaching report
    public function saveChallenge(Request $req)
    {
        $challenge = $req->except('_token');
        $validator = Validator::make($req->all(), [
            'name_english' => 'required',
            'name_frensh' => 'required',
            'description_english' => 'required',
            'description_frensh' => 'required',
            'icon' => 'required',
        ]);
        if ($validator->passes()) {
            Challenge::create($challenge);
            $notification = array(
                'message' => 'Saved successfuly',
                'alert-type' => 'success',
            );

            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'All fields must be filled',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }
    }

    public function editChallenge(Request $req, $id)
    {
        $challenge = $req->except('_token');
        $validator = Validator::make($req->all(), [
            'name_english' => 'required',
            'name_frensh' => 'required',
            'description_english' => 'required',
            'description_frensh' => 'required',
            'icon' => 'required',
        ]);
        if ($validator->passes()) {
            Challenge::where('challenge_id', $id)->update($challenge);
            $notification = array(
                'message' => 'Edited successfuly',
                'alert-type' => 'success',
            );

            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'All fields must be filled',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }
    }

    // Delete Coaching
    public function deleteChallenge($id)
    {
        Challenge::where('challenge_id', $id)->delete();
        $notification = array(
            'message' => 'Delete successfuly',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

}
