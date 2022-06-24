<section class="content tab-pane fade" id="custom-content-below-client" role="tabpanel"
  aria-labelledby="custom-content-below-client-tab">
  <div class="container-fluid">
    <h4 class="pt-pb">Corporate clients</h4>

    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="add-font">Add client</td>
              <td class="right-addbtn" data-toggle="modal" data-target="#modal-client-add">
                <span>
                  <i class="fa fa-plus"></i>
                </span>
              </td>
            </tr>
            @foreach ($corporate_clients as $client)
              <tr>
                <td style="width:90%">{{ $client->corporate_name }}</td>
                <td class="right-editbtn" data-toggle="modal"
                  data-target="#modal-client-edit-{{ $client->corporate_client_id }}">
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

    <h5 class="pt-pb" style="font-weight: bold">Corporate Admins</h5>
    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td class="add-font">Add Corporate Admin</td>
              <td class="right-addbtn" data-toggle="modal" data-target="#modal-corporateadmin-add">
                <span>
                  <i class="fa fa-plus"></i>
                </span>
              </td>
            </tr>
            @foreach ($corporateadmins as $corporateadmin)
              <tr>
                <td style="width:90%">{{ $corporateadmin->first_name }}</td>
                <td class="right-editbtn" data-toggle="modal"
                  data-target="#modal-corporateadmin-edit{{ $corporateadmin->id }}">
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

