<section class="content tab-pane fade" id="custom-content-below-user" role="tabpanel" aria-labelledby="custom-content-below-user-tab">
    <div class="container-fluid">
        <h4 class="pt-pb">Search user</h4>

        <h5 class="pt-pb" style="font-weight: bold">email</h5>
        @csrf
        <select id="showUser" class="form-control select2" style="width: 100%;">
            @foreach($onlyusers as $onlyuser)
            <option value="{{ $onlyuser->id }}">{{ $onlyuser->email }}</option>
            @endforeach
        </select>

        <h5 class="pt-pb" style="font-weight: bold">Search result</h5>
        <div class="card card-primary">
        
            <div id="showUser_html" class="card-body">
                
                <table class="table table-bordered">
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
                            <td style="width:90%">{{ $firstonlyusers->first_name }}</td>
                            <td class="right-editbtn"  data-toggle="modal" data-target="#modal-user-edit{{ $firstonlyusers->id }}">
                                <span>
                                    <i class="fa fa-edit"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                    
                </table>
                <!-- team admin add modal -->
                <div class="modal fade" id="modal-user-add">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add User admin</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.add') }}" method="post" enctype="multipart/form-data">
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
                                        <div class="input-group date" id="creatdate9" data-target-input="nearest">
                                            <input type="text" name="createdate" class="form-control datetimepicker-input" data-target="#creatdate9" required>
                                            <div class="input-group-append" data-target="#creatdate9" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="userlevel">User level</label>
                                        {{-- <input type="text" name="userlevel" class="form-control" value="2" autocomplete="off" disabled> --}}
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
                <div class="modal fade" id="modal-user-edit{{ $firstonlyusers->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit team admin</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form form action="{{ route('user.edit', $firstonlyusers->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="box-body">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" value="{{ $firstonlyusers->email }}" class="form-control" placeholder="Enter email" required>
                                            </div>
                                            <!-- <div class="form-group">
                                                <label for="new password">New password</label>
                                                <input type="password" name="password" class="form-control" autocomplete="off" required>
                                            </div> -->
                                            <div class="form-group">
                                                <label for="firstname">First name</label>
                                                <input type="text" name="firstname" value="{{ $firstonlyusers->first_name }}" class="form-control" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="lastname">Last name</label>
                                                <input type="text" name="lastname" value="{{ $firstonlyusers->last_name }}" class="form-control" autocomplete="off" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="createdate">Creation Date</label>
                                                <!-- <input type="text" name="createdate" value="{{ $firstonlyusers->last_login }}" class="form-control" autocomplete="off" required> -->
                                                <div class="input-group date" id="creationdate" data-target-input="nearest">
                                                    <input type="text" name="createdate" value="<?php $date = explode(' ', $firstonlyusers->last_login); $time=$date[1]; $date=$date[0]; $date=explode('-', $date); $y=$date[0]; $m=$date[1]; $d=$date[2]; $date=implode('/', [$m, $d, $y]); $finaldate=implode(' ', [$date, $time]); echo $finaldate;?>" class="form-control datetimepicker-input" data-target="#creationdate">
                                                    <div class="input-group-append" data-target="#creationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="userlevel">User level</label>
                                                <select class="select2" name="userlevel">
                                                    <option value="1" {{ ($firstonlyusers->user_level == 1) ? "selected" : "" }}>admin</option>
                                                    <option value="2" {{ ($firstonlyusers->user_level == 2) ? "selected" : "" }}>corporate_admin</option>
                                                    <option value="3" {{ ($firstonlyusers->user_level == 3) ? "selected" : "" }}>premium_user</option>
                                                    <option value="4" {{ ($firstonlyusers->user_level == 4) ? "selected" : "" }}>free_user</option>
                                                    <option value="5" {{ ($firstonlyusers->user_level == 5) ? "selected" : "" }}>guest</option>
                                                    <option value="6" {{ ($firstonlyusers->user_level == 6) ? "selected" : "" }}>coach</option>
                                                    <option value="7" {{ ($firstonlyusers->user_level == 7) ? "selected" : "" }}>corporate_group_admin</option>
                                                    <option value="8" {{ ($firstonlyusers->user_level == 8) ? "selected" : "" }}>corporate_user</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="userstatus">User status</label>
                                                <select class="select2" name="userstatus">
                                                    <option value="0" {{ ($firstonlyusers->user_status == 0) ? "selected" : "" }}>none</option>
                                                    <option value="1" {{ ($firstonlyusers->user_status == 1) ? "selected" : "" }}>allowed</option>
                                                    <option value="2" {{ ($firstonlyusers->user_status == 2) ? "selected" : "" }}>blocked</option>
                                                    <option value="3" {{ ($firstonlyusers->user_status == 3) ? "selected" : "" }}>deleted</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="updateraison">Update raison</label>
                                                <select class="select2" name="updateraison">
                                                    <option value="0" {{ ($firstonlyusers->update_raison == 0) ? "selected" : "" }}>created</option>
                                                    <option value="1" {{ ($firstonlyusers->update_raison == 1) ? "selected" : "" }}>verified</option>
                                                    <option value="2" {{ ($firstonlyusers->update_raison == 2) ? "selected" : "" }}>blocked</option>
                                                    <option value="3" {{ ($firstonlyusers->update_raison == 3) ? "selected" : "" }}>closed</option>
                                                    <option value="4" {{ ($firstonlyusers->update_raison == 4) ? "selected" : "" }}>reset password</option>
                                                    <option value="5" {{ ($firstonlyusers->update_raison == 5) ? "selected" : "" }}>change profile;</option>
                                                    <option value="6" {{ ($firstonlyusers->update_raison == 6) ? "selected" : "" }}>other</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="sponsor">Sponsor</label>
                                                <select class="select2" name="sponsor">
                                                    @foreach($corporate_clients as $client)
                                                    <option value="{{ $client->corporate_client_id }}" {{ ($client->corporate_client_id == $firstonlyusers->sponsor_id) ? "selected" : "" }}>{{ $client->corporate_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="language">Language</label>
                                                <!-- <input type="text" name="language" value="{{ $firstonlyusers->language }}" class="form-control" autocomplete="off" required> -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="language" value="english" {{ $firstonlyusers->language=="english"?"checked":""}} />
                                                    <label class="form-check-label">English</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="language" value="french" {{ ($firstonlyusers->language=="french") ? "checked" : ""}} />
                                                    <label class="form-check-label">French</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="platform">Platform</label>
                                                <!-- <input type="text" name="platform" value="{{ $firstonlyusers->platform }}" class="form-control" autocomplete="off" required> -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="platform" value="desktop" {{ $firstonlyusers->platform=="desktop"?"checked":""}} />
                                                    <label class="form-check-label">Desktop</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="platform" value="mobile" {{ ($firstonlyusers->platform=="mobile") ? "checked" : ""}} />
                                                    <label class="form-check-label">Mobile</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                                                
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </form>
                                    <form action="{{ route('user.delete', $firstonlyusers->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red shadow-btn btn-block">Remove team admin</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                    <!-- /.modal-dialog -->
                    </div>
            </div>
        <!-- /.card -->
        </div>
    </div>
</section>

