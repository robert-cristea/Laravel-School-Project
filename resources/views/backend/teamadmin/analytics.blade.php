@extends('backend.layout_analytics2')

@section('content')
<ul class="nav nav-tabs nav-tab-3" id="custom-content-below-tab" role="tablist">
    <li class="nav-item nav-item-5 text-center">
        <a class="nav-link nav-link-3 active" id="custom-content-below-general-tab" data-toggle="pill" href="#custom-content-below-general" role="tab" aria-controls="custom-content-below-general" aria-selected="true">My team</a>
    </li>
    <li class="nav-item nav-item-5 text-center">
        <a class="nav-link nav-link-3" id="custom-content-below-client-tab" data-toggle="pill" href="#custom-content-below-client" role="tab" aria-controls="custom-content-below-client" aria-selected="false">Per member</a>
    </li>
</ul>
<div class="content-wrapper tab-content" id="custom-content-below-tabContent">
    <section class="content tab-pane fade show active" id="custom-content-below-general" role="tabpanel" aria-labelledby="custom-content-below-general-tab">
    
        <div class="container-fluid">
            <h4 class="pt-pb">Team status</h4>
            <div class="card card-primary">
                
                <div class="card-body">
                    
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:40%">Team name</td>
                                <td>{{ $group_name }}</td>
                            </tr>
                            <tr>
                                <td>Team members</td>
                                <td>{{ $group_members }}</td>
                            </tr>
                            <tr>
                                <td>Online users</td>
                                <td>{{ $online_users }}</td>
                            <tr>
                                <td>French language</td>
                                <td>{{ round($fr_users_pro, 2) }}%</td>
                            </tr>
                            <tr>
                                <td>English language</td>
                                <td>{{ round($en_users_pro, 2) }}%</td>
                            </tr>
                            <tr>
                                <td>Accounts created on mobile</td>
                                <td>{{ round($mobile_users_pro, 2) }}%</td>
                            </tr>
                            <tr>
                                <td>Accounts created on the web</td>
                                <td>{{ round($desktop_users_pro, 2) }}%</td>
                            </tr>
                            <tr>
                                <td>Weekly checks submitted</td>
                                <td>{{ $weekly_check }}</td>
                            </tr>
                            <tr>
                                <td>Monthly checks submitted</td>
                                <td>{{ $monthly_check }}</td>
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
                    <input type="text" id="myteamGeneral_engage" class="form-control float-right reservation">
                </div>
            </div>
            <div class="card card-primary">
                
                <div class="card-body">
                    
                    <table id="myteam_engageGeneral" class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:40%">Video views</td>
                                <td>{{ $video_views }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- /.card -->
            </div>

            <h4 class="pt-pb">Team Weekly check result</h4>
            <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" id="myteamGeneral_week" class="form-control float-right reservation" >
                </div>
            </div>
            <div class="card card-primary">
                
                <div class="card-body">
                    
                    <table id="myteam_weekGeneral" class="table table-bordered">
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

            <h4 class="pt-pb">Team monthly check result</h4>
            <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                        </span>
                    </div>
                    <input type="text" id='myteamGeneral_month' class="form-control float-right reservation" >
                </div>
            </div>
            <div id="myteam_monthGeneral">
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
                    <input type="text" id="myteamGeneral_population" class="form-control float-right reservation">
                </div>
            </div>
            <div class="card card-primary">
                
                <div class="card-body">
                    
                    <table id="myteam_populationGeneral" class="table table-bordered">
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
                    <input type="text" id="myteamGeneral_coaching" class="form-control float-right reservation">
                </div>
            </div>
            <div id="myteam_coachingGeneral">
                <div class="card card-primary">
                    
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Coaching sessions</td>
                                    <td>{{ $coaching_session_num }}</td>
                                </tr>
                                <tr>
                                    <td>Average coach rating</td>
                                    <td>{{ round($coaching_session->average('rating')) }} stars</td>
                                </tr>
                                <tr>
                                    <td>Returning users</td>
                                    <td>{{ round($return_user) }}%</td>
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
            <h5 class="pt-pb" style="font-weight: bold">Select member</h5>
            <div class="form-group">
            @csrf
                <select id="showMember" class="form-control select2" style="width: 100%;">
                    @foreach($team_members as $team_member)
                    <option value="{{ $team_member->id }}">{{ $team_member->first_name }}</option>
                    @endforeach
                </select>
            </div>
            <div id="member_html">
                <h4 class="pt-pb">General member status</h4>
                <div class="card card-primary">
                    
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Email</td>
                                    <td>{{ $first_member->email }}</td>
                                </tr>
                                <tr>
                                    <td>First name</td>
                                    <td>{{ $first_member->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last name</td>
                                    <td>{{ $first_member->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>Connection status</td>
                                    <td>{{ $first_member->conncetion_status }}</td>
                                </tr>
                                <tr>
                                    <td>Account creation date</td>
                                    <td>{{ $first_member->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Account creation platform</td>
                                    <td>{{ $first_member->platform }}</td>
                                </tr>
                                <tr>
                                    <td>Account type</td>
                                    <td>{{ $account_type }}</td>
                                </tr>
                                <tr>
                                    <td>Sponsor</td>
                                    <td>{{ $sponsore->corporate_name }}</td>
                                </tr>
                                <tr>
                                    <td>Plan starting date</td>
                                    <td>{{ $plan_start }}</td>
                                </tr>
                                <tr>
                                    <td>Plan expiration date</td>
                                    <td>{{ $plan_end }}</td>
                                </tr>
                                <tr>
                                    <td>Language setting</td>
                                    <td>{{ $first_member->language }}</td>
                                </tr>
                                <tr>
                                    <td>Weekly checks submitted</td>
                                    <td>{{ $week_check }}</td>
                                </tr>
                                <tr>
                                    <td>Monthly checks submitted</td>
                                    <td>{{ $month_check }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card --> 
                </div>

                <h4 class="pt-pb">Member engagement status</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="memberGeneral_engage" class="form-control float-right reservation">
                    </div>
                </div>
                <div class="card card-primary">
                    
                    <div class="card-body">
                        
                        <table id="member_engageGeneral" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Usage time (minutes)</td>
                                    <td>none</td>
                                </tr>
                                <tr>
                                    <td style="width:40%">Video views</td>
                                    <td>{{ $mem_video_views }}</td>
                                </tr>
                                <tr>
                                    <td>Video likes</td>
                                    <td>{{ $mem_video_likes }}</td>
                                </tr>
                                <tr>
                                    <td>Video comments</td>
                                    <td>{{ $mem_video_comments }}</td>
                                </tr>
                                <tr>
                                    <td>Challenges accepted</td>
                                    <td>{{ $mem_challenge_accepted }}</td>
                                </tr>
                                <tr>
                                    <td>Quote likes</td>
                                    <td>none</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card -->
                </div>

                <h4 class="pt-pb">Weekly check results</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="memberGeneral_week" class="form-control float-right reservation">
                    </div>
                </div>
                <div class="card card-primary">
                    
                    <div class="card-body">
                        
                        <table id="member_weekGeneral" class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Overall</td>
                                    <td>3/5</td>
                                </tr>
                                <tr>
                                    <td>Workload</td>
                                    <td>2/3</td>
                                </tr>
                                <tr>
                                    <td>Stress</td>
                                    <td>3/3</td>
                                </tr>
                                <tr>
                                    <td>Energy</td>
                                    <td>2/3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card -->
                </div>

                <h4 class="pt-pb">Monthly check results</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="memberGeneral_month" class="form-control float-right reservation">
                    </div>
                </div>
                <div id="member_monthGeneral">
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

                <h4 class="pt-pb">Coaching reports</h4>
                <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="text" id="memberGeneral_coaching" class="form-control float-right reservation">
                    </div>
                </div>
                <div id="member_coachingGeneral">
                    <div class="card card-primary">
                        
                        <div class="card-body">
                            
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width:40%">Coaching sessions</td>
                                        <td>{{ $mem_coaching_session }}</td>
                                    </tr>
                                    <tr>
                                        <td>Average coach rating</td>
                                        <td>{{ round($mem_coaching_report->average('rating')) }} stars</td>
                                    </tr>
                                    <tr>
                                        <td>Returning users</td>
                                        <td>I think this part doesn't need to put in this page</td>
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
                                        <td>{{ $mem_depression_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Parenting issues</td>
                                        <td>{{ $mem_parenting_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Relationship issues</td>
                                        <td>{{ $mem_relationship_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Mourning</td>
                                        <td>{{ $mem_mouring_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Conflictss</td>
                                        <td>{{ $mem_conflict_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Self-confidence</td>
                                        <td>{{ $mem_confidence_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Addictions</td>
                                        <td>{{ $mem_addiction_pro }}%</td>
                                    </tr>
                                    <tr>
                                        <td>Others</td>
                                        <td>{{ $mem_other_pro }}%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection