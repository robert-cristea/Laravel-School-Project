<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Model\Coaching_reports;
use App\Model\Motif_seance;
use App\User;
use Illuminate\Http\Request;
use Validator;

class CoachingController extends Controller
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
        $this->current_model = new Coaching_reports();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $coaches = User::where('user_level', 6)->get();
        $session_reasons = Motif_seance::all();
        $onlyusers = User::whereNotIn('user_level', [0, 1, 2, 7])->get();
        $first_user = $onlyusers->first();
        $first_user_email = $first_user->email;
        $first_coaching_reports = Coaching_reports::where('user_email', $first_user_email)->get();
        // dd($first_coaching_reports);

        return view('backend.superadmin.coaching', compact(
            'onlyusers',
            'first_user',
            'coaches',
            'session_reasons',
            'first_coaching_reports'
        ));
    }

    // Save coaching report
    public function saveCoach(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'customRadio' => 'required|in:1,2,3,4,5',
            'duration' => 'required|in:1,2',
            'language' => 'required|in:1,2',
        ]);
        if ($validator->passes()) {
            $session_date = $req['session_date'];
            $session_date = explode('/', $session_date);
            $y = $session_date[2];
            $m = $session_date[0];
            $d = $session_date[1];
            $session_date = implode('-', [$y, $m, $d]);
            $date = date('Y-m-d-H:i:s');

            $coach = User::where('id', $req->coach)->first();
            $coach_name = $coach->first_name;

            Coaching_reports::create([
                'duration' => $req->duration ? $req->duration : '',
                'session_date' => $session_date ? $session_date : '',
                'motif_seance_id' => $req->reason_session ? $req->reason_session : '',
                'rating' => $req->customRadio ? $req->customRadio : '',
                'coach_name' => $coach_name,
                'user_first_name' => $req->first_name ? $req->first_name : '',
                'user_last_name' => $req->last_name ? $req->last_name : '',
                'user_email' => $req->email ? $req->email : '',
                'language' => $req->language ? $req->language : '',
                'note' => $req->note ? $req->note : '',
                'report_date' => $date,
                'status' => $req->status ? $req->status : '',
                'client_feedbck' => $req->client_feedback ? $req->client_feedback : '',
                'user_id' => $coach->id,
            ]);
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

    public function editcoach(Request $req)
    {

        $report_id = $req->report_id;
        $session_date = $req->session_date;
        $session_date = preg_split('/ +/', $session_date);

        $full_date = $session_date[0];
        $session_date = explode('/', $full_date);
        $y = $session_date[2];
        $m = $session_date[0];
        $d = $session_date[1];
        $session_date = implode('-', [$y, $m, $d]);
        $date = date('Y-m-d-H:i:s');

        $coach = User::where('id', $req->coach)->first();
        $coach_name = $coach->first_name;

        Coaching_reports::whereReport_id($report_id)->update([
            'duration' => $req->duration ? $req->duration : '',
            'session_date' => $session_date ? $session_date : '',
            'motif_seance_id' => $req->reason_session ? $req->reason_session : '',
            'rating' => $req->customRadio ? $req->customRadio : '',
            'coach_name' => $coach_name,
            'user_first_name' => $req->first_name ? $req->first_name : '',
            'user_last_name' => $req->last_name ? $req->last_name : '',
            'user_email' => $req->email ? $req->email : '',
            'language' => $req->language ? $req->language : '',
            'note' => $req->note ? $req->note : '',
            'report_date' => $date,
            'status' => $req->status ? $req->status : '',
            'client_feedbck' => $req->client_feedback ? $req->client_feedback : '',
        ]);
        $notification = array(
            'message' => 'Updated successfuly',
            'alert-type' => 'success',
        );

        return back()->with($notification);

    }

    // Changin by email
    public function showReportUser(Request $request)
    {
        $user_id = $request->id;
        $user = User::where('id', $user_id)->first();
        $session_reasons = Motif_seance::all();
        $coaches = User::where('user_level', 6)->get();

        $coaching_reports = Coaching_reports::where('user_email', $user->email)->get();

        $output = '<table class="table table-bordered">
        <tbody>
            <tr>
                <td class="add-font">Add session report</td>
                <td class="right-addbtn" data-toggle="modal" data-target="#modal-report-add">
                    <span>
                        <i class="fa fa-plus"></i>
                    </span>
                </td>
            </tr>';
        foreach ($coaching_reports as $coaching_report) {
            $output .= '<tr>
                    <td style="width:90%">';
            $output .= date('d F Y', strtotime($coaching_report->session_date));
            $output .= '</td>
                    <td class="right-editbtn" data-toggle="modal" data-target="#modal-report-edit';
            $output .= $coaching_report->report_id;
            $output .= '">
                        <span>
                            <i class="fa fa-edit" style="cursor:pointer"></i>
                        </span>
                    </td>
                </tr>';
        }

        $output .= '</tbody>
        </table>

        <!-- coach report add modal -->
        <div class="modal fade" id="modal-report-add">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add session report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/savecoaching" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="text" name="email" class="form-control" value="' . $user->email . '" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="First name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="' . $user->first_name . '" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="Last Name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="' . $user->last_name . '" readonly>
                                </div>
                                <label for="session date">Session date</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="text" name="session_date" class="form-control datetimepicker-input" data-target="#reservationdate" required>
                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reason for seassion">Reason for session</label>
                                    <select name="reason_session" class="form-control select2" style="width: 100%;">';
        foreach ($session_reasons as $session_reason) {
            $output .= '<option value="';
            $output .= $session_reason->motif_seance_id;
            $output .= '">';
            $output .= $session_reason->seance_name;
            $output .= '</option>';
        }

        $output .= '</select>
                                </div>
                                <div class="form-group">
                                    <label for="coach">Coach</label>
                                    <select name="coach" class="form-control select2" style="width: 100%;">';
        foreach ($coaches as $coach) {
            $output .= '<option value="';
            $output .= $coach->id;
            $output .= '">';
            $output .= $coach->first_name;
            $output .= '</option>';
        }

        $output .= '</select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control select2" style="width: 100%;">
                                        <option value="1">done</option>
                                        <option value="2">non shown</option>
                                        <option value="3">reschuduled</option>
                                        <option value="4">cancelled</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="client feedback">Client Feedback</label>
                                    <select name="client_feedback" class="form-control select2" style="width: 100%;">

                                        <option value="1">much better</option>
                                        <option value="2">better</option>
                                        <option value="3">about the same</option>
                                        <option value="4">worse</option>
                                        <option value="5">much worse</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="note">Note</label>
                                    <textarea name="note" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="coach rating">Coach rating</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1" value="1" name="customRadio">
                                        <label for="customRadio1" class="custom-control-label">1 star</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2"   value="2"  name="customRadio">
                                        <label for="customRadio2" class="custom-control-label">2 stars</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio3"  value="3"  name="customRadio">
                                        <label for="customRadio3" class="custom-control-label">3 stars</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio4"  value="4"  name="customRadio">
                                        <label for="customRadio4" class="custom-control-label">4 stars</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio5"  value="5"  name="customRadio">
                                        <label for="customRadio5" class="custom-control-label">5 stars</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Duration">Duration</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio6" value="1" name="duration">
                                        <label for="customRadio6" class="custom-control-label">30 minutes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio7"   value="2"  name="duration">
                                        <label for="customRadio7" class="custom-control-label">60 minutes</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="Language">Language</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio8" value="1" name="language">
                                        <label for="customRadio8" class="custom-control-label">English</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio9"   value="2"  name="language">
                                        <label for="customRadio9" class="custom-control-label">French</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success shadow-btn btn-block">Add session report</button>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
        </div>';

        foreach ($coaching_reports as $coaching_report) {
            $output .= '<div class="modal fade" id="modal-report-edit' . $coaching_report->report_id . '">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit session report</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form role="form" action="/editcoaching" method="POST" >
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                                <div class="box-body">
                                    <div class="form-group">
                                        <input type="hidden"  value="' . $coaching_report->user_email . '" name="user_email" >
                                        <input type="hidden" name="report_id" value="' . $coaching_report->report_id . '"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input type="text" name="email" class="form-control" value="' . $coaching_report->user_email . '" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="First name">First Name</label>
                                        <input type="text" name="name" class="form-control" value="' . $coaching_report->user_first_name . '" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="Last Name">Last Name</label>
                                        <input type="text" name="last_name" class="form-control" value="' . $coaching_report->user_last_name . '" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="session date">Session date</label>

                                        <div class="input-group date" id="reservationdate' . $coaching_report->report_id . '" data-target-input="nearest">

                                            <input type="text" value="';
            $date = $coaching_report->session_date;
            $date = explode('-', $date);
            $y = $date[0];
            $m = $date[1];
            $d = $date[2];
            $date = implode('/', [$m, $d, $y]);
            $output .= $date;
            $output .= '" name="session_date" class="form-control datetimepicker-input" data-target="#reservationdate' . $coaching_report->report_id . '" required>
                                            <div class="input-group-append" data-target="#reservationdate' . $coaching_report->report_id . '" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <label for="reason for seassion">Reason for session</label>
                                        <select name="reason_session" class="form-control select2" style="width: 100%;">';

            foreach ($session_reasons as $session_reason) {
                $output .= '<option value="';
                $output .= $session_reason->motif_seance_id;
                $output .= '"';
                $output .= ($coaching_report->motif_seance_id == $session_reason->motif_seance_id) ? "selected" : "";
                $output .= '>';
                $output .= $session_reason->seance_name;
                $output .= '</option>';
            }

            $output .= '</select>
                                    </div>
                                    <div class="form-group">
                                        <label for="coach">Coach</label>
                                        <select name="coach" class="form-control select2" style="width: 100%;">';

            foreach ($coaches as $coach) {
                $output .= '<option value="';
                $output .= $coach->id;
                $output .= '"';
                $output .= ($coaching_report->coach_name == $coach->first_name) ? 'selected' : '';
                $output .= '>';
                $output .= $coach->first_name;
                $output .= '</option>';
            }

            $output .= '</select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control select2" style="width: 100%;">';
            $output .= '<option value="1"';
            $output .= $coaching_report->status == 1 ? 'selected' : '';
            $output .= '>done</option>
                                            <option value="2"';
            $output .= $coaching_report->status == 2 ? 'selected' : '';
            $output .= '>non shown</option>
                                            <option value="3"';
            $output .= $coaching_report->status == 3 ? 'selected' : '';
            $output .= '>reschuduled</option>
                                            <option value="4"';
            $output .= $coaching_report->status == 4 ? 'selected' : '';
            $output .= '>cancelled</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="client feedback">Client Feedback</label>
                                        <select name="client_feedback" class="form-control select2" style="width: 100%;">

                                            <option value="1"';
            $output .= $coaching_report->client_feedbck == 1 ? 'selected' : '';
            $output .= '>much better</option>
                                            <option value="2"';
            $output .= $coaching_report->client_feedbck == 2 ? 'selected' : '';
            $output .= '>better</option>
                                            <option value="3"';
            $output .= $coaching_report->client_feedbck == 3 ? 'selected' : '';
            $output .= '>about the same</option>
                                            <option value="4"';
            $output .= $coaching_report->client_feedbck == 4 ? 'selected' : '';
            $output .= '>worse</option>
                                            <option value="5"';
            $output .= $coaching_report->client_feedbck == 5 ? 'selected' : '';
            $output .= '>much worse</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="note">Note</label>
                                        <textarea name="note" class="form-control" required>' . $coaching_report->note . '</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="coach rating">Coach rating</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio1' . $coaching_report->report_id . '" value="1" name="customRadio"';
            $output .= $coaching_report->rating == 1 ? "checked" : "";
            $output .= '>
                                            <label for="customRadio1' . $coaching_report->report_id . '" class="custom-control-label">1 star</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio2' . $coaching_report->report_id . '" value="2" name="customRadio"';
            $output .= $coaching_report->rating == 2 ? "checked" : "";
            $output .= '>
                                            <label for="customRadio2' . $coaching_report->report_id . '" class="custom-control-label">2 stars</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio3' . $coaching_report->report_id . '" value="3" name="customRadio"';
            $output .= $coaching_report->rating == 3 ? "checked" : "";
            $output .= '>
                                            <label for="customRadio3' . $coaching_report->report_id . '" class="custom-control-label">3 stars</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio4' . $coaching_report->report_id . '" value="4" name="customRadio"';
            $output .= $coaching_report->rating == 4 ? "checked" : "";
            $output .= '>
                                            <label for="customRadio4' . $coaching_report->report_id . '" class="custom-control-label">4 stars</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio5' . $coaching_report->report_id . '"  value="5" name="customRadio"';
            $output .= $coaching_report->rating == 5 ? "checked" : "";
            $output .= '>
                                            <label for="customRadio5' . $coaching_report->report_id . '" class="custom-control-label">5 stars</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Duration">Duration</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio6' . $coaching_report->report_id . '" value="1" name="duration"';
            $output .= $coaching_report->duration == 1 ? 'checked' : '';
            $output .= '>
                                            <label for="customRadio6' . $coaching_report->report_id . '" class="custom-control-label">30 minutes</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio7' . $coaching_report->report_id . '" value="2" name="duration"';
            $output .= $coaching_report->duration == 2 ? 'checked' : '';
            $output .= '>
                                            <label for="customRadio7' . $coaching_report->report_id . '" class="custom-control-label">60 minutes</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Language">Language</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio8' . $coaching_report->report_id . '" value="1" name="language"';
            $output .= $coaching_report->language == 1 ? 'checked' : '';
            $output .= '>
                                            <label for="customRadio8' . $coaching_report->report_id . '" class="custom-control-label">English</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" id="customRadio9' . $coaching_report->report_id . '"   value="2"  name="language"';
            $output .= $coaching_report->language == 2 ? 'checked' : '';
            $output .= '>
                                            <label for="customRadio9' . $coaching_report->report_id . '" class="custom-control-label">French</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                                    </div>
                                </div>
                            </form>
                            <form action="/deletecoaching/' . $coaching_report->report_id . '" method="post">
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                                <input type="hidden" name="_method" value="delete"/>
                                <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove admin</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>';
        }

        echo $output;

    }

    // Delete Coaching
    public function deleteCoaching($id)
    {
        Coaching_reports::where('report_id', $id)->delete();
        $notification = array(
            'message' => 'Delete successfuly',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function getUploadCSVStep1()
    {
        return view('backend.superadmin.importCoachingCsvForm');
    }

    public function postUploadCSVStep1(Request $request)
    {

        $param = $request->all();
        $path = $request->file('upload_csv_seller')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        if (isset($param['upload_csv_seller'])) {

            $fileNameCSV = time() . 'dimcsv.' .
            $request->file('upload_csv_seller')->getClientOriginalExtension();

            $request->file('upload_csv_seller')->move(
                base_path() . '/public/uploads/csv/', $fileNameCSV
            );
        }

        if (!file_exists(base_path() . '/public/uploads/csv/' . $fileNameCSV) || !is_readable(base_path() . '/public/uploads/csv/' . $fileNameCSV)) {
            return false;
        }

        $HeaderArr = array(
            'report_id',
            'duration',
            'session_date',
            'motif_seance_id',
            'rating',
            'coach_name',
            'user_first_name',
            'user_last_name',
            'user_email',
            'language',
            'note',
            'report_date',
            'status',
            'client_feedbck',
        );

        $record = [];
        $data = array();
        $result = [];

        if (($handle = fopen(base_path() . '/public/uploads/csv/' . $fileNameCSV, "r")) !== false) {
            while (($row = fgetcsv($handle, 1000, "\r")) !== false) {
                foreach ($row as $item) {

                    array_push($record, $item);

                }
            }
        }

        if (count($record) >= 0) {
            for ($i = 1; $i < count($record); $i++) {

                if ($record[$i] !== null) {
                    $row = explode(',', $record[$i]);
                    $data = ['report_id' => $row[0],
                        'duration' => $row[1],
                        'session_date' => $row[2],
                        'motif_seance_id' => $row[3],
                        'rating' => $row[4],
                        'coach_name' => $row[5],
                        'user_first_name' => $row[6],
                        'user_last_name' => $row[7],
                        'user_email' => $row[8],
                        'language' => $row[9],
                        'note' => $row[10],
                        'report_date' => $row[11],
                        'status' => $row[12],
                        'client_feedbck' => $row[13],
                    ];

                    Coaching_reports::create([
                        'user_id' => 0,
                        'report_id' => str_replace('"', '', $row[0]),
                        'duration' => str_replace('"', '', $row[1]),
                        'session_date' => str_replace('"', '', $row[2]),
                        'motif_seance_id' => str_replace('"', '', $row[3]),
                        'rating' => str_replace('"', '', $row[4]),
                        'coach_name' => str_replace('"', '', $row[5]),
                        'user_first_name' => str_replace('"', '', $row[6]),
                        'user_last_name' => str_replace('"', '', $row[7]),
                        'user_email' => str_replace('"', '', $row[8]),
                        'language' => str_replace('"', '', $row[9]),
                        'note' => str_replace('"', '', $row[10]),
                        'report_date' => str_replace('"', '', $row[11]),
                        'status' => str_replace('"', '', $row[12]),
                        'client_feedbck' => str_replace('"', '', $row[13]),
                    ]);

                }
            }
        }

        $notification = array(
            'message' => 'Imported successfuly',
            'alert-type' => 'success',
        );

        return redirect('/coaching');
    }

}
