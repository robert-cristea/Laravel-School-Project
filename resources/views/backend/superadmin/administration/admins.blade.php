<section class="content tab-pane fade show active" id="custom-content-below-admins" role="tabpanel" aria-labelledby="custom-content-below-admins-tab">
        
    <div class="container-fluid">
        <h4 class="pt-pb">Vieva admins</h4>
        <h5 class="pt-pb" style="font-weight: bold">Superadmin</h5>
        <div class="card card-primary">
        
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        @foreach($superadmins as $superadmin)
                        <tr>
                            <td style="width:90%">{{ $superadmin->first_name }}</td>
                            <td class="right-editbtn" data-toggle="modal" data-target="#modal-superadmin">
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

        <h5 class="pt-pb" style="font-weight: bold">Admins</h5>
        <div class="card card-primary">
        
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="add-font">Add admin</td>
                            <td class="right-addbtn" data-toggle="modal" data-target="#modal-admin-add">
                                <span>
                                    <i class="fa fa-plus"></i>
                                </span>
                            </td>
                        </tr>
                        @foreach($admins as $admin)
                        <tr>
                            <td style="width:90%">{{ $admin->email }}</td>
                            <td class="right-editbtn" data-toggle="modal" data-target="#modal-admin-edit-{{ $admin->id }}">
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
</section>

@foreach($superadmins as $superadmin)
<!-- superadmin edit modal -->
<div class="modal fade" id="modal-superadmin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Super admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('superadmin_update', $superadmin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $superadmin->email }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="old password">Old password</label>
                        <input type="password" name="oldpass" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="new password">New password</label>
                        <input type="password" name="newpass" class="form-control" required>
                    </div>
                    <!-- <div class="form-group">
                        <label for="new password">Confirm password</label>
                        <input type="password" name="confirmpass" class="form-control">
                    </div> -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
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
@endforeach


<!-- admin add modal -->
<div class="modal fade" id="modal-admin-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  action="{{ route('admin_add')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" name="email" id="admin_email" class="form-control" required>
                            <div id="email_list"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="password" name="password" class="form-control" required>
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
                            <div class="input-group date" id="creationdate" data-target-input="nearest">
                                <input type="text" name="createdate" class="form-control datetimepicker-input" data-target="#creationdate" required>
                                <div class="input-group-append" data-target="#creationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="userlevel">User level</label>
                            <select class="select2" name="userlevel">
                                <option value="1" selected>admin</option>
                                <option value="2">corporate_admin</option>
                                <option value="3">premium_user</option>
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
                            <button type="submit" class="btn btn-success shadow-btn btn-block">Create admin</button>
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

@foreach($admins as $admin)
<!-- admin edit modal -->
<div class="modal fade" id="modal-admin-edit-{{ $admin->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit admin</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin-edit', $admin->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $admin->email }}" class="form-control">
                    </div>
                    {{-- <div class="form-group">
                        <label for="new password">New password</label>
                        <input type="text" name="newpass" class="form-control">
                    </div> --}}
                    <div class="form-group">
                        <label for="firstname">First name</label>
                        <input type="text" name="firstname" value="{{ $admin->first_name }}" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last name</label>
                        <input type="text" name="lastname" value="{{ $admin->last_name }}" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="createdate">Creation Date</label>
                        <!-- <input type="text" name="createdate" value="{{ $firstonlyusers->last_login }}" class="form-control" autocomplete="off" required> -->
                        <div class="input-group date" id="creationdate" data-target-input="nearest">
                            <input type="text" name="createdate" value="<?php $date = explode(' ', $admin->last_login); $time=$date[1]; $date=$date[0]; $date=explode('-', $date); $y=$date[0]; $m=$date[1]; $d=$date[2]; $date=implode('/', [$m, $d, $y]); $finaldate=implode(' ', [$date, $time]); echo $finaldate;?>" class="form-control datetimepicker-input" data-target="#creationdate">
                            <div class="input-group-append" data-target="#creationdate" data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="userlevel">User level</label>
                        <select class="select2" name="userlevel">
                            <option value="1" {{ ($admin->user_level == 1) ? "selected" : "" }}>admin</option>
                            <option value="2" {{ ($admin->user_level == 2) ? "selected" : "" }}>corporate_admin</option>
                            <option value="3" {{ ($admin->user_level == 3) ? "selected" : "" }}>premium_user</option>
                            <option value="4" {{ ($admin->user_level == 4) ? "selected" : "" }}>free_user</option>
                            <option value="5" {{ ($admin->user_level == 5) ? "selected" : "" }}>guest</option>
                            <option value="6" {{ ($admin->user_level == 6) ? "selected" : "" }}>coach</option>
                            <option value="7" {{ ($admin->user_level == 7) ? "selected" : "" }}>corporate_group_admin</option>
                            <option value="8" {{ ($admin->user_level == 8) ? "selected" : "" }}>corporate_user</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="userstatus">User status</label>
                        <select class="select2" name="userstatus">
                            <option value="0" {{ ($admin->user_status == 0) ? "selected" : "" }}>none</option>
                            <option value="1" {{ ($admin->user_status == 1) ? "selected" : "" }}>allowed</option>
                            <option value="2" {{ ($admin->user_status == 2) ? "selected" : "" }}>blocked</option>
                            <option value="3" {{ ($admin->user_status == 3) ? "selected" : "" }}>deleted</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="updateraison">Update raison</label>
                        <select class="select2" name="updateraison">
                            <option value="0" {{ ($admin->update_raison == 0) ? "selected" : "" }}>created</option>
                            <option value="1" {{ ($admin->update_raison == 1) ? "selected" : "" }}>verified</option>
                            <option value="2" {{ ($admin->update_raison == 2) ? "selected" : "" }}>blocked</option>
                            <option value="3" {{ ($admin->update_raison == 3) ? "selected" : "" }}>closed</option>
                            <option value="4" {{ ($admin->update_raison == 4) ? "selected" : "" }}>reset password</option>
                            <option value="5" {{ ($admin->update_raison == 5) ? "selected" : "" }}>change profile;</option>
                            <option value="6" {{ ($admin->update_raison == 6) ? "selected" : "" }}>other</option>
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
                            <input class="form-check-input" type="radio" name="language" value="english" {{ $admin->language=="english"?"checked":""}} />
                            <label class="form-check-label">English</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="language" value="french" {{ ($admin->language=="french") ? "checked" : ""}} />
                            <label class="form-check-label">French</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="platform">Platform</label>
                        <!-- <input type="text" name="platform" value="{{ $firstonlyusers->platform }}" class="form-control" autocomplete="off" required> -->
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="platform" value="desktop" {{ $admin->platform=="desktop"?"checked":""}} />
                            <label class="form-check-label">Desktop</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="platform" value="mobile" {{ ($admin->platform=="mobile") ? "checked" : ""}} />
                            <label class="form-check-label">Mobile</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                        
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
                <form action="{{ route('admin-delete', $admin->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove admin</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endforeach