<!-- client add modal -->
<div class="modal fade" id="modal-client-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add client</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('client.add') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="email">Client email</label>

              <select name="clientid" class="form-control select2" style="width: 100%;">
                <option></option>
                @foreach ($corporateadmins as $corporateadmin)
                  <option value="{{ $corporateadmin->id }}">{{ $corporateadmin->email }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="corporate name">Corporate name</label>
              <input type="text" name="corporate_name" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="licenses">Number of licenses</label>
              <input type="number" name="licence_number" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="starting date">Program starting date</label>

              <div class="input-group date" id="reservationdate" data-target-input="nearest">
                <input type="text" name="start_date" class="form-control datetimepicker-input"
                  data-target="#reservationdate">
                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>

            </div>
            <div class="form-group">
              <label for="expiration date">Program expiration date</label>

              <div class="input-group date" id="reservationdate1" data-target-input="nearest">
                <input type="text" name="end_date" class="form-control datetimepicker-input"
                  data-target="#reservationdate1">
                <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="licenses">Number of Hours</label>
              <input type="number" name="hours" class="form-control" required>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success shadow-btn btn-block">Create client</button>
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

@foreach ($corporate_clients as $client)
  <!-- client edit modal -->
  <div class="modal fade" id="modal-client-edit-{{ $client->corporate_client_id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit client</h4>
          01 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('client.update', $client->corporate_client_id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="email">Client email</label>
                <select name="clientid" class="form-control select2" style="width: 100%;" required>
                  <option></option>
                  @foreach ($corporateadmins as $corporateadmin)
                    <option value="{{ $corporateadmin->id }}"
                      {{ $corporateadmin->id == $client->admin_id ? 'selected' : '' }}>{{ $corporateadmin->email }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="name">Client name</label>
                <input type="text" class="form-control" name="corporate_name" value="{{ $client->corporate_name }}">
              </div>
              <div class="form-group">
                <label for="licenses">Number of licenses</label>
                <input type="number" class="form-control" name="licence_num" value="{{ $client->Number_licences }}">
              </div>
              <div class="form-group">
                <label for="starting date">Program starting date</label>
                <div class="input-group date" id="starting_date{{ $client->corporate_client_id }}"
                  data-target-input="nearest">
                  <input type="text" name="start_date" value="<?php
                  $date = explode('-', $client->plan_starting_date);
                  $y = $date[0];
                  $m = $date[1];
                  $d = $date[2];
                  $date = implode('/', [$m, $d, $y]);
                  echo $date;
                  ?>" class="form-control datetimepicker-input"
                    data-target="#starting_date{{ $client->corporate_client_id }}">
                  <div class="input-group-append" data-target="#starting_date{{ $client->corporate_client_id }}"
                    data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="expiration date">Program expiration date</label>
                <div class="input-group date" id="end_date{{ $client->corporate_client_id }}"
                  data-target-input="nearest">
                  <input type="text" name="end_date" value="<?php
                  $date = explode('-', $client->plan_expiration_date);
                  $y = $date[0];
                  $m = $date[1];
                  $d = $date[2];
                  $date = implode('/', [$m, $d, $y]);
                  echo $date;
                  ?>" class="form-control datetimepicker-input"
                    data-target="#end_date{{ $client->corporate_client_id }}">
                  <div class="input-group-append" data-target="#end_date{{ $client->corporate_client_id }}"
                    data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="licenses">Number of Hours</label>
                <input type="number" name="hours" class="form-control" value="{{ $client->corporate_settings->hours }}"
                  required>
              </div>
              <!-- <div class="form-group">
                        <label for="new password">New password</label>
                        <input type="password" class="form-control">
                    </div> -->
              <div class="form-group">
                <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
              </div>
            </div>
            <!-- /.box-body -->
          </form>
          <form action="{{ route('client.delete', $client->corporate_client_id) }}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove client</button>
          </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endforeach

<!-- corporate admin add modal -->
<div class="modal fade" id="modal-corporateadmin-add">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add corporate admin</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('corporateadmin.add') }}" method="post" enctype="multipart/form-data">
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
              <div class="input-group date" id="creatdate" data-target-input="nearest">
                <input type="text" name="createdate" class="form-control datetimepicker-input" data-target="#creatdate"
                  required>
                <div class="input-group-append" data-target="#creatdate" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="userlevel">User level</label>
              <select class="select2" name="userlevel">
                <option value="1">admin</option>
                <option value="2" selected>corporate_admin</option>
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
                <option value="0">created</option>
                <option value="1">verified</option>
                <option value="2">blocked</option>
                <option value="3">closed</option>
                <option value="4">reset password</option>
                <option value="5">change profile;</option>
                <option value="6">other</option>
              </select>
            </div>
            <div class="form-group">
              <label for="language">Language</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="language" checked value="english" />
                <label class="form-check-label">English</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="language" value="french" />
                <label class="form-check-label">French</label>
              </div>
            </div>
            <div class="form-group">
              <label for="platform">Platform</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="platform" checked value="desktop" />
                <label class="form-check-label">Desktop</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="platform" value="mobile" />
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

<!-- corporate admin edit modal -->
@foreach ($corporateadmins as $corporateadmin)
  <div class="modal fade" id="modal-corporateadmin-edit{{ $corporateadmin->id }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit team admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form form action="{{ route('corporateadmin.edit', $corporateadmin->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="box-body">
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $corporateadmin->email }}" class="form-control"
                  placeholder="Enter email" required>
              </div>
              <div class="form-group">
                <label for="firstname">First name</label>
                <input type="text" name="firstname" value="{{ $corporateadmin->first_name }}" class="form-control"
                  autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="lastname">Last name</label>
                <input type="text" name="lastname" value="{{ $corporateadmin->last_name }}" class="form-control"
                  autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="createdate">Creation Date</label>
                <div class="input-group date" id="creationdate1" data-target-input="nearest">
                  <input type="text" name="createdate" value="<?php
                  $date = explode(' ', $corporateadmin->last_login);
                  $time = $date[1];
                  $date = $date[0];
                  $date = explode('-', $date);
                  $y = $date[0];
                  $m = $date[1];
                  $d = $date[2];
                  $date = implode('/', [$m, $d, $y]);
                  $finaldate = implode(' ', [$date, $time]);
                  echo $finaldate;
                  ?>" class="form-control datetimepicker-input" data-target="#creationdate1">
                  <div class="input-group-append" data-target="#creationdate1" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="userlevel">User level</label>
                <select class="select2" name="userlevel">
                  <option value="1" {{ $corporateadmin->user_level == 1 ? 'selected' : '' }}>admin</option>
                  <option value="2" {{ $corporateadmin->user_level == 2 ? 'selected' : '' }}>corporate_admin</option>
                  <option value="3" {{ $corporateadmin->user_level == 3 ? 'selected' : '' }}>premium_user</option>
                  <option value="4" {{ $corporateadmin->user_level == 4 ? 'selected' : '' }}>free_user</option>
                  <option value="5" {{ $corporateadmin->user_level == 5 ? 'selected' : '' }}>guest</option>
                  <option value="6" {{ $corporateadmin->user_level == 6 ? 'selected' : '' }}>coach</option>
                  <option value="7" {{ $corporateadmin->user_level == 7 ? 'selected' : '' }}>corporate_group_admin
                  </option>
                  <option value="8" {{ $corporateadmin->user_level == 8 ? 'selected' : '' }}>corporate_user</option>

                </select>
              </div>
              <div class="form-group">
                <label for="userstatus">User status</label>
                <select class="select2" name="userstatus">
                  <option value="0" {{ $corporateadmin->user_status == 0 ? 'selected' : '' }}>none</option>
                  <option value="1" {{ $corporateadmin->user_status == 1 ? 'selected' : '' }}>allowed</option>
                  <option value="2" {{ $corporateadmin->user_status == 2 ? 'selected' : '' }}>blocked</option>
                  <option value="3" {{ $corporateadmin->user_status == 3 ? 'selected' : '' }}>deleted</option>
                </select>
              </div>
              <div class="form-group">
                <label for="updateraison">Update raison</label>
                <select class="select2" name="updateraison">
                  <option value="0" {{ $corporateadmin->update_raison == 0 ? 'selected' : '' }}>created</option>
                  <option value="1" {{ $corporateadmin->update_raison == 1 ? 'selected' : '' }}>verified</option>
                  <option value="2" {{ $corporateadmin->update_raison == 2 ? 'selected' : '' }}>blocked</option>
                  <option value="3" {{ $corporateadmin->update_raison == 3 ? 'selected' : '' }}>closed</option>
                  <option value="4" {{ $corporateadmin->update_raison == 4 ? 'selected' : '' }}>reset password</option>
                  <option value="5" {{ $corporateadmin->update_raison == 5 ? 'selected' : '' }}>change profile;</option>
                  <option value="6" {{ $corporateadmin->update_raison == 6 ? 'selected' : '' }}>other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="language">Language</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="language" value="english"
                    {{ $corporateadmin->language == 'english' ? 'checked' : '' }} />
                  <label class="form-check-label">English</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="language" value="french"
                    {{ $corporateadmin->language == 'french' ? 'checked' : '' }} />
                  <label class="form-check-label">French</label>
                </div>
              </div>
              <div class="form-group">
                <label for="platform">Platform</label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="platform" value="desktop"
                    {{ $corporateadmin->platform == 'desktop' ? 'checked' : '' }} />
                  <label class="form-check-label">Desktop</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="platform" value="mobile"
                    {{ $corporateadmin->platform == 'mobile' ? 'checked' : '' }} />
                  <label class="form-check-label">Mobile</label>
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>

              </div>
            </div>
            <!-- /.box-body -->
          </form>
          <form action="{{ route('corporateadmin.delete', $corporateadmin->id) }}" method="post"
            enctype="multipart/form-data">
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
