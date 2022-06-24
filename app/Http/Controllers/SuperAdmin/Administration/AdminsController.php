<?php

namespace App\Http\Controllers\SuperAdmin\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminsController extends Controller
{
    //
    
    public function updateSuperadmin(Request $request, $id){
        
        $superadmins = $request->all(); 
        $email = $superadmins['email'];
        $oldpass = $superadmins['oldpass'];
        $newpass = $request['newpass'];
        $hashed_new_pass = Hash::make($newpass);

        $savedsuperadmin = User::where('email', $email)->first();
        $check = Hash::check($oldpass, $savedsuperadmin->password);
        if($check){
            User::whereId($id)->update([
                'password' =>$hashed_new_pass
            ]);
            $notification = array(
                'message' => 'Updated successfuly!', 
                'alert-type' => 'success'
            );
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Password is not correct!', 
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        
        
        
        return back()->with($notification);
    }
    //Autocomplete Admin
    // public function fetchAdmin(Request $request){
        
    //     if($request->get('query'))
    //  {
    //   $query = $request->get('query');
    //   $data = User::where('email', 'LIKE', "%{$query}%")->get();
    //   $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
    //   foreach($data as $row)
    //   {
    //    $output .= '
    //    <li><a href="#">'.$row->email.'</a></li>
    //    ';
    //   }
    //   $output .= '</ul>';
    //   echo $output;
    //  }
    // }

    // Admin Add
    public function addAdmin(Request $request){

        $admins = $request->all();
        $admin_email = $admins["email"]; 
        $admin_pass = $admins["password"]; 
        $hashedpass = Hash::make($admin_pass);
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
                'alert-type' => 'error'
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
            'alert-type' => 'success'
        );
        
        // desktop or mobile 
        // $agent = new \Jenssegers\Agent\Agent;
        // $result = $agent->isMobile();
        // $result = $agent->isDesktop(); 
       
        User::create([
            'first_name' => $firstname,
            'last_name' => $lastname,
            'email' => $admin_email,
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
    public function editAdmin(Request $request, $id){
        $admins = $request->all();
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
                'alert-type' => 'error'
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
            'email' => $admins['email'],
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
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    // Admin deleting
    public function deleteAdmin($id){
        User::whereId($id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    
    
}