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

class UsersController extends Controller
{
    // Add User
    public function addUser(Request $request){
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
                'message' => 'Email is already taken.', 
                'alert-type' => 'error'
            );
            
            return back()->with($notification);
        }
        
    }
    // Edit User
    public function eidtUser(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            $password = $request['password'];
            $password = Hash::make($password);
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
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
            $userlevel = $request['userlevel'];
            $userstatus = $request['userstatus'];
            $updateraison = $request['updateraison'];
            $sponsor = $request['sponsor'];
            $language = $request['language'];
            $platform = $request['platform'];
            User::where('id', $id)->update([
                'email' => $email,
                // 'password' => $password
                'first_name' => $firstname,
                'last_name' => $lastname,
                'last_login' => $final_date,
                'user_level' => $userlevel,
                'user_status' => $userstatus,
                'update_raison' => $updateraison,
                'sponsore_id' => $sponsor,
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

    // Delete User
    public function deleteUser(Request $request, $id){
        User::where('id', $id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
    public function showUser(Request $request){
        $id = $request->id;
        $user = User::where('id', $id)->first();
        $corporate_clients = Corporate_clients::all();
        $output = '<table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="add-font">Add user</td>
                                <td class="right-addbtn" data-toggle="modal" data-target="#modal-user-add">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:90%">'.$user->first_name.'</td>
                                <td class="right-editbtn"  data-toggle="modal" data-target="#modal-user-edit'.$user->id.'">
                                    <span>
                                        <i class="fa fa-edit"></i>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>';
        $output .= '<!-- user add modal -->
                    <div class="modal fade" id="modal-user-add">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add user admin</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="http://localhost/add_newuser" method="post" enctype="multipart/form-data">
                                    
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
                                            
                                            <div class="input-group date" id="creatdate0" data-target-input="nearest">
                                                <input type="text" name="createdate" class="form-control datetimepicker-input" data-target="#creatdate0" required>
                                                <div class="input-group-append" data-target="#creatdate0" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="userlevel">User level</label>
                                            
                                            <select class="select2" name="userlevel">
                                                <option value="1">admin</option>
                                                <option value="2">corporate_admin</option>
                                                <option value="3" selected>premium_user</option>
                                                <option value="4">free_user</option>
                                                <option value="5">guest</option>
                                                <option value="6">coach</option>
                                                <option value="7">corporate_group_admin</option>
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
                                                <option value="0" >created</option>
                                                <option value="1">verified</option>
                                                <option value="2">blocked</option>
                                                <option value="3">closed</option>
                                                <option value="4">reset password</option>
                                                <option value="5">change profile;</option>
                                                <option value="6">other</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="sponsor">Sponsor</label>
                                            <select class="select2" name="sponsor">';
                                                foreach($corporate_clients as $client){
                                                    $output .= '<option value="';
                                                    $output .= $client->corporate_client_id;
                                                    $output .= '">';
                                                    $output .= $client->corporate_name;
                                                    $output .= '</option>';
                                                }
                                                
                                                
                                            $output .= '</select>
                                        </div>
                                        <div class="form-group">
                                            <label for="language">Language</label>
                                            <!-- <input type="text" name="language" value="{{ $firstonlyusers->language }}" class="form-control" autocomplete="off" required> -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="language" checked value="english"/>
                                                <label class="form-check-label">English</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="language" value="french"/>
                                                <label class="form-check-label">French</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="platform">Platform</label>
                                            <!-- <input type="text" name="platform" value="{{ $firstonlyusers->platform }}" class="form-control" autocomplete="off" required> -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="platform" checked value="desktop"/>
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
                    </div>';                    
        $output .= '<div class="modal fade" id="modal-user-edit'.$user->id.'">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit team admin</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form form action="http://localhost/edit_newuser/'.$user->id.'" method="post" enctype="multipart/form-data">
                                    
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="hidden" name="_token" value="'.csrf_token().'"/>
                                                <input type="email" name="email" value="'.$user->email.'" class="form-control" placeholder="Enter email" required>
                                            </div>
                                            <!-- 
                                            <div class="form-group">
                                                <label for="new password">New password</label>
                                                <input type="password" name="password" class="form-control" autocomplete="off" required>
                                            </div>
                                            -->
                                            <div class="form-group">
                                                <label for="firstname">First name</label>
                                                <input type="text" name="firstname" value="'.$user->first_name.'" class="form-control" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Last name</label>
                                                <input type="text" name="lastname" value="'.$user->last_name.'" class="form-control" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="createdate">Creation Date</label>
                                                <div class="input-group date" id="creationdate" data-target-input="nearest">
                                                    <input type="text" name="createdate" value="';
                                                    $date = explode(' ', $user->last_login); 
                                                    $time=$date[1]; 
                                                    $date=$date[0]; 
                                                    $date=explode('-', $date); 
                                                    $y=$date[0]; 
                                                    $m=$date[1]; 
                                                    $d=$date[2]; 
                                                    $date=implode('/', [$m, $d, $y]); 
                                                    $finaldate=implode(' ', [$date, $time]);
                                                    $output .= $finaldate;
                                                    $output .= '" class="form-control datetimepicker-input" data-target="#creationdate">
                                                    <div class="input-group-append" data-target="#creationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="userlevel">User level</label>
                                                <select class="select2" name="userlevel">
                                                    <option value="1" ';
                                                    $output .= ($user->user_level == 1) ? "selected" : "dd" ;
                                                    $output .= ">admin</option>";
                                                    $output .= '<option value="2" ';
                                                    $output .= ($user->user_level == 2) ? "selected" : "dd" ;
                                                    $output .= ">corporate_admin</option>";
                                                    $output .= '<option value="3" ';
                                                    $output .= ($user->user_level == 3) ? "selected" : "dd" ;
                                                    $output .= ">premium_user</option>";
                                                    $output .= '<option value="4" ';
                                                    $output .= ($user->user_level == 4) ? "selected" : "" ;
                                                    $output .= ">free_user</option>";
                                                    $output .= '<option value="5" ';
                                                    $output .= ($user->user_level == 5) ? "selected" : "" ;
                                                    $output .= ">guest</option>";
                                                    $output .= '<option value="6" ';
                                                    $output .= ($user->user_level == 6) ? "selected" : "" ;
                                                    $output .= ">coach</option>";
                                                    $output .= '<option value="7" ';
                                                    $output .= ($user->user_level == 7) ? "selected" : "" ;
                                                    $output .= ">corporate_group_admin</option>";
                                                    $output .= '<option value="8" ';
                                                    $output .= ($user->user_level == 8) ? "selected" : "" ;
                                                    $output .= ">corporate_user</option>";
                                                    
                                                $output .= ' </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="userstatus">User status</label>
                                                <select class="select2" name="userstatus">
                                                    <option value="0" ';
                                                    $output .= ($user->user_status == 0) ? "selected" : "";
                                                    $output .= '>none</option>';
                                                    $output .= '<option value="1" ';
                                                    $output .= ($user->user_status == 1) ? "selected" : "";
                                                    $output .= '>allowed</option>';
                                                    $output .= '<option value="2" ';
                                                    $output .= ($user->user_status == 2) ? "selected" : "";
                                                    $output .= '>blocked</option>';
                                                    $output .= '<option value="3" ';
                                                    $output .= ($user->user_status == 3) ? "selected" : "";
                                                    $output .= '>deleted</option>';
                                                $output .= '</select>
                                            </div>
                                            <div class="form-group">
                                                <label for="updateraison">Update raison</label>
                                                <select class="select2" name="updateraison">
                                                    <option value="0"'; 
                                                    $output .= ($user->update_raison == 0) ? "selected" : "";
                                                    $output .= '>created</option>';
                                                    $output .= '<option value="1"'; 
                                                    $output .= ($user->update_raison == 1) ? "selected" : "";
                                                    $output .= '>verified</option>';
                                                    $output .= '<option value="2"'; 
                                                    $output .= ($user->update_raison == 2) ? "selected" : "";
                                                    $output .= '>blocked</option>';
                                                    $output .= '<option value="3"'; 
                                                    $output .= ($user->update_raison == 3) ? "selected" : "";
                                                    $output .= '>closed</option>';
                                                    $output .= '<option value="4"'; 
                                                    $output .= ($user->update_raison == 4) ? "selected" : "";
                                                    $output .= '>reset password</option>';
                                                    $output .= '<option value="5"'; 
                                                    $output .= ($user->update_raison == 5) ? "selected" : "";
                                                    $output .= '>change profile;</option>';
                                                    $output .= '<option value="6"'; 
                                                    $output .= ($user->update_raison == 6) ? "selected" : "";
                                                    $output .= '>other</option>';
                                                $output .= '</select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor">Sponsor</label>
                                                <select class="select2" name="sponsor">';
                                                    foreach($corporate_clients as $client){
                                                    $output .= '<option value="';
                                                    $output .= $client->corporate_client_id;
                                                    $output .= '"';
                                                    $output .= ($client->corporate_client_id == $user->sponsor_id) ? "selected" : "";
                                                    $output .= '>'.$client->corporate_name;
                                                    $output .= '</option>';
                                                    }
                                                $output .= '</select>
                                            </div>
                                            <div class="form-group">
                                                <label for="language">Language</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="language" value="english" ';
                                                    $output .= $user->language=="english"?"checked":"";
                                                    $output .= ' />
                                                    <label class="form-check-label">English</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="language" value="french" ';
                                                    $output .= ($user->language=="french") ? "checked" : "";
                                                    $output .= ' />
                                                    <label class="form-check-label">French</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="platform">Platform</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="platform" value="desktop" ';
                                                    $output .= $user->platform=="desktop"?"checked":"";
                                                    $output .= ' />
                                                    <label class="form-check-label">Desktop</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="platform" value="mobile" ';
                                                    $output .= ($user->platform=="mobile") ? "checked" : "";
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
                                    <form action="http://localhost/delete_newuser/'.$user->id.'" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" value="'.csrf_token().'"/>
                                        <input type="hidden" name="_method" value="delete"/>
                                        <button type="submit" class="btn btn-red shadow-btn btn-block">Remove team admin</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    <!-- /.modal-dialog -->
                    </div>';
        echo $output;
    }
    // Add new User
    public function addnewUser(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            $password = $request['password'];
            $password = Hash::make($password);
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
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
            $userlevel = $request['userlevel'];
            $userstatus = $request['userstatus'];
            $updateraison = $request['updateraison'];
            $sponsor = $request['sponsor'];
            $language = $request['language'];
            $platform = $request['platform'];
            User::where('id', $id)->update([
                'email' => $email,
                // 'password' => $password
                'first_name' => $firstname,
                'last_name' => $lastname,
                'last_login' => $final_date,
                'user_level' => $userlevel,
                'user_status' => $userstatus,
                'update_raison' => $updateraison,
                'sponsore_id' => $sponsor,
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
    // Edit new User
    public function eidtnewUser(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:vieva_users|max:255|string'
        ]);
        if ($validator->passes()){
            $email = $validator['email'];
            $password = $request['password'];
            $password = Hash::make($password);
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
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
            $userlevel = $request['userlevel'];
            $userstatus = $request['userstatus'];
            $updateraison = $request['updateraison'];
            $sponsor = $request['sponsor'];
            $language = $request['language'];
            $platform = $request['platform'];
            User::where('id', $id)->update([
                'email' => $email,
                // 'password' => $password
                'first_name' => $firstname,
                'last_name' => $lastname,
                'last_login' => $final_date,
                'user_level' => $userlevel,
                'user_status' => $userstatus,
                'update_raison' => $updateraison,
                'sponsore_id' => $sponsor,
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

    // Delete new User
    public function deletenewUser(Request $request, $id){
        User::where('id', $id)->delete();
        $notification = array(
            'message' => 'Deleted successfuly!', 
            'alert-type' => 'success'
        );
        
        return back()->with($notification);
    }
}
