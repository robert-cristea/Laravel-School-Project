<section class="content tab-pane fade" id="custom-content-below-teams" role="tabpanel" aria-labelledby="custom-content-below-teams-tab">
    <div class="container-fluid">
        
        <h5 class="pt-pb" style="font-weight: bold">Select client</h5>
        <div class="card card-primary">
        
            <div class="card-body">
                   
                <div class="form-group">
                @csrf
                    <select id="actionCorporate" name="corporate_name" class="form-control select2" data-placeholder="Select a State" style="width: 100%;">
                        
                        @foreach($corporate_clients as $client)
                        <option value="{{ $client->corporate_client_id }}">{{ $client->corporate_name }}</option>
                        @endforeach
                        
                    </select>
                </div>
            
            </div>
        <!-- /.card -->
        </div>
        <div id="showTeamAdmin">
            <h4 class="pt-pb">Corporate client's teams</h4>
            <h5 class="pt-pb" style="font-weight: bold">Teams</h5>
            <div class="card card-primary">
            
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="add-font">Create team</td>
                                <td class="right-addbtn" data-toggle="modal" data-target="#modal-team-add">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                    </span>
                                </td>
                            </tr>
                                @foreach($teams as $team)
                                <tr id="teamData">
                                    <td style="width:90%">{{ $team->group_name }}</td>
                                    <td class="right-editbtn" data-toggle="modal" data-target="#modal-team-edit{{ $team->group_id }}">
                                        <span>
                                            <i class="fa fa-edit"></i>
                                        </span>
                                    </td>
                                </tr> 
                                @endforeach
                        </tbody>
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
                            </tr>
                            @foreach($newteamadmins as $newteamadmin)
                            <tr>
                                <td style="width:90%">{{ $newteamadmin->first_name }}</td>
                                <td class="right-editbtn" data-toggle="modal" data-target="#modal-teamadmin-edit{{ $newteamadmin->id }}">
                                    <span>
                                        <i class="fa fa-edit"></i>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            <!-- /.card -->
            </div>
        </div>
    </div>

    
</section>

