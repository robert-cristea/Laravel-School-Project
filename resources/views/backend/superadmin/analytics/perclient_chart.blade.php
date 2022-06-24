<div class="container-fluid perclient_tab_view chart_view" id="perclient_tab_view_chart" style="display: none">
  {{-- <button class="btn btn-info btn-generate-pdf"
    onclick="generatePDF(this, 'perclient_tab_view_chart')">Generate PDF</button> --}}
  <h4 class="pt-pb">General App Stats</h4>
  <div class="card card-primary">
    <div class="card-body">
      <div class="row general-analytics-first-row">
        <div class="col-md-4"><span>{{ $enrolled_users }}</span> <span> enrolled users</span></div>
        <div class="col-md-4"><span>{{ $licence_num }}</span> <span> licenses</span></div>
        <div class="col-md-4"><span>28%</span> <span> use rate</span></div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-body">
              <div><span>{{ round($french_users_pro, 2) }}%</span> <span> use the App in French</span></div>
              <div><span>{{ round($english_users_pro, 2) }}%</span> <span> use the App in English</span></div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-body">
              <div><span>{{ $cor_weekly }}</span> <span> weekly checks submitted</span></div>
              <div><span>{{ $month_checks }}</span> <span> montly checks submitted</span></div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6"><span>{{ $cor_video_views }}</span> <span> videos viewed</span></div>
                <div class="col-md-6"><span>{{ $cor_video_comments }}</span> <span> interactions</span></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
      <input type="text" id="showClient_week_chart" class="form-control float-right reservation">
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="weekly-check-chart_wrapper">
            <canvas id="overall_chart"></canvas>
            <div>Overall average: <span></span></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="weekly-check-chart_wrapper">
            <canvas id="stress_chart"></canvas>
            <div>Overall average: <span></span></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="weekly-check-chart_wrapper">
            <canvas id="workload_chart"></canvas>
            <div>Overall average: <span></span></div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="weekly-check-chart_wrapper">
            <canvas id="energy_chart"></canvas>
            <div>Overall average: <span></span></div>
          </div>
        </div>
      </div>
      <h5 style="margin-top: 15px">These scores are the overall average of the weekly check on App that measures how
        was the overall week, the
        stress, workload and energy level of the team</h5>
    </div>
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
      <input type="text" id="showClient_month_chart" class="form-control float-right reservation">
    </div>
  </div>
  <div id="monthClientChart">
    <div class="card card-primary">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="monthly-check-chart-wrapper">
              <canvas id="month_overall_chart"></canvas>
              <div style="background-color: coral;">WELLBEING AVERAGE SCORE</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="monthly-check-chart-wrapper">
              <canvas id="month_mood_chart"></canvas>
              <div>MOOD AVERAGE SCORE</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="monthly-check-chart-wrapper">
              <canvas id="month_energy_chart"></canvas>
              <div>ENERGY AVERAGE SCORE</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="monthly-check-chart-wrapper">
              <canvas id="month_engagement_chart"></canvas>
              <div>ENGAGEMENT AVERAGE SCORE</div>
            </div>
          </div>
        </div>

        <h5 style="margin-top: 15px">
          These scores out of 100 are measured based on the World Health Organisation wellbeing questionnaire
        </h5>
        <p>Wellbeing Range: 0-27=very low, 28-49=low, 50-70=average, 71-85=high, 86-100=very high</p>
      </div>
    </div>
  </div>

  <h5 class="pt-pb" style="font-weight: bold">Main causes of stress</h5>
  <span>
    Causes of stress are sourced from question 6 of the monthly check.
  </span>
  <div class="card card-primary">
    <div class="card-body" id="main_causes_table">
    </div>
    <!-- /.card -->
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
      <input type="text" id="showClient_population_chart" class="form-control float-right reservation">
    </div>
  </div>
  <div class="card card-primary">
    <div class="card-body">
      <div class="">
        <canvas id="population_risk"></canvas>
        <h5 style="margin-top: 15px">
          Measure derived from the monthly check results. A wellbeing score below 35 is classified as high risk, between
          35 and 65 as moderate risk, and above 65 as low risk
        </h5>
      </div>
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
      <input type="text" id="showClient_coaching_chart" class="form-control float-right reservation">
    </div>
  </div>
  <div>
    <div class="card card-primary">
      <div class="card-body">
        <canvas id="coaching_report_chart"></canvas>
      </div>
    </div>
  </div>

</div>
