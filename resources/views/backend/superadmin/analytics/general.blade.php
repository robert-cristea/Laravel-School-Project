<section class="content tab-pane fade show active" id="custom-content-below-general" role="tabpanel"
  aria-labelledby="custom-content-below-general-tab">
  <div class="container-fluid">
    <div class="btn-group btn-group-toggle toggle_chart_view" data-toggle="buttons">
      <label class="btn btn-primary active">
        <input type="radio" name="view_style" value='table' target_class="general_tab_view" autocomplete="off" checked>
        Table
        View
      </label>
      <label class="btn btn-primary">
        <input type="radio" name="view_style" value='chart' target_class="general_tab_view" autocomplete="off"> Chart
        View
      </label>
    </div>
  </div>

  <div id="elementH"></div>

  <div class="container-fluid general_tab_view" id="general_tab_view_table">
    <button class="btn btn-info btn-generate-pdf" onclick="generatePDF(this, 'general_tab_view_table')">Generate
      PDF</button>

    <h4 class="pt-pb">General status</h4>
    <div class="card card-primary">

      <div class="card-body">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width:40%">Total registered accounts</td>
              <td>{{ $registered_users }}</td>
            </tr>
            <tr>
              <td>Online users</td>
              <td>{{ $online_users }}</td>
            </tr>
            <tr>
              <td>Free accounts</td>
              <td>{{ $free_accounts }}</td>
            </tr>
            <tr>
              <td>Premium accounts</td>
              <td>{{ $premium_accounts }}</td>
            </tr>
            <tr>
              <td>Corporate accounts</td>
              <td>{{ $corporate_accounts }}</td>
            </tr>
            <tr>
              <td>French language</td>
              <td>{{ round($french_users_pro) }}%</td>
            </tr>
            <tr>
              <td>English language</td>
              <td>{{ round($english_users_pro) }}%</td>
            </tr>
            <tr>
              <td>Accounts created on mobile</td>
              <td>{{ round($mobile_pro) }}%</td>
            </tr>
            <tr>
              <td>Accounts created on the web</td>
              <td>{{ round($desktop_pro) }}%</td>
            </tr>
            <tr>
              <td>Weekly checks submitted</td>
              <td>{{ $week_checks }}</td>
            </tr>
            <tr>
              <td>Monthly checks submitted</td>
              <td>{{ $month_checks }}</td>
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
        <input type="text" id="showGeneral_engage" class="form-control float-right reservation">
      </div>
    </div>
    <div class="card card-primary">

      <div class="card-body" id="engageGeneral">

        <table class="table table-bordered">
          <tbody>
            <tr>
              <td style="width:40%">Video views</td>
              <td>{{ $video_views }}</td>
            </tr>
            <tr>
              <td>Video likes</td>
              <td>{{ $video_likes }}</td>
            </tr>
            <tr>
              <td>Video comments</td>
              <td>{{ $video_comments }}</td>
            </tr>
            <tr>
              <td>Challenges accepted</td>
              <td>{{ $challenges_accepted }}</td>
            </tr>
            <tr>
              <td>Quote likes</td>
              <td>{{ $quotes }}</td>
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
        <input type="text" id="showGeneral_week" class="form-control float-right reservation">
      </div>
    </div>
    <div class="card card-primary">

      <div class="card-body">

        <table id="weekGeneral" class="table table-bordered">
          <tbody>
            <tr>
              <td style="width:40%">Overall average</td>
              <td>
                {{ (round($week_progress->average('workload_level'), 2) + round($week_progress->average('stress_level'), 2) + round($week_progress->average('energy_level'), 2)) / 3 }}/5
              </td>
            </tr>
            <tr>
              <td>Workload average</td>
              <td>{{ round($week_progress->average('workload_level'), 2) }}/5</td>
            </tr>
            <tr>
              <td>Stress average</td>
              <td>{{ round($week_progress->average('stress_level'), 2) }}/5</td>
            </tr>
            <tr>
              <td>Energy average</td>
              <td>{{ round($week_progress->average('energy_level'), 2) }}/5</td>
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
        <input type="text" id="showGeneral_month" class="form-control float-right reservation">
      </div>
    </div>
    <div id="monthGeneral">
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
                <td>{{ round($all_checks->average('percent'), 2) }}%
                </td>
              </tr>
              <tr>
                <td>Average mood</td>
                <td>{{ (round($all_checks->average('QA1'), 2) + round($all_checks->average('QA2'), 2)) * 10 }}%
                </td>
              </tr>
              <tr>
                <td>Average energy</td>
                <td>{{ (round($all_checks->average('QA3'), 2) + round($all_checks->average('QA4'), 2)) * 10 }}%
                </td>
              </tr>
              <tr>
                <td>Average engagement</td>
                <td>{{ round($all_checks->average('QA5'), 2) * 20 }}%
                </td>
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
        <input type="text" id="showGeneral_population" class="form-control float-right reservation">
      </div>
    </div>
    <div class="card card-primary">

      <div class="card-body">

        <table id="populationGeneral" class="table table-bordered">
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
        <input type="text" id="showGeneral_coaching" class="form-control float-right reservation">
      </div>
    </div>
    <div id="coachingGeneral">
      <div class="card card-primary">

        <div class="card-body">

          <table class="table table-bordered">
            <tbody>
              <tr>
                <td style="width:40%">Coaching sessions</td>
                <td>{{ $coaching_sessions }}</td>
              </tr>
              <tr>
                <td>Average coach rating</td>
                <td>{{ round($average_coaching_rates->average('rating')) }} stars</td>
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
                <td>{{ round($depression) }}%</td>
              </tr>
              <tr>
                <td>Parenting issues</td>
                <td>{{ round($parenting_issues) }}%</td>
              </tr>
              <tr>
                <td>Relationship issues</td>
                <td>{{ round($relationship_issues) }}%</td>
              </tr>
              <tr>
                <td>Mourning</td>
                <td>{{ round($mourning) }}%</td>
              </tr>
              <tr>
                <td>Conflictss</td>
                <td>{{ round($conflicts) }}%</td>
              </tr>
              <tr>
                <td>Self-confidence</td>
                <td>{{ round($self_confidence) }}%</td>
              </tr>
              <tr>
                <td>Addictions</td>
                <td>{{ round($addictions) }}%</td>
              </tr>
              <tr>
                <td>Others</td>
                <td>{{ round($others) }}%</td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- /.card -->
      </div>
    </div>

  </div>

  {{-- Chart View --}}
  @include('backend.superadmin.analytics.general_chart')


</section>
