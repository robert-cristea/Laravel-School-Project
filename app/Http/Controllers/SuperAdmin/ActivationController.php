<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Mail\SendMailable;
use App\Model\Corporate_clients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $corporate_clients = Corporate_clients::all();
        return view('backend.superadmin.activation', compact('corporate_clients'));
    }
    public function mail()
    {
        $active_code = 'Krunal';
        //  Mail::to('pavel.kalganov.00@bk.ru')->send(new SendMailable($active_code));

        return back();
    }
    // Get Date
    public function getDate(Request $request)
    {
        $sponsor_id = $request->sponsor_id;
        $corporate_client = Corporate_clients::where('corporate_client_id', $sponsor_id)->first();
        $start_date = $corporate_client->plan_starting_date;
        // $start_date = explode('-', $start_date);
        // $y = $start_date[0];
        // $m = $start_date[1];
        // $d = $start_date[2];
        // $start_date = implode('/', [$m, $d, $y]);
        $expire_date = $corporate_client->plan_expiration_date;
        // $expire_date = explode('-', $expire_date);
        // $y = $expire_date[0];
        // $m = $expire_date[1];
        // $d = $expire_date[2];
        // $expire_date = implode('/', [$m, $d, $y]);

        $output = [$start_date, $expire_date];

        echo json_encode($output);
    }

    public function semdActivecode(Request $request)
    {
        $req = $request->all();
        $single_email = $req['single_email'];
        $active_code = mt_rand(100000, 999999);
        if (!is_null($single_email)) {

            Mail::to($single_email)->send(new SendMailable($active_code));
        } else {
            if ($request->hasFile('csv_file')) {
                $email_list = array();
                $path = "uploads/";
                $filename = $request->file('csv_file')->getClientOriginalName();
                if ($request->file('csv_file')->move($path, $filename)) {
                    $CSVfp = fopen("uploads/" . $filename, "r");
                    if ($CSVfp !== false) {
                        $txt = "";
                        $i = 0;
                        while (!feof($CSVfp)) {
                            $data = fgetcsv($CSVfp, 1000, ",");
                            //array_push($email_list, $data[0]);
                            if (is_array($data)) {
                                array_push($email_list, $data[0]);
                            }
                            //echo $i++;
                        }
                        foreach ($email_list as $recipient) {
                            Mail::to($recipient)->send(new SendMailable($active_code));
                        }
                    }
                }
            }
        }

        return back();
    }

    public function activateAccountsByValidationkey($validation_key)
    {
        $vk = DB::table('vieva_corporate_clients_settings')->where('validation_key', $validation_key)->first();
        if ($vk) {
            DB::table('vieva_users')
                ->where('sponsore_id', $vk->corporate_id)
                ->update(['user_status' => 1, 'update_raison' => 1]);
        }
        return redirect('/activation');

    }
}
