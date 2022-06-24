<?php

namespace App\Http\Controllers\SuperAdmin\Administration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Corporate_clients;
use App\Model\Corporate_groups;
use App\Model\Team_members;
use App\User;
use DB;
use Validator;
use Illuminate\Support\Facades\Hash;

class TeamsController extends Controller
{
    //
    public function createTeam(Request $request){
        $corporate_id = $request->corporate_id;
        $team_name = $request->team_name;
        $team_members = $request->input('team_members');
        $team_admin = $request->team_admin;
        Corporate_groups::create([
            'corporate_client_id' => $corporate_id,
            'group_name' => $team_name,
            'corporate_group_admin_id' => $team_admin
        ]);
        if ($team_members) {
            foreach ($team_members as $team_member) {
                Team_members::create([
                    'corporate_client_id' => $corporate_id,
                    'corporate_group_admin_id' => $team_admin,
                    'user_id' => $team_member
                ]);
                User::where('id', $team_member)->update([
                    'user_level' => 8
                ]);
            }
        }
        
        // User::where('id', $team_admin)->update([
        //     'user_level' => 7
        // ]);
        $notification = array(
            'message' => 'Created successfuly!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function editTeam(Request $request, $id){
        $team_name = $request->team_name; 
        $team_members = $request->input('team_members');
        $team_admin = $request->team_admin;

        Corporate_groups::where('corporate_group_admin_id', $id)->update([
            'group_name' =>$team_name,
            'corporate_group_admin_id' =>$team_admin
        ]);
        if ($team_members) {
            foreach ($team_members as $team_member) {
                Team_members::where('corporate_group_admin_id', $id)->update([
                    'corporate_group_admin_id' => $team_admin,
                    'user_id' => $team_member
                ]);
                User::where('id', $team_member)->update([
                    'user_level' => 8
                ]);
            }
        }
        
        // User::where('id', $team_admin)->update([
        //     'user_level' => 7
        // ]);
        $notification = array(
            'message' => 'Updated successfuly!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }

    public function deleteTeam(Request $request, $id){
        Corporate_groups::where('corporate_group_admin_id', $id)->delete();
        Team_members::where('corporate_group_admin_id', $id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
    // Add Teamadmin
    public function addTeamadmin(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            $password = $request['password'];
            $password = Hash::make($password);
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
            User::create([
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password,
                'last_login' => $final_date,
                'user_level' => $userlevel,
                'user_status' => $userstatus,
                'update_raison' => $updateraison,
                // 'sponsore_id' => $sponsor,
                'language' => $language,
                'platform' => $platform,
            ]);
            $notification = array(
                'message' => 'Created successfuly!', 
                'alert-type' => 'success'
            );
            
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Email is already taken', 
                'alert-type' => 'error'
            );
            
            return back()->with($notification);
        }
        

    }

    // Edit Teamadmin
    public function eidtTeamadmin(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            // $password = $request['password'];
            // $password = Hash::make($password);
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
    
            User::where('id', $id)->update([
                'email' => $email,
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
                'message' => 'Updated successfuly!', 
                'alert-type' => 'success'
            );
            
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Email is already taken', 
                'alert-type' => 'error'
            );
            
            return back()->with($notification);
        }
 
    }
    // Delete Teamadmin
    public function deleteTeamadmin(Request $request, $id){
        Corporate_groups::where('corporate_group_admin_id', $id)->delete();
        Team_members::where('corporate_group_admin_id', $id)->delete();
        User::where('id', $id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    public function showTeam(Request $request){
        if($request->get('corporate_id')){
            $corporate_id = $request->get('corporate_id');
            $teams = Corporate_groups::where('corporate_client_id', '=', $corporate_id)->get();
            $users = User::whereNotIn('user_level', [0, 1, 2, 7])->get();
            $team_admins = DB::table('vieva_users')
                        ->Join('vieva_corporate_groups', 'vieva_corporate_groups.corporate_group_admin_id', '=', 'vieva_users.id' )
                        // ->select('vieva_users.first_name', 'vieva_users.id')
                        ->where('corporate_client_id', '=', $corporate_id)
                        ->get();
            $new_team_admins = User::whereUser_level(7)->get();
            // dd($team_admin);            
            
            $output = '
            <h4 class="pt-pb">Corporate client\'s teams</h4>
            <h5 class="pt-pb" style="font-weight: bold">Teams</h5>
            <div class="card card-primary">
            
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="add-font">Add team</td>
                                <td class="right-addbtn" data-toggle="modal" data-target="#modal-team-add">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </td>
                            </tr>';
                            foreach ($teams as $team) {
                                $output .='<tr id="teamData">
                                                <td style="width:90%">'.$team->group_name.'</td>
                                                <td class="right-editbtn" data-toggle="modal" data-target="#modal-team-edit-'.$team->corporate_group_admin_id.'">
                                                    <span>
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </td>
                                            </tr>';
                            }
                        
                            
                            
                       $output .=' </tbody>
                    </table>
                </div>
            <!-- /.card -->
            </div>

            <h5 class="pt-pb" style="font-weight: bold">Team admins</h5>
            <div class="card card-primary">
            
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="add-font">Add team admin</td>
                                <td class="right-addbtn" data-toggle="modal" data-target="#modal-teamadmin-add">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </td>
                            </tr>';
                            foreach($new_team_admins as $new_team_admin){
                                $output .='<tr>
                                                <td style="width:90%">'.$new_team_admin->first_name.'</td>
                                                <td class="right-editbtn" data-toggle="modal" data-target="#modal-teamadmin-edit-'.$new_team_admin->id.'">
                                                    <span>
                                                        <i class="fa fa-edit"></i>
                                                    </span>
                                                </td>
                                            </tr>';
                            }
                            
                       $output .=' </tbody>
                    </table>
                </div>
            <!-- /.card -->
            </div>';

            $output .='<!-- team add modal -->
            <div class="modal fade" id="modal-team-add">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Create team</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="http://localhost/addnew_team" method="post" enctype="multipart/form-data">
                            
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="team_name">Team name</label>
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <input type="hidden" id="new_corporate_id" name="corporate_id" value="'.$corporate_id.'" class="form-control">
                                    <input type="text" id="new_team_name" name="team_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="team members">Team members</label>
                                    <!-- <input type="text" class="form-control"> -->
                                    <select class="select2" id="new_team_members" name="team_members[]" multiple="multiple" data-placeholder="Select a team members" style="width: 100%;">';
                                        foreach($users as $user){
                                        $output .= '<option value="'.$user->id.'">'.$user->first_name.'</option>';
                                        }
                                    $output .= '</select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="starting date">Team admin</label>
                                    <div class="form-group">
                                        <select name="team_admin" id="new_team_admin" class="form-control select2" style="width: 100%;">';
                                        foreach($new_team_admins as $new_team_admin) {  
                                        $output .= '<option value="'.$new_team_admin->id.'">'.$new_team_admin->email.'</option>';
                                        }
                                        $output .='</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default shadow-btn btn-block">Create team</button>
                                    
                                </div>
                            </div>
                            <!-- /.box-body -->
                            </form>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
            <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->';

            foreach ($teams as $team) {
                $output .='<!-- team edit modal -->
                <div class="modal fade" id="modal-team-edit-'.$team->corporate_group_admin_id.'">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit team</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="http://localhost/editnew_team/'.$team->corporate_group_admin_id.'" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="email">Team name</label>
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <input type="hidden" name="corporate_id" value="'.$corporate_id.'" class="form-control">
                                            <input type="text" name="team_name" value="'.$team->group_name.'" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="licenses">Team members</label>
                                            <select class="select2" name="team_members[]" multiple="multiple" data-placeholder="Select a team members" style="width: 100%;">';
                                                foreach($users as $user){
                                                $output .= '<option value="'.$user->id.'">'.$user->first_name.'</option>';
                                                }
                                            $output .= '</select>
                                        </div>
                                        <div class="form-group">
                                            <label for="starting date">Team admin</label>
                                            <div class="form-group">
                                                <select name="team_admin" class="form-control select2" style="width: 100%;">';
                                                foreach($new_team_admins as $new_team_admin) {  
                                                $output .= '<option value="'.$new_team_admin->id.'"';
                                                $output .= ($new_team_admin->id == $team->corporate_group_admin_id) ? "selected" : "";
                                                $output .= '>'.$new_team_admin->email.'</option>';
                                                }
                                                $output .='</select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                                            
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                </form>
                                <form action="http://localhost/deletenew_team/'.$team->corporate_group_admin_id.'" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="'.csrf_token().'"/>
                                    <input type="hidden" name="_method" value="delete"/>
                                    <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove client</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->';
                $output .= '<!-- team admin add modal -->
                <div class="modal fade" id="modal-teamadmin-add">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add team admin</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="http://localhost/add_newteamadmin" method="post" enctype="multipart/form-data">
                                
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="email">User name</label>
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">password</label>
                                        <input type="password" name="password" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="firstname">First name</label>
                                        <input type="text" name="firstname" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Last name</label>
                                        <input type="text" name="lastname" class="form-control" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="createdate">Creation Date</label>
                                        <div class="input-group date" id="creationdate6" data-target-input="nearest">
                                            <input type="text" name="createdate" class="form-control datetimepicker-input" data-target="#creationdate6">
                                            <div class="input-group-append" data-target="#creationdate6" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="userlevel">User level</label>
                                        <select class="select2" name="userlevel">
                                            <option value="1">admin</option>
                                            <option value="2">corporate_admin</option>
                                            <option value="3">premium_user</option>
                                            <option value="4">free_user</option>
                                            <option value="5">guest</option>
                                            <option value="6">coach</option>
                                            <option value="7" selected>corporate_group_admin</option>
                                            <option value="8">corporate_user</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="userstatus">User status</label>
                                        <select class="select2" name="userstatus">
                                            <option value="0">none</option>
                                            <option value="1">allowed</option>
                                            <option value="2">blocked</option>
                                            <option value="3">deleted</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="updateraison">Update raison</label>
                                        <select class="select2" name="updateraison">
                                            <option value="0">created</option>
                                            <option value="1">verified</option>
                                            <option value="2">blocked</option>
                                            <option value="3">closed</option>
                                            <option value="4">reset password</option>
                                            <option value="5">change profile</option>
                                            <option value="6">other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="language">Language</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="language" value="english"/>
                                            <label class="form-check-label">English</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="language" value="french"/>
                                            <label class="form-check-label">French</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="platform">Platform</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="platform" value="desktop"/>
                                            <label class="form-check-label">Desktop</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="platform" value="mobile"/>
                                            <label class="form-check-label">Mobile</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success shadow-btn btn-block">Create team admin</button>
                                    </div>
                                </div>
                                <!-- /.box-body -->
                                </form>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->';
                foreach ($new_team_admins as $new_team_admin) {
                    $output .='<!-- team admin edit modal -->
                    <div class="modal fade" id="modal-teamadmin-edit-'.$new_team_admin->id.'">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit team admin</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="http://localhost/edit_newteamadmin/'.$new_team_admin->id.'" method="post" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="email">User name</label>
                                            <input type="hidden" name="_token" value="'.csrf_token().'">
                                            <input type="email" name="email" value="'.$new_team_admin->email.'" class="form-control" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label for="new password">New password</label>
                                            <input type="password" name="password" class="form-control" autocomplete="off" required>
                                        </div> -->
                                        <div class="form-group">
                                            <label for="firstname">First name</label>
                                            <input type="text" name="firstname" value="'.$new_team_admin->first_name.'" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Last name</label>
                                            <input type="text" name="lastname" value="'.$new_team_admin->last_name.'" class="form-control" autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="createdate">Creation Date</label>
                                            <div class="input-group date" id="creationdate7" data-target-input="nearest">
                                                <input type="text" name="createdate" value="';
                                                $date = explode(' ', $new_team_admin->last_login); 
                                                $time=$date[1]; 
                                                $date=$date[0]; 
                                                $date=explode('-', $date); 
                                                $y=$date[0]; 
                                                $m=$date[1]; 
                                                $d=$date[2]; 
                                                $date=implode('/', [$m, $d, $y]); 
                                                $finaldate=implode(' ', [$date, $time]);
                                                $output .= $finaldate;
                                                $output .= '" class="form-control datetimepicker-input" data-target="#creationdate7">
                                                <div class="input-group-append" data-target="#creationdate7" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="userlevel">User level</label>
                                            <select class="select2" name="userlevel">
                                                <option value="1" ';
                                                $output .= ($new_team_admin->user_level == 1) ? "selected" : "dd" ;
                                                $output .= ">admin</option>";
                                                $output .= '<option value="2" ';
                                                $output .= ($new_team_admin->user_level == 2) ? "selected" : "dd" ;
                                                $output .= ">corporate_admin</option>";
                                                $output .= '<option value="3" ';
                                                $output .= ($new_team_admin->user_level == 3) ? "selected" : "dd" ;
                                                $output .= ">premium_user</option>";
                                                $output .= '<option value="4" ';
                                                $output .= ($new_team_admin->user_level == 4) ? "selected" : "" ;
                                                $output .= ">free_user</option>";
                                                $output .= '<option value="5" ';
                                                $output .= ($new_team_admin->user_level == 5) ? "selected" : "" ;
                                                $output .= ">guest</option>";
                                                $output .= '<option value="6" ';
                                                $output .= ($new_team_admin->user_level == 6) ? "selected" : "" ;
                                                $output .= ">coach</option>";
                                                $output .= '<option value="7" ';
                                                $output .= ($new_team_admin->user_level == 7) ? "selected" : "" ;
                                                $output .= ">corporate_group_admin</option>";
                                                $output .= '<option value="8" ';
                                                $output .= ($new_team_admin->user_level == 8) ? "selected" : "" ;
                                                $output .= ">corporate_user</option>";
                                                
                                        $output .= ' </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="userstatus">User status</label>
                                            <select class="select2" name="userstatus">
                                                <option value="0" ';
                                                $output .= ($new_team_admin->user_status == 0) ? "selected" : "";
                                                $output .= '>none</option>';
                                                $output .= '<option value="1" ';
                                                $output .= ($new_team_admin->user_status == 1) ? "selected" : "";
                                                $output .= '>allowed</option>';
                                                $output .= '<option value="2" ';
                                                $output .= ($new_team_admin->user_status == 2) ? "selected" : "";
                                                $output .= '>blocked</option>';
                                                $output .= '<option value="3" ';
                                                $output .= ($new_team_admin->user_status == 3) ? "selected" : "";
                                                $output .= '>deleted</option>';
                                            $output .= '</select>
                                        </div>
                                        <div class="form-group">
                                            <label for="updateraison">Update raison</label>
                                            <select class="select2" name="updateraison">
                                                <option value="0"'; 
                                                $output .= ($new_team_admin->update_raison == 0) ? "selected" : "";
                                                $output .= '>created</option>';
                                                $output .= '<option value="1"'; 
                                                $output .= ($new_team_admin->update_raison == 1) ? "selected" : "";
                                                $output .= '>verified</option>';
                                                $output .= '<option value="2"'; 
                                                $output .= ($new_team_admin->update_raison == 2) ? "selected" : "";
                                                $output .= '>blocked</option>';
                                                $output .= '<option value="3"'; 
                                                $output .= ($new_team_admin->update_raison == 3) ? "selected" : "";
                                                $output .= '>closed</option>';
                                                $output .= '<option value="4"'; 
                                                $output .= ($new_team_admin->update_raison == 4) ? "selected" : "";
                                                $output .= '>reset password</option>';
                                                $output .= '<option value="5"'; 
                                                $output .= ($new_team_admin->update_raison == 5) ? "selected" : "";
                                                $output .= '>change profile;</option>';
                                                $output .= '<option value="6"'; 
                                                $output .= ($new_team_admin->update_raison == 6) ? "selected" : "";
                                                $output .= '>other</option>';
                                            $output .= '</select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="language">Language</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="language" value="english" ';
                                                $output .= $new_team_admin->language=="english"?"checked":"";
                                                $output .= ' />
                                                <label class="form-check-label">English</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="language" value="french" ';
                                                $output .= ($new_team_admin->language=="french") ? "checked" : "";
                                                $output .= ' />
                                                <label class="form-check-label">French</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="platform">Platform</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="platform" value="desktop" ';
                                                $output .= $new_team_admin->platform=="desktop"?"checked":"";
                                                $output .= ' />
                                                <label class="form-check-label">Desktop</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="platform" value="mobile" ';
                                                $output .= ($new_team_admin->platform=="mobile") ? "checked" : "";
                                                $output .= ' />
                                                <label class="form-check-label">Mobile</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                                            
                                        </div>
                                    </div>
                                    <!-- /.box-body -->
                                    </form>
                                    <form  action="http://localhost/delete_newteamadmin/'.$new_team_admin->id.'" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="'.csrf_token().'"/>
                                        <input type="hidden" name="_method" value="delete"/>
                                        <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove team admin</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->';
                }
            }
        }
        echo $output;
        
    }



    // Adding Team
    public function newaddTeam(Request $request){
        $datas = $request->all();
        
        $corporate_id = $datas['corporate_id'];
        $team_name = $datas['team_name']; 
        $team_members = $datas['team_members']; 
        $team_admin = $datas['team_admin']; 

        Corporate_groups::create([
            'corporate_client_id' => $corporate_id,
            'group_name' => $team_name,
            'corporate_group_admin_id' => $team_admin
        ]);
        if ($team_members) {
            foreach ($team_members as $team_member) {
                Team_members::create([
                    'corporate_client_id' => $corporate_id,
                    'corporate_group_admin_id' => $team_admin,
                    'user_id' => $team_member
                ]);
                User::where('id', $team_member)->update([
                    'user_level' => 8
                ]);
            }
        }
        
        // User::where('id', $team_admin)->update([
        //     'user_level' => 7
        // ]);
        $notification = array(
            'message' => 'Created successfuly!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    // Editing Team
    public function neweditTeam(Request $request, $id){
        $datas = $request->all();
        $team_name = $datas['team_name'];
        $team_members = $datas['team_members'];
        $team_admin = $datas['team_admin'];

        Corporate_groups::where('corporate_group_admin_id', $id)->update([
            'group_name' => $team_name,
            'corporate_group_admin_id' => $team_admin,
        ]);

        if ($team_members) {
            foreach ($team_members as $team_member) {
                Team_members::where('corporate_group_admin_id', $id)->update([
                    'corporate_group_admin_id' => $team_admin,
                    'user_id' => $team_member
                ]);
            }
        }

        $notification = array(
            'message' => 'Updated successfuly!', 
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }

    public function newdeleteTeam(Request $request, $id){
        Corporate_groups::where('corporate_group_admin_id', $id)->delete();
        Team_members::where('corporate_group_admin_id', $id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }

    // Add newTeamadmin
    public function addnewTeamadmin(Request $request){
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            $password = $validator['password'];
            $password = Hash::make($password);
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
            User::create([
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password,
                'last_login' => $final_date,
                'user_level' => $userlevel,
                'user_status' => $userstatus,
                'update_raison' => $updateraison,
                // 'sponsore_id' => $sponsor,
                'language' => $language,
                'platform' => $platform,
            ]);
            $notification = array(
                'message' => 'Created successfuly!', 
                'alert-type' => 'success'
            );
            
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Email is already taken', 
                'alert-type' => 'error'
            );
            
            return back()->with($notification);
        }
        

    }

    // Edit newTeamadmin
    public function eidtnewTeamadmin(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            // $password = $request['password'];
            // $password = Hash::make($password);
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
            
            User::where('id', $id)->update([
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                // 'password' => $password,
                'last_login' => $final_date,
                'user_level' => $userlevel,
                'user_status' => $userstatus,
                'update_raison' => $updateraison,
                // 'sponsore_id' => $sponsor,
                'language' => $language,
                'platform' => $platform,
            ]);
            $notification = array(
                'message' => 'Updated successfuly!', 
                'alert-type' => 'success'
            );
            
            return back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Email is already taken', 
                'alert-type' => 'error'
            );
        }
       
        

    }
    // Delete newTeamadmin
    public function deletenewTeamadmin(Request $request, $id){
        Corporate_groups::where('corporate_group_admin_id', $id)->delete();
        Team_members::where('corporate_group_admin_id', $id)->delete();
        User::where('id', $id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
    
}
