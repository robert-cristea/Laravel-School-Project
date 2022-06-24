@extends('backend.layout_notification')

@section('content')

<ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
        <a class="nav-link nav-link-3 active" id="custom-content-below-general-tab" data-toggle="pill" href="#custom-content-below-general" role="tab" aria-controls="custom-content-below-general" aria-selected="true">Notifications</a>
    </li>
</ul>
<div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    <section class="content tab-pane fade show active" id="custom-content-below-general" role="tabpanel" aria-labelledby="custom-content-below-general-tab">
    
        <div class="container-fluid">
            <h4 class="pt-pb">Send notifications</h4>
            <button class="btn btn-red btn-block" data-toggle="modal" data-target="#modal-notification-add">New notification</button>
            
            <h4 class="pt-pb">Notification history</h4>
            <div class="card card-primary">
            
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tbody>
                        @foreach( $notifications as $row )
                            <tr>
                                <td style="width:90%">
                                    <li class="item-none">Welcome {{$row->notification_name}}</li>
                                    <li class="item-none">{{  date('d F Y', strtotime($row->date)) }}</li>
                                </td>
                                <td class="right-editbtn" data-toggle="modal" data-target="#modal-notification-view{{$row->notification_id}}">
                                    <span>
                                        <i class="fa fa-eye" style="cursor:pointer"></i>
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
</div>


<!-- new notification add modal -->
<div class="modal fade" id="modal-notification-add">
<form action="{{ route('addNotify') }}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New notification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                <div class="box-body">
                    <div class="form-group">
                        <label for="session date">Name(only used for dashboard history)</label>
                        <input type="text" class="form-control" id="notification_name" name="notification_name" required>
                    </div>
                    <div class="form-group">
                        <h4>Notification message</h4>
                        <span>Will be sent as push notification if app notificatios are enabled. Maximum of 140 characters</span>
                        <label for="reason for seassion">English(0/140)</label>
                        <input type="text" class="form-control" id="content_english" name="content_english" required>
                    </div>
                    <div class="form-group">
                        <label for="coach">French(0/140)</label>
                        <input type="text" class="form-control" id="content_frensh" name="content_frensh" required>
                    </div>
                    <div class="form-group">
                        <label for="coach rating">Target</label>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="target1" name="target" value="9" checked="">
                            <label for="target1" class="custom-control-label">All users</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="target2" name="target" value="2">
                            <label for="target2" class="custom-control-label">Corporate users</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="target3" name="target" value="1">
                            <label for="target3" class="custom-control-label">Premium users</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" id="target4" name="target" value="0">
                            <label for="target4" class="custom-control-label">Freeuser & guests</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-control select2" name="sponsor" style="width: 100%;">
                           @foreach ($corporate_clients as $corporate_client)
                               <option value="{{ $corporate_client->corporate_client_id }}">{{ $corporate_client->corporate_name }}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success shadow-btn btn-block">Create new notification</button>
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    </form>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- notification view modal -->
@foreach( $notifications as $row )
<div class="modal fade" id="modal-notification-view{{$row->notification_id}}" role="dialog">
     <form action="{{ route('deleteNotify', $row->notification_id) }}" method="delete" id="form{{ $row->notification_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View notification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                <div class="box-body">
                <?php
                     $userinf=App\User::select('*')->where('id',$row->user_id)->first();   
                    
                ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td>name</td>
                            <td>{{$row->notification_name}}</td>
                            </tr>
                            <tr>
                                <td>date</td>
                            <td>{{  date('d F Y', strtotime($row->date)) }}</td>
                            </tr>
                            <tr>
                                <td>Sent by</td>
                                <td>{{$userinf->first_name}}</td>
                            </tr>
                            <tr>
                                <td>Target</td>
                                <?php
                                
                                     switch ($row->target) {
                                        case 0:
                                        $target="Freeuser & Guests";
                                            break;
                                        case 1:
                                        $target="Premium User";
                                            break;
                                        case 2:
                                        $target="Corporate users";
                                            break;
                                        case 9:
                                        $target="All User";
                                            break;
                                    }
                                ?>
                            <td>{{$target}} sponsored by {{$row->notification_name}}</td>
                            </tr>
                            <tr>
                                <td>English message (27 chars)</td>
                            <td>{{$row->content_english}}</td>
                            </tr>
                            <tr>
                                <td>Message en français (35 chars)</td>
                                <td>{{$row->content_frensh}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                    
                            {{-- @csrf
                            @method('DELETE') --}}
                          
                        {{-- <input type="hidden" name="notification_id" id="notification_id" value={{$row->notification_id}}/>  --}}
                        <a href="{{ route('deleteNotify', $row->notification_id) }}" class="btn btn-red shadow-btn btn-block actionDelete">Remove from history</a>
                    
                    </div>
                </div>
                <!-- /.box-body -->
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
       
    </div>
     </form>
<!-- /.modal-dialog -->
</div>
@endforeach
<!-- /.modal -->
@endsection