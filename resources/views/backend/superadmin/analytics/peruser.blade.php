<!--Per user -->
<section class="content tab-pane fade" id="custom-content-below-user" role="tabpanel"
  aria-labelledby="custom-content-below-user-tab">

  <div class="container-fluid">
    <div class="btn-group btn-group-toggle toggle_chart_view" data-toggle="buttons">
      <label class="btn btn-primary active">
        <input type="radio" name="view_style" value='table' target_class="peruser_tab_view" autocomplete="off" checked>
        Table
        View
      </label>
      <label class="btn btn-primary">
        <input type="radio" name="view_style" value='chart' target_class="peruser_tab_view" autocomplete="off"> Chart
        View
      </label>
    </div>
  </div>
  <div id="peruser_tab_view_table">
    <div class="container-fluid">
      <button class="btn btn-info btn-generate-pdf peruser_tab_view"
        onclick="generatePDF(this, 'peruser_tab_view_table')">Generate
        PDF</button>
      <button class="btn btn-info btn-generate-pdf peruser_tab_view" onclick="generatePDF(this, 'peruser_tab_view_table')"
        style="display: none">Generate PDF</button>

      <h5 class="pt-pb" style="font-weight: bold">Search user by email</h5>
      <!-- <input class="form-control" type="text" placeholder="email..."><br/> -->
      <!-- <button class="btn btn-primary btn-block">Search..</button> -->
      <div class="form-group">
        <select id="showPeruser" class="form-control select2" style="width: 100%;">
          @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->email }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="container-fluid peruser_tab_view">

      <div id="user_html">
        <h4 class="pt-pb">General user status</h4>
        <div class="card card-primary">

          <div class="card-body">

            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:40%">Email</td>
                  <td>{{ $email }}</td>
                </tr>
                <tr>
                  <td>First name</td>
                  <td>{{ $firstname }}</td>
                </tr>
                <tr>
                  <td>Last name</td>
                  <td>{{ $lastname }}</td>
                </tr>
                <tr>
                  <td>Connection status</td>
                  <td>{{ $con_status }}</td>
                </tr>
                <tr>
                  <td>Account creation date</td>
                  <td>{{ $created_day }}</td>
                </tr>
                <tr>
                  <td>Account creation platform</td>
                  <td>{{ $platform }}</td>
                </tr>
                <tr>
                  <td>Account type</td>
                  <td>{{ $user_level }}</td>
                </tr>
                <tr>
                  <td>Sponsor</td>
                  <td>{{ $sponsor }}</td>
                </tr>
                <tr>
                  <td>Plan starting date</td>
                  <td>{{ $user_start_day }}</td>
                </tr>
                <tr>
                  <td>Plan expiration date</td>
                  <td>{{ $user_end_day }}</td>
                </tr>
                <tr>
                  <td>Language</td>
                  <td>{{ $user_language }}</td>
                </tr>
                <tr>
                  <td>Weekly checks submitted</td>
                  <td>{{ $user_week }}</td>
                </tr>
                <tr>
                  <td>Monthly checks submitted</td>
                  <td>{{ $user_month }}</td>
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
            <input type="text" id="showUser_engage" class="form-control float-right reservation">
          </div>
        </div>
        <div class="card card-primary">

          <div class="card-body">

            <table id="engageUser" class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width:40%">Video views</td>
                  <td>{{ $user_views }}</td>
                </tr>
                <tr>
                  <td>Usage time (minutes)</td>
                  <td>{{ $usage_time }}</td>
                </tr>
                <tr>
                  <td>Video likes</td>
                  <td>{{ $user_likes }}</td>
                </tr>
                <tr>
                  <td>Video comments</td>
                  <td>{{ $user_comments }}</td>
                </tr>
                <tr>
                  <td>Challenges accepted</td>
                  <td>{{ $user_challenges }}</td>
                </tr>
                <tr>
                  <td>Quote likes</td>
                  <td>{{ $quote_likes }}</td>
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
            <input type="text" id="showUser_week" class="form-control float-right reservation">
          </div>
        </div>
        <div class="card card-primary">

          <div class="card-body">

            <table id="weekUser" class="table table-bordered">
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
            <input type="text" id="showUser_month" class="form-control float-right reservation">
          </div>
        </div>
        <div id="monthUser">
          <span>
            The mood score is the average of questions 1 and 2 of the monthly check. The energy score is the
            average of questions 3 and 4. The engagement score is the result of question 5.
          </span>
          <div class="card card-primary">

            <div class="card-body">

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:40%">Well-being score</td>
                    <td>68%</td>
                  </tr>
                  <tr>
                    <td>mood</td>
                    <td>72%</td>
                  </tr>
                  <tr>
                    <td>energy</td>
                    <td>60%</td>
                  </tr>
                  <tr>
                    <td>engagement</td>
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

        <h4 class="pt-pb">Coaching reports</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="far fa-calendar-alt"></i>
              </span>
            </div>
            <input type="text" id="showUser_coaching" class="form-control float-right reservation">
          </div>
        </div>
        <div id="coachingUser">
          <div class="card card-primary">

            <div class="card-body">

              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <td style="width:40%">Coaching sessions</td>
                    <td>{{ $user_coaching }}</td>
                  </tr>
                  <tr>
                    <td>Average coach rating</td>
                    <td>{{ round($user_ave_rates->sum('rating')) }} stars</td>
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
                    <td>{{ round($user_depress) }}%</td>
                  </tr>
                  <tr>
                    <td>Parenting issues</td>
                    <td>{{ round($user_parenting) }}%</td>
                  </tr>
                  <tr>
                    <td>Relationship issues</td>
                    <td>{{ round($user_relation) }}%</td>
                  </tr>
                  <tr>
                    <td>Mourning</td>
                    <td>{{ round($user_mouring) }}%</td>
                  </tr>
                  <tr>
                    <td>Conflictss</td>
                    <td>{{ round($user_conflict) }}%</td>
                  </tr>
                  <tr>
                    <td>Self-confidence</td>
                    <td>{{ round($user_confidence) }}%</td>
                  </tr>
                  <tr>
                    <td>Addictions</td>
                    <td>{{ round($user_addiction) }}%</td>
                  </tr>
                  <tr>
                    <td>Others</td>
                    <td>{{ round($user_others) }}%</td>
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
    @include('backend.superadmin.analytics.peruser_chart')
  </div>

</section>