<!-- team add modal -->
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
                <form action="{{ route('team.create') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="box-body">
                    <div class="form-group">
                        <label for="team_name">Team name</label>
                        <input type="hidden" name="corporate_id" value="{{ $first_corporate_id }}" class="form-control">
                        <input type="text" name="team_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="team members">Team members</label>
                        <!-- <input type="text" class="form-control"> -->
                        <select class="select2" name="team_members[]" multiple="multiple" data-placeholder="Select a team members" style="width: 100%;">
                            @foreach($onlyusers as $onlyuser)
                            <option value="{{ $onlyuser->id }}">{{ $onlyuser->first_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="starting date">Team admin</label>
                        <div class="form-group">
                            <select name="team_admin" id="add_teamadmin" class="form-control select2" style="width: 100%;">';
                                @foreach($newteamadmins as $newteamadmin)    
                                <option value="{{ $newteamadmin->id }}">{{ $newteamadmin->email }}</option>
                                @endforeach
                            </select>
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
<!-- /.modal -->


<!-- team edit modal -->
@foreach($teams as $team)
<div class="modal fade" id="modal-team-edit{{ $team->group_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit team</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('team.edit', $team->corporate_group_admin_id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="team name">Team name</label>
                        <input type="text" name="team_name" value="{{ $team->group_name }}" class="form-control">
                    </div>
           
                    <div class="form-group">
                        <label for="licenses">Team members</label>
                        <select class="select2" name="team_members[]" multiple="multiple" data-placeholder="Select a team members" style="width: 100%;">
                            @foreach($onlyusers as $onlyuser)
                            <option value="{{ $onlyuser->id }}">{{ $onlyuser->first_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                    <label for="starting date">Team admin</label>
                        <div class="form-group">
                            <select name="team_admin" id="add_teamadmin" class="form-control select2" style="width: 100%;">';
                                @foreach($newteamadmins as $newteamadmin)    
                                <option value="{{ $newteamadmin->id }}" {{ ($newteamadmin->id == $team->corporate_group_admin_id) ? 'selected' : '' }} >{{ $newteamadmin->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                        
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
                <form action="{{ route('team.delete', $team->corporate_group_admin_id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove client</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
@endforeach
<!-- /.modal -->




<!-- team admin add modal -->
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
                <form action="{{ route('teamadmin.add') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="email">User name</label>
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
                        <!-- <input type="text" name="createdate" value="{{ $firstonlyusers->last_login }}" class="form-control" autocomplete="off" required> -->
                        <div class="input-group date" id="creatdate3" data-target-input="nearest">
                            <input type="text" name="createdate" class="form-control datetimepicker-input" data-target="#creatdate3" required>
                            <div class="input-group-append" data-target="#creatdate3" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userlevel">User level</label>
                        {{-- <input type="text" name="userlevel" class="form-control" value="2" autocomplete="off" disabled> --}}
                        <select class="select2" name="userlevel">
                            <option value="1">admin</option>
                            <option value="2" selected>corporate_admin</option>
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
                            <option value="0" >created</option>
                            <option value="1">verified</option>
                            <option value="2">blocked</option>
                            <option value="3">closed</option>
                            <option value="4">reset password</option>
                            <option value="5">change profile;</option>
                            <option value="6">other</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="sponsor">Sponsor</label>
                        <select class="select2" name="sponsor">
                            @foreach($corporate_clients as $client)
                            <option value="{{ $client->corporate_client_id }}" {{ ($client->corporate_client_id == $firstonlyusers->sponsor_id) ? "selected" : "" }}>{{ $client->corporate_name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
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
</div>
<!-- /.modal -->

<!-- team admin edit modal -->
@foreach($newteamadmins as $newteamadmin)
<div class="modal fade" id="modal-teamadmin-edit{{ $newteamadmin->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit team admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form form action="{{ route('teamadmin.edit', $newteamadmin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $newteamadmin->email }}" class="form-control" placeholder="Enter email" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="new password">New password</label>
                            <input type="password" name="password" class="form-control" autocomplete="off" required>
                        </div> --}}
                        <div class="form-group">
                            <label for="firstname">First name</label>
                            <input type="text" name="firstname" value="{{ $newteamadmin->first_name }}" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last name</label>
                            <input type="text" name="lastname" value="{{ $newteamadmin->last_name }}" class="form-control" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="createdate">Creation Date</label>
                            <!-- <input type="text" name="createdate" value="{{ $firstonlyusers->last_login }}" class="form-control" autocomplete="off" required> -->
                            <div class="input-group date" id="creationdate4" data-target-input="nearest">
                                <input type="text" name="createdate" value="<?php $date = explode(' ', $newteamadmin->last_login); $time=$date[1]; $date=$date[0]; $date=explode('-', $date); $y=$date[0]; $m=$date[1]; $d=$date[2]; $date=implode('/', [$m, $d, $y]); $finaldate=implode(' ', [$date, $time]); echo $finaldate;?>" class="form-control datetimepicker-input" data-target="#creationdate4">
                                <div class="input-group-append" data-target="#creationdate4" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userlevel">User level</label>
                            <select class="select2" name="userlevel">
                                <option value="1" {{ ($newteamadmin->user_level == 1) ? "selected" : "" }}>admin</option>
                                <option value="2" {{ ($newteamadmin->user_level == 2) ? "selected" : "" }}>corporate_admin</option>
                                <option value="3" {{ ($newteamadmin->user_level == 3) ? "selected" : "" }}>premium_user</option>
                                <option value="4" {{ ($newteamadmin->user_level == 4) ? "selected" : "" }}>free_user</option>
                                <option value="5" {{ ($newteamadmin->user_level == 5) ? "selected" : "" }}>guest</option>
                                <option value="6" {{ ($newteamadmin->user_level == 6) ? "selected" : "" }}>coach</option>
                                <option value="7" {{ ($newteamadmin->user_level == 7) ? "selected" : "" }}>corporate_group_admin</option>
                                <option value="8" {{ ($newteamadmin->user_level == 8) ? "selected" : "" }}>corporate_user</option>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userstatus">User status</label>
                            <select class="select2" name="userstatus">
                                <option value="0" {{ ($newteamadmin->user_status == 0) ? "selected" : "" }}>none</option>
                                <option value="1" {{ ($newteamadmin->user_status == 1) ? "selected" : "" }}>allowed</option>
                                <option value="2" {{ ($newteamadmin->user_status == 2) ? "selected" : "" }}>blocked</option>
                                <option value="3" {{ ($newteamadmin->user_status == 3) ? "selected" : "" }}>deleted</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="updateraison">Update raison</label>
                            <select class="select2" name="updateraison">
                                <option value="0" {{ ($newteamadmin->update_raison == 0) ? "selected" : "" }}>created</option>
                                <option value="1" {{ ($newteamadmin->update_raison == 1) ? "selected" : "" }}>verified</option>
                                <option value="2" {{ ($newteamadmin->update_raison == 2) ? "selected" : "" }}>blocked</option>
                                <option value="3" {{ ($newteamadmin->update_raison == 3) ? "selected" : "" }}>closed</option>
                                <option value="4" {{ ($newteamadmin->update_raison == 4) ? "selected" : "" }}>reset password</option>
                                <option value="5" {{ ($newteamadmin->update_raison == 5) ? "selected" : "" }}>change profile;</option>
                                <option value="6" {{ ($newteamadmin->update_raison == 6) ? "selected" : "" }}>other</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="sponsor">Sponsor</label>
                            <select class="select2" name="sponsor">
                                @foreach($corporate_clients as $client)
                                <option value="{{ $client->corporate_client_id }}" {{ ($client->corporate_client_id == $corporateadmin->sponsor_id) ? "selected" : "" }}>{{ $client->corporate_name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group">
                            <label for="language">Language</label>
                            <!-- <input type="text" name="language" value="{{ $firstonlyusers->language }}" class="form-control" autocomplete="off" required> -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="language" value="english" {{ $newteamadmin->language=="english"?"checked":""}} />
                                <label class="form-check-label">English</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="language" value="french" {{ ($newteamadmin->language=="french") ? "checked" : ""}} />
                                <label class="form-check-label">French</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="platform">Platform</label>
                            <!-- <input type="text" name="platform" value="{{ $firstonlyusers->platform }}" class="form-control" autocomplete="off" required> -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="platform" value="desktop" {{ $newteamadmin->platform=="desktop"?"checked":""}} />
                                <label class="form-check-label">Desktop</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="platform" value="mobile" {{ ($newteamadmin->platform=="mobile") ? "checked" : ""}} />
                                <label class="form-check-label">Mobile</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                            
                        </div>
                    </div>
                    <!-- /.box-body -->
                </form>
                <form action="{{ route('teamadmin.delete', $newteamadmin->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove team admin</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
@endforeach
<!-- /.modal -->

