@extends('backend.layout_analytics1')

@section('content')
<ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
        <a class="nav-link nav-link-3 active" id="custom-content-below-general-tab" data-toggle="pill" href="#custom-content-below-general" role="tab" aria-controls="custom-content-below-general" aria-selected="true">General</a>
    </li>
    <li class="nav-item nav-item-5 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-client-tab" data-toggle="pill" href="#custom-content-below-client" role="tab" aria-controls="custom-content-below-client" aria-selected="false">Per team</a>
    </li>
</ul>
<div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    <section class="content tab-pane fade show active" id="custom-content-below-general" role="tabpanel" aria-labelledby="custom-content-below-general-tab">
    
        <div class="container-fluid">
            <h4 class="pt-pb">General status</h4>
            <div class="card card-primary">
                
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:40%">Plan starting date</td>
                                <td>{{ $plan_start }}</td>
                            </tr>
                            <tr>
                                <td>Plan expiration date</td>
                                <td>{{ $plan_end }}</td>
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
                                <td>{{ $online_users }}</td>
                            </tr>
                            <tr>
                                <td>French language</td>
                                <td>{{ $fr_users_pro }}%</td>
                            </tr>
                            <tr>
                                <td>English language</td>
                                <td>{{ $en_users_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Accounts created on mobile</td>
                                <td>{{ $mobile_acc_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Accounts created on the web</td>
                                <td>{{ $desktop_acc_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Weekly checks submitted</td>
                                <td>{{ $weekly_checks }}</td>
                            </tr>
                            <tr>
                                <td>Monthly checks submitted</td>
                                <td>{{ $monthly_checks }}</td>
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
                    <input type="text" id="corGeneral_engage" class="form-control float-right reservation">
                </div>
            </div>
                    
            <table id="cor_engageGeneral" class="table table-bordered">
                <tbody>
                    <tr class="white-b">
                        <td style="width:40%">Video views</td>
                        <td>{{ $video_views }}</td>
                    </tr>
                </tbody>
            </table>

            <h4 class="pt-pb">Weekly check result</h4>
            <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" id="corGeneral_week" class="form-control float-right reservation">
                </div>
            </div>
                    
                    <table id="cor_weekGeneral" class="table table-bordered white-b">
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

            <h4 class="pt-pb">Monthly check result</h4>
            <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" id="corGeneral_month" class="form-control float-right reservation">
                </div>
            </div>
            <div id="cor_monthGeneral">
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
                                    <td>71%</td>
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
                    <input type="text" id="corGeneral_population" class="form-control float-right reservation">
                </div>
            </div>
            <div class="card card-primary">
                
                <div class="card-body">
                    
                    <table id="cor_populationGeneral" class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:40%">High risk</td>
                                <td>27%</td>
                            </tr>
                            <tr>
                                <td>Moderate risk</td>
                                <td>40%</td>
                            </tr>
                            <tr>
                                <td>Low risk</td>
                                <td>33%</td>
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
                    <input type="text" id="corGeneral_coaching" class="form-control float-right reservation">
                </div>
            </div>
            <div id="cor_coachingGeneral">
                <div class="card card-primary">
                    
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Coaching sessions</td>
                                    <td>{{ $coaching_session }}</td>
                                </tr>
                                <tr>
                                    <td>Average coach rating</td>
                                    <td>
                                
                                    {{ round($coachings->average('rating')) }} stars
                                
                                    </td>
                                </tr>
                                <tr>
                                    <td>Returning users</td>
                                    <td>{{ $returning_user_pro }}%</td>
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
                                    <td>{{ $depression_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Parenting issues</td>
                                    <td>{{ $parenting_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Relationship issues</td>
                                    <td>{{ $relationship_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Mourning</td>
                                    <td>{{ $mouring_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Conflictss</td>
                                    <td>{{ $conflict_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Self-confidence</td>
                                    <td>{{ $confidence_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Addictions</td>
                                    <td>{{ $addiction_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td>{{ $other_pro }}%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card -->
                </div>
            </div>


        </div>
    </section>


    <!-- client -->
    <section class="content tab-pane fade" id="custom-content-below-client" role="tabpanel" aria-labelledby="custom-content-below-client-tab">
        <div class="container-fluid">
            <h5 class="pt-pb" style="font-weight: bold">Select team</h5>
            <div class="form-group">
                @csrf
                <select id="showGroup" class="form-control select2" style="width: 100%;">
                    @foreach($groups as $group)
                    <option value="{{ $group->corporate_group_admin_id }}">{{ $group->group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="group_html">
                <h4 class="pt-pb">Team status</h4>
                <div class="card card-primary">
                    
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Members</td>
                                    <td>{{ $team_members }}</td>
                                </tr>
                                <tr>
                                    <td>Online users</td>
                                    <td>{{ $team_online_users }}</td>
                                <tr>
                                    <td>French language</td>
                                    <td>{{ $team_fr_users_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>English language</td>
                                    <td>{{ $team_en_users_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Accounts created on mobile</td>
                                    <td>{{ $team_mobile_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Accounts created on the web</td>
                                    <td>{{ $team_desktop_pro }}%</td>
                                </tr>
                                <tr>
                                    <td>Weekly checks submitted</td>
                                    <td>{{ $team_week }}</td>
                                </tr>
                                <tr>
                                    <td>Monthly checks submitted</td>
                                    <td>{{ $team_month }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card --> 
                </div>

                <h4 class="pt-pb">Team engagement status</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="teamGeneral_engage" class="form-control float-right reservation">
                    </div>
                </div>
                        
                <table id="team_engageGeneral" class="table table-bordered white-b">
                    <tbody>
                        <tr>
                            <td style="width:40%">Video views</td>
                            <td>{{ $team_v_views }}</td>
                        </tr>
                    </tbody>
                </table>

                <h4 class="pt-pb">Team weekly check results</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="teamGeneral_week" class="form-control float-right reservation">
                    </div>
                </div>
                        
                <table id="team_weekGeneral" class="table table-bordered white-b">
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

                <h4 class="pt-pb">Team monthly check result</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="teamGeneral_month" class="form-control float-right reservation">
                    </div>
                </div>
                <div id="team_monthGeneral">
                    <span>
                        The mood score is the average of questions 1 and 2 of the monthly check. The energy score is the
                        average of questions 3 and 4. The engagement score is the result of question 5.
                    </span>
                            
                    <table class="table table-bordered white-b">
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

                    <h5 class="pt-pb" style="font-weight: bold">Main causes of stress</h5>
                    <span>
                        Causes of stress are sourced from question 6 of the monthly check.
                    </span>
                            
                    <table class="table table-bordered white-b">
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
                        <input type="text" id="teamGeneral_population" class="form-control float-right reservation">
                    </div>
                </div>
                        
                <table id="team_populationGeneral" class="table table-bordered white-b">
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


                <h4 class="pt-pb">Coaching reports</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="teamGeneral_coaching" class="form-control float-right reservation">
                    </div>
                </div>
                 <div id="team_coachingGeneral">
                    <table class="table table-bordered white-b">
                        <tbody>
                            <tr>
                                <td style="width:40%">Coaching sessions</td>
                                <td>{{ $t_coaching_session }}</td>
                            </tr>
                            <tr>
                                <td>Average coach rating</td>
                                <td>
                                
                                {{ round($t_ave_ratings->average('rating')) }} stars
                            
                                </td>
                            </tr>
                            <tr>
                                <td>Returning users</td>
                                <td>{{ $t_returning_user_pro }}%</td>
                            </tr>
                        </tbody>
                    </table>

                    <h5 class="pt-pb" style="font-weight: bold">Reasons for sessions</h5>
                    
                            
                    <table class="table table-bordered white-b">
                        <tbody>
                            <tr>
                                <td style="width:40%">Depression</td>
                                <td>{{ $t_depression_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Parenting issues</td>
                                <td>{{ $t_parenting_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Relationship issues</td>
                                <td>{{ $t_relationship_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Mourning</td>
                                <td>{{ $t_mouring_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Conflictss</td>
                                <td>{{ $t_conflict_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Self-confidence</td>
                                <td>{{ $t_confidence_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Addictions</td>
                                <td>{{ $t_addiction_pro }}%</td>
                            </tr>
                            <tr>
                                <td>Others</td>
                                <td>{{ $t_other_pro }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>       
                <div class="space-h3"></div>
            </div>
        </div>
    </section>



</div>
@endsection