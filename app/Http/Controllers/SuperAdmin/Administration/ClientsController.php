<?php

namespace App\Http\Controllers\SuperAdmin\Administration;

use App\Http\Controllers\Controller;
use App\Model\Corporate_clients;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    // autocomplete client
    // public function fetchClient(Request $request){
    //     // dd($request->get('query'));
    //     if($request->get('query'))
    //     {
    //         $query = $request->get('query');
    //         $data = User::where('email', 'LIKE', "%{$query}%")->get();
    //         $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

    //         foreach($data as $row)
    //         {
    //         $output .= '
    //         <li class="client_item"><a href="#">'.$row->email.'</a></li>
    //         ';
    //         }

    //         $output .= '</ul>';
    //         echo $output;
    //     }
    // }

    // Adding Client
    public function addClient(Request $request)
    {
        $clients = $request->all();

        $corporate_id = $clients['clientid'];
        $corporate = $clients['corporate_name'];
        $licence_num = $clients['licence_number'];
        $start_date = $clients['start_date'];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_date = implode('-', [$start_y, $start_m, $start_d]);
        $end_date = $clients['end_date'];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_d = $end_date[1];
        $end_y = $end_date[2];
        $end_date = implode('-', [$end_y, $end_m, $end_d]);

        $notification = array(
            'message' => 'Added successfuly',
            'alert-type' => 'success',
        );
        $notification1 = array(
            'message' => 'You must enter client email',
            'alert-type' => 'error',
        );
        if ($corporate_id) {
            $newOne = Corporate_clients::create([
                'admin_id' => $corporate_id,
                'corporate_name' => $corporate,
                'plan_starting_date' => $start_date,
                'plan_expiration_date' => $end_date,
                'Number_licences' => $licence_num,
            ]);
            $newOne->save();
            DB::table('vieva_corporate_clients_settings')->insert(['corporate_id' => $newOne->id, 'hours' => $clients['hours']]);
            User::where('id', $corporate_id)->update([
                'user_level' => 2,
            ]);
            return back()->with($notification);
        } else {
            return back()->with($notification1);
        }
    }

    // Updating Client
    public function updateClient(Request $request, $id)
    {
        $clients = $request->all();
        $start_date = $clients['start_date'];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_date = implode('-', [$start_y, $start_m, $start_d]);
        $end_date = $clients['end_date'];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_d = $end_date[1];
        $end_y = $end_date[2];
        $end_date = implode('-', [$end_y, $end_m, $end_d]);

        Corporate_clients::where('corporate_client_id', $id)->update([
            'corporate_name' => $clients['corporate_name'],
            'admin_id' => $clients['clientid'],
            'plan_starting_date' => $start_date,
            'plan_expiration_date' => $end_date,
            'Number_licences' => $clients['licence_num'],
        ]);
        $notification = array(
            'message' => 'Updated successfuly',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    // Deleting Client
    public function deleteClient($id)
    {
        $notification = array(
            'message' => 'Deleted successfuly',
            'alert-type' => 'success',
        );
        Corporate_clients::where('corporate_client_id', $id)->delete();

        return back()->with($notification);
    }

    // Adding Corporate admins
    public function addCorporateadmin(Request $request)
    {
        $corporateadmins = $request->all();
        $cor_admin_email = $corporateadmins["email"];
        $cor_admin_pass = $corporateadmins["password"];
        $hashedpass = Hash::make($cor_admin_pass);
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        if (!is_null($request['createdate'])) {
            $createdate = $request['createdate'];
            $createdate = explode(' ', $createdate);
            $date = $createdate[0];
            $date = explode('/', $date);
            $m = $date[0];
            $d = $date[1];
            $y = $date[2];
            $date = implode('-', [$y, $m, $d]);
            $time = $createdate[1];
            $final_date = implode(' ', [$date, $time]);
        } else {
            $notification = array(
                'message' => 'You must add calendar.',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        $userlevel = $request['userlevel'];
        $userstatus = $request['userstatus'];
        $updateraison = $request['updateraison'];
        // $sponsor = $request['sponsor'];
        $language = $request['language'];
        $platform = $request['platform'];

        $notification = array(
            'message' => 'Added successfuly',
            'alert-type' => 'success',
        );

        User::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $cor_admin_email,
            'password' => $hashedpass,
            'last_login' => $final_date,
            'user_level' => $userlevel,
            'user_status' => $userstatus,
            'update_raison' => $updateraison,
            // 'sponsore_id' => $sponsor,
            'language' => $language,
            'platform' => $platform,
        ]);
        return back()->with($notification);
    }

    // Updating Corporate admins
    public function updateCorporateadmin(Request $request, $id)
    {
        $cor_admins = $request->all();
        // $password = $admins['newpass'];
        // $hashedpass = Hash::make($password);
        $firstname = $request['firstname'];
        $lastname = $request['lastname'];
        if (!is_null($request['createdate'])) {
            $createdate = $request['createdate'];
            $createdate = explode(' ', $createdate);
            $date = $createdate[0];
            $date = explode('/', $date);
            $m = $date[0];
            $d = $date[1];
            $y = $date[2];
            $date = implode('-', [$y, $m, $d]);
            $time = $createdate[1];
            $final_date = implode(' ', [$date, $time]);
        } else {
            $notification = array(
                'message' => 'You must add calendar.',
                'alert-type' => 'error',
            );
            return back()->with($notification);
        }

        $userlevel = $request['userlevel'];
        $userstatus = $request['userstatus'];
        $updateraison = $request['updateraison'];
        // $sponsor = $request['sponsor'];
        $language = $request['language'];
        $platform = $request['platform'];

        User::whereId($id)->update([
            'email' => $cor_admins['email'],
            // 'password' => $hashedpass
            'first_name' => $firstname,
            'last_name' => $lastname,
            'last_login' => $final_date,
            'user_level' => $userlevel,
            'user_status' => $userstatus,
            'update_raison' => $updateraison,
            // 'sponsore_id' => $sponsor,
            'language' => $language,
            'platform' => $platform,
        ]);
        $notification = array(
            'message' => 'Updated successfuly',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }

    // Deleting Corporate admins
    public function deleteCorporateadmin(Request $request, $id)
    {
        User::whereId($id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly',
            'alert-type' => 'success',
        );
        return back()->with($notification);
    }
}
