<!--Per client -->
<section class="content tab-pane fade" id="custom-content-below-client" role="tabpanel"
  aria-labelledby="custom-content-below-client-tab">

  <div class="container-fluid">
    <div class="btn-group btn-group-toggle toggle_chart_view" data-toggle="buttons">
      <label class="btn btn-primary active">
        <input type="radio" name="view_style" value='table' target_class="perclient_tab_view" autocomplete="off"
          checked>
        Table
        View
      </label>
      <label class="btn btn-primary">
        <input type="radio" name="view_style" value='chart' target_class="perclient_tab_view" autocomplete="off"> Chart
        View
      </label>
    </div>
  </div>

  <div id="perclient_tab_view_table">
    <div class="container-fluid" id="perclient_tab_view_table">
      <button class="btn btn-info btn-generate-pdf perclient_tab_view"
        onclick="generatePDF(this, 'perclient_tab_view_table')">Generate
        PDF</button>
      <button class="btn btn-info btn-generate-pdf perclient_tab_view" style="display: none"
        onclick="generatePDF(this, 'perclient_tab_view_table')">Generate PDF</button>

      <h5 class="pt-pb" style="font-weight: bold">Select client</h5>
      <div class="form-group">
        @csrf
        <select class="form-control select2" id="corporate_sel" style="width: 100%;">
          @foreach ($corporate_clients as $corporate_client)
            <option value="{{ $corporate_client->corporate_client_id }}">{{ $corporate_client->corporate_name }}
            </option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="container-fluid perclient_tab_view">

      <div id="client_html">
        <h4 class="pt-pb">General client status</h4>
        <div class="card card-primary">

          <div class="card-body">

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:40%">Plan starting date</td>
                  <td>{{ $start_date }}</td>
                </tr>
                <tr>
                  <td>Plan expiration date</td>
                  <td>{{ $end_date }}</td>
                </tr>
                <tr>
                  <td>Number of licenses</td>
                  <td>{{ $licence_num }}</td>
                </tr>
                <tr>
                  <td>Enrolled users</td>
                  <td>{{ $enrolled_users }}</td>
                </tr>
                <tr>
                  <td>Online users</td>
                  <td>{{ $cor_online_users }}</td>
                </tr>
                <tr>
                  <td>French language</td>
                  <td>{{ round($cor_fr_users_pro, 2) }}%</td>
                </tr>
                <tr>
                  <td>English language</td>
                  <td>{{ round($cor_en_users_pro, 2) }}%</td>
                </tr>
                <tr>
                  <td>Accounts created on mobile</td>
                  <td>{{ round($cor_mobile_pro, 2) }}%</td>
                </tr>
                <tr>
                  <td>Accounts created on the web</td>
                  <td>{{ round($cor_web_pro, 2) }}%</td>
                </tr>
                <tr>
                  <td>Weekly checks submitted</td>
                  <td>{{ $cor_weekly }}</td>
                </tr>
                <tr>
                  <td>Monthly checks submitted</td>
                  <td>14</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card -->
        </div>

        <h4 class="pt-pb">User engagement status</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="showClient_engage" class="form-control float-right reservation">
          </div>
        </div>
        <div class="card card-primary">

          <div class="card-body">

            <table id="engageClient" class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:40%">Video views</td>
                  <td>{{ $cor_video_views }}</td>
                </tr>
                <tr>
                  <td>Video likes</td>
                  <td>{{ $cor_video_likes }}</td>
                </tr>
                <tr>
                  <td>Video comments</td>
                  <td>{{ $cor_video_comments }}</td>
                </tr>
                <tr>
                  <td>Challenges accepted</td>
                  <td>{{ $cor_video_challenges }}</td>
                </tr>
                <tr>
                  <td>Quote likes</td>
                  <td>{{ $cor_quotes }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card -->
        </div>

        <h4 class="pt-pb">Weekly check result</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="showClient_week" class="form-control float-right reservation">
          </div>
        </div>
        <div class="card card-primary">

          <div class="card-body">

            <table id="weekClient" class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:40%">Overall average</td>
                  <td>3/5</td>
                </tr>
                <tr>
                  <td>Workload average</td>
                  <td>2/3</td>
                </tr>
                <tr>
                  <td>Stress average</td>
                  <td>3/3</td>
                </tr>
                <tr>
                  <td>Energy average</td>
                  <td>2/3</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card -->
        </div>

        <h4 class="pt-pb">Monthly check result</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="showClient_month" class="form-control float-right reservation">
          </div>
        </div>
        <div id="monthClient">
          <span>
            The mood score is the average of questions 1 and 2 of the monthly check. The energy score is the
            average of questions 3 and 4. The engagement score is the result of question 5.
          </span>
          <div class="card card-primary">

            <div class="card-body">

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:40%">Well-being score average</td>
                    <td>68%</td>
                  </tr>
                  <tr>
                    <td>Average mood</td>
                    <td>72%</td>
                  </tr>
                  <tr>
                    <td>Average energy</td>
                    <td>60%</td>
                  </tr>
                  <tr>
                    <td>Average engagement</td>
                    <td>65%</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </div>
          <h5 class="pt-pb" style="font-weight: bold">Main causes of stress</h5>
          <span>
            Causes of stress are sourced from question 6 of the monthly check.
          </span>
          <div class="card card-primary">

            <div class="card-body">

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:40%">Current project not engaging</td>
                    <td>32%</td>
                  </tr>
                  <tr>
                    <td>Overloaded with work</td>
                    <td>31%</td>
                  </tr>
                  <tr>
                    <td>Frustrated with colleagues</td>
                    <td>24%</td>
                  </tr>
                  <tr>
                    <td>Lacking support to do the job</td>
                    <td>22%</td>
                  </tr>
                  <tr>
                    <td>Family issues</td>
                    <td>21%</td>
                  </tr>
                  <tr>
                    <td>Unclear expectations</td>
                    <td>20%</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </div>
        </div>

        <h4 class="pt-pb">Population risk distribution</h4>
        <span>
          Population risk distribution is a measure derived from the monthly checks results. A well-being score
          below 35 is classified as high risk, between 35 et 65 as moderate risk, and above 65 as low risk.
        </span>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="showClient_population" class="form-control float-right reservation">
          </div>
        </div>
        <div class="card card-primary">

          <div class="card-body">

            <table id="populationClient" class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:40%">High risk</td>
                  <td>32%</td>
                </tr>
                <tr>
                  <td>Moderate risk</td>
                  <td>31%</td>
                </tr>
                <tr>
                  <td>Low risk</td>
                  <td>24%</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card -->
        </div>


        <h4 class="pt-pb">Coaching reports</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="showClient_coaching" class="form-control float-right reservation">
          </div>
        </div>
        <div id="coachingClient">
          <div class="card card-primary">

            <div class="card-body">

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:40%">Coaching sessions</td>
                    <td>{{ $cor_coaching_session }}</td>
                  </tr>
                  <tr>
                    <td>Average coach rating</td>
                    <td>

                      {{ $cor_ave_coaching->average('rating') }} stars


                    </td>
                  </tr>
                  <tr>
                    <td>Returning users</td>
                    <td>50%</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </div>

          <h5 class="pt-pb" style="font-weight: bold">Reasons for sessions</h5>
          <div class="card card-primary">

            <div class="card-body">

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:40%">Depression</td>
                    <td>{{ round($cor_depression) }}%</td>
                  </tr>
                  <tr>
                    <td>Parenting issues</td>
                    <td>{{ round($cor_parenting) }}%</td>
                  </tr>
                  <tr>
                    <td>Relationship issues</td>
                    <td>{{ round($cor_relationship) }}%</td>
                  </tr>
                  <tr>
                    <td>Mourning</td>
                    <td>{{ round($cor_mourning) }}%</td>
                  </tr>
                  <tr>
                    <td>Conflictss</td>
                    <td>{{ round($cor_conflicts) }}%</td>
                  </tr>
                  <tr>
                    <td>Self-confidence</td>
                    <td>{{ round($cor_confidence) }}%</td>
                  </tr>
                  <tr>
                    <td>Addictions</td>
                    <td>{{ round($cor_addictions) }}%</td>
                  </tr>
                  <tr>
                    <td>Others</td>
                    <td>{{ round($cor_others) }}%</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </div>


    {{-- Chart View --}}
    @include('backend.superadmin.analytics.perclient_chart')
  </div>

</section>
