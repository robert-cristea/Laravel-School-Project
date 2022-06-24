@extends('backend.layout_coaching')

@section('content')

  <ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
      <a class="nav-link nav-link-3 active" id="custom-content-below-general-tab" data-toggle="pill"
        href="#custom-content-below-general" role="tab" aria-controls="custom-content-below-general"
        aria-selected="true">Per user</a>
    </li>
  </ul>

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <div class="content-wrapper">
    <section class="content">
      <div class="social-box">
        <div class="container-fluid">

          <div class="row">
            <div class="col-lg-12 col-xs-12 text-center">
              <div class="box">
                <div class="row">
                  <div class="col-12 col-md-6">
                    <!-- <i class="fa fa-behance fa-3x" aria-hidden="true"></i>  -->
                    <i class="fa fa-file fa-3x" aria-hidden="true"></i>
                    <div class="box-title">
                      <h3><i class="fa fa-upload" aria-hidden="true"></i> Upload CSV File</h3>
                    </div>
                    <div class="box-text row justify-content-center">
                      <form method="post" class="form-inline" id="uploadcsvseller" name="uploadcsvseller" action="{{route('upload-csv-coaching')}}"
                            enctype="multipart/form-data">
                          {{csrf_field()}}
                        <div class="row">
                          <div class="col-sm-12 col-md-10 mb-2">
                            <div class="mx-3 {{ $errors->has('upload_csv_seller') ? ' has-error' : '' }}">
                              <div class="input-group file-btn">
                                <div class="custom-file">
                                  <input class="custom-file-input" id="upload_csv_seller" type="file"
                                         name="upload_csv_seller" accept=".csv" required>
                                  <label class="custom-file-label" for="upload_csv_seller"
                                         id="upload_template">UPLOAD CSV</label>
                                </div>
                              </div>
                            </div>
                            @if($errors->has('upload_csv_seller'))
                              <span class="help-block">
                                <strong>{{$errors->first('upload_csv_seller')}}</strong>
                            </span>
                            @endif
                          </div>
                          <div class="col-sm-12 col-md-2">
                            <input type="submit" id="csv_upload_btn" value="Import" class="btn btn-primary">
                          </div>
                        </div>


                      </form>

                    </div>
                  </div>
                  <div class="col-12 col-md-6">
                    <i class="fa fa-download fa-3x" aria-hidden="true"></i>
                    <div class="box-title">
                      <h3>  <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Reports</h3>
                    </div>
                    <div class="box-text">
                      <a class="btn btn-primary" href="{{ URL::to('/generate-reports-pdf') }}">Export to PDF</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12 col-xs-12 text-center">
              <div class="box">
                <!-- <i class="fa fa-facebook fa-3x" aria-hidden="true"></i>
                <div class="box-title">
                    <h3>Facebook</h3>
                </div> -->
                <div class="box-text">
                  <div class="date-filter-chart">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                    </span>
                        </div>
                        <input type="text" id="showGeneral_population_chart" class="form-control float-right reservation">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-section">

                        <div class="box-title">
                          <h3 class="chart-title">Population risk distribution</h3>
                        </div>
                        <canvas id="doughnut-chart" width="800" height="450"></canvas>

                        <p class="chart-info">
                          Measure derived from the monthly check results. A wellbeing score below 35 is classified as high
                          risk, between 35 and 65 as moderate risk, and above 65 as low risk
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="chart-section">

                        <div class="box-title">
                          <h3 class="chart-title">Coaching reports</h3>
                        </div>
                        <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="box-btn">

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
{{--  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>--}}
  <script>
      //  Population Calendar
      $(document).ready(function(){

          $('#showGeneral_population_chart').change(function(){
              var date = $(this).val();
              console.log(date);
              if(date !=''){
                  var _token = $('input[name="_token"]').val();
                  $.ajax({
                      type:"POST",
                      url:"/cor_population_general_chart",
                      data:{date:date, _token:_token},
                      success:function(data){
                          console.log("data",data.low_risk);
                          //Doughnut chart
                          new Chart(document.getElementById("doughnut-chart"), {
                              type: 'doughnut',
                              data: {
                                  labels: ["Low risk", "Moderate risk", "High risk"],
                                  datasets: [
                                      {
                                          label: "Population risk distribution",
                                          backgroundColor: ["#51e25cfa", "#eca439fa","#f30104"],
                                          data: [data.low_risk+100,data.moderate_risk+100,data.high_risk+100,]
                                      }
                                  ]
                              },
                              options: {
                                  title: {
                                      display: true,
                                      text: 'Population risk distribution'
                                  }
                              }
                          });
                          //Doughnut chart  end
                      }
                  });
              }
          });
      });


      // Bar chart
      new Chart(document.getElementById("bar-chart-grouped"), {
          type: 'bar',
          data: {
              labels: ["March", "April", "May", "June", "July","August","September"],
              datasets: [
                  {
                      label: "Population (millions)",
                      backgroundColor: ["#da4523", "#f3d91f","#d4902dbf","#da4523","#d4902dbf","#f3d91f","#f3d91f"],
                      data: [2478,526,734,784,433,100,200]
                  },
                  {
                      label: "Population (millions)",
                      backgroundColor: ["#da4523", "#f3d91f","#d4902dbf","#da4523","#d4902dbf","#f3d91f","#f3d91f"],
                      data: [247,526,44,78,433,150,250]
                  }
              ]
          },
          options: {
              legend: { display: false },
              title: {
                  display: true,
                  text: '4,7 average rate of our coachs'
              }
          }
      });
      $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()
          $('.reservation').daterangepicker()
      })
  </script>

  <div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    <section class="content tab-pane fade show active" id="custom-content-below-general" role="tabpanel"
      aria-labelledby="custom-content-below-general-tab">

      <div class="container-fluid">
        @csrf
        <h5 class="pt-pb" style="font-weight: bold">Search user by email</h5>
        <select name="sel_user" id="coaching_report_user" class="form-control select2" style="width: 100%;">
          @foreach ($onlyusers as $onlyuser)
            <option value="{{ $onlyuser->id }}">{{ $onlyuser->email }}</option>
          @endforeach
        </select>

        <h4 class="pt-pb" style="margin-top: 20px">
          Sessions reports
          {{-- <button class="btn btn-success float-right">Import CSV Data</button>
          --}}
        </h4>
        <div class="card card-primary">

          <div class="card-body">
            <div id="show_report_user_html">
              <table class="table table-bordered" id="coaching_report_table">
                <thead>
                  <tr>
                    <td class="add-font" colspan="8">Add session report</td>
                    <td class="right-addbtn" data-toggle="modal" data-target="#modal-report-add">
                      <span>
                        <i class="fa fa-plus"></i>
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <th>Session Date</th>
                    <th>Coach Name</th>
                    <th>First/Last Name</th>
                    <th>Report Date</th>
                    <th>Language</th>
                    <th>Duration</th>
                    <th>Client Feedback</th>
                    <th>Status</th>
                    <th style="width:100px" class="right-editbtn">
                      <span>
                        <i class="fa fa-edit"></i>
                      </span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($first_coaching_reports as $first_coaching_report)
                    <tr>
                      <td>{{ date('d F Y', strtotime($first_coaching_report->session_date)) }}</td>
                      <td>{{ $first_coaching_report->coach_name }}</td>
                      <td>{{ $first_coaching_report->user_first_name }} {{ $first_coaching_report->user_last_name }}</td>
                      <td>{{ date('d F Y', strtotime($first_coaching_report->report_date)) }}</td>

                      <td>
                        @if ($first_coaching_report->language == 1)
                          30 Minutes
                        @elseif ($first_coaching_report->language == 2)
                          60 Minutes
                        @endif
                      </td>
                      <td>
                        @if ($first_coaching_report->language == 1)
                          English
                        @elseif ($first_coaching_report->language == 2)
                          French
                        @endif
                      </td>
                      <td>
                        @if ($first_coaching_report->client_feedbck == 1)
                          Much better
                        @elseif ($first_coaching_report->client_feedbck == 2)
                          Better
                        @elseif ($first_coaching_report->client_feedbck == 3)
                          About the same
                        @elseif ($first_coaching_report->client_feedbck == 4)
                          Worse
                        @elseif ($first_coaching_report->client_feedbck == 5)
                          Much worse
                        @endif
                      </td>
                      <td>
                        @if ($first_coaching_report->status == 1)
                          Done
                        @elseif ($first_coaching_report->status == 2)
                          Non Shown
                        @elseif ($first_coaching_report->status == 3)
                          Rescheduled
                        @elseif ($first_coaching_report->status == 4)
                          Cancelled
                        @endif
                      </td>
                      <td style="width:100px" class="right-editbtn" data-toggle="modal"
                        data-target="#modal-report-edit{{ $first_coaching_report->report_id }}">
                        <span>
                          <i class="fa fa-edit" style="cursor:pointer"></i>
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <!-- coach report add modal -->
              <div class="modal fade" id="modal-report-add">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add session report</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="{{ route('saveCoach') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                          <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $first_user->email }}"
                              readonly>
                          </div>
                          <div class="form-group">
                            <label for="First name">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                              value="{{ $first_user->first_name }}" readonly>
                          </div>
                          <div class="form-group">
                            <label for="Last Name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $first_user->last_name }}"
                              readonly>
                          </div>
                          <label for="session date">Session date</label>
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                            <input type="text" name="session_date" class="form-control datetimepicker-input"
                              data-target="#reservationdate" required>
                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="reason for seassion">Reason for session</label>
                            <select name="reason_session" class="form-control select2" style="width: 100%;">
                              @foreach ($session_reasons as $session_reason)
                                <option value="{{ $session_reason->motif_seance_id }}">{{ $session_reason->seance_name }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="coach">Coach</label>
                            <select name="coach" class="form-control select2" style="width: 100%;">
                              @foreach ($coaches as $coach)
                                <option value="{{ $coach->id }}">{{ $coach->first_name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control select2" style="width: 100%;">
                              <option value="1">done</option>
                              <option value="2">non shown</option>
                              <option value="3">reschuduled</option>
                              <option value="4">cancelled</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <label for="client feedback">Client Feedback</label>
                            <select name="client_feedback" class="form-control select2" style="width: 100%;">

                              <option value="1">much better</option>
                              <option value="2">better</option>
                              <option value="3">about the same</option>
                              <option value="4">worse</option>
                              <option value="5">much worse</option>

                            </select>
                          </div>
                          <div class="form-group">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control" required></textarea>
                          </div>
                          <div class="form-group">
                            <label for="coach rating">Coach rating</label>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio1" value="1"
                                name="customRadio">
                              <label for="customRadio1" class="custom-control-label">1 star</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio2" value="2"
                                name="customRadio">
                              <label for="customRadio2" class="custom-control-label">2 stars</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio3" value="3"
                                name="customRadio">
                              <label for="customRadio3" class="custom-control-label">3 stars</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio4" value="4"
                                name="customRadio">
                              <label for="customRadio4" class="custom-control-label">4 stars</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio5" value="5"
                                name="customRadio">
                              <label for="customRadio5" class="custom-control-label">5 stars</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="Duration">Duration</label>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio6" value="1"
                                name="duration">
                              <label for="customRadio6" class="custom-control-label">30 minutes</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio7" value="2"
                                name="duration">
                              <label for="customRadio7" class="custom-control-label">60 minutes</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="Language">Language</label>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio8" value="1"
                                name="language">
                              <label for="customRadio8" class="custom-control-label">English</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" id="customRadio9" value="2"
                                name="language">
                              <label for="customRadio9" class="custom-control-label">French</label>
                            </div>
                          </div>
                          <div class="form-group">
                            <button type="submit" class="btn btn-success shadow-btn btn-block">Add session report</button>
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



              @foreach ($first_coaching_reports as $first_coaching_report)
                <!-- coach report edit modal -->
                <div class="modal fade" id="modal-report-edit{{ $first_coaching_report->report_id }}">

                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Edit session report</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form role="form" action="{{ route('editCoach') }}" method="POST">
                          @csrf
                          <div class="box-body">
                            <div class="form-group">
                              <input type="hidden" value="{{ $first_coaching_report->user_email }}" name="user_email">
                              <input type="hidden" name="report_id" value="{{ $first_coaching_report->report_id }}" />
                            </div>
                            <div class="form-group">
                              <label for="Email">Email</label>
                              <input type="text" name="email" class="form-control"
                                value="{{ $first_coaching_report->user_email }}" readonly>
                            </div>
                            <div class="form-group">
                              <label for="First name">First Name</label>
                              <input type="text" name="first_name" class="form-control"
                                value="{{ $first_coaching_report->user_first_name }}" readonly>
                            </div>
                            <div class="form-group">
                              <label for="Last Name">Last Name</label>
                              <input type="text" name="last_name" class="form-control"
                                value="{{ $first_coaching_report->user_last_name }}" readonly>
                            </div>
                            <div class="form-group">
                              <label for="session date">Session date</label>

                              <div class="input-group date" id="reservationdate{{ $first_coaching_report->report_id }}"
                                data-target-input="nearest">

                                <input type="text" value="<?php
                                  $date = $first_coaching_report->session_date;
                                  $date = explode('-', $date);
                                  $y = $date[0];
                                  $m = $date[1];
                                  $d = $date[2];
                                  $date = implode('/', [$m, $d, $y]);
                                  echo $date;
                                  ?>" name="session_date" class="form-control datetimepicker-input"
                                  data-target="#reservationdate{{ $first_coaching_report->report_id }}" required>
                                <div class="input-group-append"
                                  data-target="#reservationdate{{ $first_coaching_report->report_id }}"
                                  data-toggle="datetimepicker">
                                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                              </div>

                            </div>
                            <div class="form-group">
                              <label for="reason for seassion">Reason for session</label>
                              <select name="reason_session" class="form-control select2" style="width: 100%;">
                                @foreach ($session_reasons as $session_reason)
                                  <option value="{{ $session_reason->motif_seance_id }}"
                                    {{ $first_coaching_report->motif_seance_id == $session_reason->motif_seance_id ? 'selected' : '' }}>
                                    {{ $session_reason->seance_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="coach">Coach</label>
                              <select name="coach" class="form-control select2" style="width: 100%;">
                                @foreach ($coaches as $coach)
                                  <option value="{{ $coach->id }}"
                                    {{ $first_coaching_report->coach_name == $coach->first_name ? 'selected' : '' }}>
                                    {{ $coach->first_name }}
                                  </option>
                                @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="status">Status</label>
                              <select name="status" class="form-control select2" style="width: 100%;">
                                <option value="1" {{ $first_coaching_report->status == 1 ? 'selected' : '' }}>done
                                </option>
                                <option value="2" {{ $first_coaching_report->status == 2 ? 'selected' : '' }}>non shown
                                </option>
                                <option value="3" {{ $first_coaching_report->status == 3 ? 'selected' : '' }}>reschuduled
                                </option>
                                <option value="4" {{ $first_coaching_report->status == 4 ? 'selected' : '' }}>cancelled
                                </option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="client feedback">Client Feedback</label>
                              <select name="client_feedback" class="form-control select2" style="width: 100%;">

                                <option value="1" {{ $first_coaching_report->client_feedbck == 1 ? 'selected' : '' }}>much
                                  better</option>
                                <option value="2" {{ $first_coaching_report->client_feedbck == 2 ? 'selected' : '' }}>
                                  better</option>
                                <option value="3" {{ $first_coaching_report->client_feedbck == 3 ? 'selected' : '' }}>
                                  about the same</option>
                                <option value="4" {{ $first_coaching_report->client_feedbck == 4 ? 'selected' : '' }}>
                                  worse</option>
                                <option value="5" {{ $first_coaching_report->client_feedbck == 5 ? 'selected' : '' }}>much
                                  worse</option>

                              </select>
                            </div>
                            <div class="form-group">
                              <label for="note">Note</label>
                              <textarea name="note" class="form-control"
                                required>{{ $first_coaching_report->note }}</textarea>
                            </div>
                            <div class="form-group">
                              <label for="coach rating">Coach rating</label>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio1{{ $first_coaching_report->report_id }}" value="1" name="customRadio"
                                  {{ $first_coaching_report->rating == 1 ? 'checked' : '' }}>
                                <label for="customRadio1{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">1 star</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio2{{ $first_coaching_report->report_id }}" value="2" name="customRadio"
                                  {{ $first_coaching_report->rating == 2 ? 'checked' : '' }}>
                                <label for="customRadio2{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">2 stars</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio3{{ $first_coaching_report->report_id }}" value="3" name="customRadio"
                                  {{ $first_coaching_report->rating == 3 ? 'checked' : '' }}>
                                <label for="customRadio3{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">3 stars</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio4{{ $first_coaching_report->report_id }}" value="4" name="customRadio"
                                  {{ $first_coaching_report->rating == 4 ? 'checked' : '' }}>
                                <label for="customRadio4{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">4 stars</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio5{{ $first_coaching_report->report_id }}" value="5" name="customRadio"
                                  {{ $first_coaching_report->rating == 5 ? 'checked' : '' }}>
                                <label for="customRadio5{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">5 stars</label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="Duration">Duration</label>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio6{{ $first_coaching_report->report_id }}" value="1" name="duration"
                                  {{ $first_coaching_report->duration == 1 ? 'checked' : '' }}>
                                <label for="customRadio6{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">30 minutes</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio7{{ $first_coaching_report->report_id }}" value="2" name="duration"
                                  {{ $first_coaching_report->duration == 2 ? 'checked' : '' }}>
                                <label for="customRadio7{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">60 minutes</label>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="Language">Language</label>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio8{{ $first_coaching_report->report_id }}" value="1" name="language"
                                  {{ $first_coaching_report->language == 1 ? 'checked' : '' }}>
                                <label for="customRadio8{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">English</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio"
                                  id="customRadio9{{ $first_coaching_report->report_id }}" value="2" name="language"
                                  {{ $first_coaching_report->language == 2 ? 'checked' : '' }}>
                                <label for="customRadio9{{ $first_coaching_report->report_id }}"
                                  class="custom-control-label">French</label>
                              </div>
                            </div>
                            <div class="form-group">
                              <button type="submit" class="btn btn-success shadow-btn btn-block">Save changes</button>
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </form>
                        <form action="{{ route('coaching.delete', $first_coaching_report->report_id) }}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-red shadow-btn btn-block actionDelete">Remove
                            admin</button>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              @endforeach
              <!-- /.modal -->
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
  </div>



@endsection
