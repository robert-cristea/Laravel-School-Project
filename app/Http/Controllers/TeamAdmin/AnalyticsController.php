<?php

namespace App\Http\Controllers\TeamAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User; 
use App\Model\Corporate_groups;
use App\Model\Team_members;
use App\Model\Week_progress;
use App\Model\All_checks; 
use App\Model\User_activities_videos; 
use App\Model\Coaching_reports; 
use App\Model\Corporate_clients; 
use App\Model\Video_likes; 
use App\Model\Videos_comments; 
use App\Model\Users_challenges; 

class AnalyticsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /////////////////////// Team ////////////////////////
        /////////////////////////////////////////////////////
        $group_admin_id = Auth::user()->id;
        $corporate_group = Corporate_groups::where('corporate_group_admin_id', $group_admin_id)->first();
        
        $group_name = $corporate_group->group_name;
        // group_admin_id = $corporate_group->group_id;
        $group_members = Team_members::where('corporate_group_admin_id', $group_admin_id)->count();
        $online_users = 0;
        $fr_users = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('language', 'french')
                        ->count();
        if ($fr_users != 0) {
            $fr_users_pro = $fr_users/$group_members*100;
        } else {
            $fr_users_pro = 0;
        }
        $en_users_pro = 100-$fr_users_pro; 
        $mobile_users = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('platform', 'mobile')
                        ->count();                               
        if ($mobile_users != 0) {
            $mobile_users_pro = $mobile_users/$group_members*100;
        } else {
            $mobile_users_pro = 0;
        }
        $desktop_users_pro = 100-$mobile_users_pro;
        $weekly_check = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                            ->where('corporate_group_admin_id', $group_admin_id)
                            ->where('checks_type', 0)
                            ->count();
        $monthly_check = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                            ->where('corporate_group_admin_id', $group_admin_id)
                            ->where('checks_type', 1)
                            ->count();
        $video_views = User_activities_videos::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_user_activities_videos.user_id')
                            ->where('corporate_group_admin_id', $group_admin_id)
                            ->count();
        // $workload_averages = Week_progress::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
        //                         ->where('corporate_group_admin_id', $group_admin_id)
        //                         ->get();
        // $workload_ave_num = $workload_averages->count(); 
        
        $coaching_session = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                ->where('corporate_group_admin_id', $group_admin_id)
                                ->get();
        $coaching_session_num = $coaching_session->count();
        $all_return_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                    ->where('corporate_group_admin_id', $group_admin_id)
                                    ->get()
                                    ->groupBy('user_id')
                                    ->count();
        $duplicated_return_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                    ->where('corporate_group_admin_id', $group_admin_id)
                                    ->get()
                                    ->duplicates()
                                    ->groupBy('user_id')
                                    ->count();
        if ($duplicated_return_users != 0) {
            $return_user = $duplicated_return_users/$all_return_users*100;
        } else {
            $return_user = 0;
        }
        
        $depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 1)
                        ->count();
        if ($depression !=0) {
            $depression_pro = round($depression/$coaching_session_num*100);
        } else {
            $depression_pro = 0;
        }

        $parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 2)
                        ->count();
        if ($parenting !=0) {
            $parenting_pro = round($parenting/$coaching_session_num*100);
        } else {
            $parenting_pro = 0;
        }

        $relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 3)
                        ->count();
        if ($relationship !=0) {
            $relationship_pro = round($relationship/$coaching_session_num*100);
        } else {
            $relationship_pro = 0;
        }

        $mouring = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 4)
                        ->count();
        if ($mouring !=0) {
            $mouring_pro = round($mouring/$coaching_session_num*100);
        } else {
            $mouring_pro = 0;
        }

        $conflict = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 5)
                        ->count();
        if ($conflict !=0) {
            $conflict_pro = round($conflict/$coaching_session_num*100);
        } else {
            $conflict_pro = 0;
        }

        $confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 6)
                        ->count();
        if ($confidence !=0) {
            $confidence_pro = round($confidence/$coaching_session_num*100);
        } else {
            $confidence_pro = 0;
        }

        $addiction = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 7)
                        ->count();
        if ($addiction !=0) {
            $addiction_pro = round($addiction/$coaching_session_num*100);
        } else {
            $addiction_pro = 0;
        }

        $other = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_admin_id)
                        ->where('motif_seance_id', 8)
                        ->count();
        if ($other !=0) {
            $other_pro = round($other/$coaching_session_num*100);
        } else {
            $other_pro = 0;
        }
 
        /////////////////////// Team member /////////////////
        /////////////////////////////////////////////////////
        $team_members = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                            ->where('corporate_group_admin_id', $group_admin_id)
                            ->get();
        $first_member = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                            ->where('corporate_group_admin_id', $group_admin_id)
                            ->first(); 
                           
        $account_type = $first_member->user_level;
        $account_id = $first_member->id; 
        if ($account_type==0) {
            $account_type = 'super admin';
        } elseif ($account_type==1) {
            $account_type = 'admin';
        } elseif ($account_type==2) {
            $account_type = 'corporate admin';
        } elseif ($account_type==3) {
            $account_type = 'premium user';
        } elseif ($account_type==5) {
            $account_type = 'guest';
        } elseif ($account_type==6) {
            $account_type = 'coacht';
        } elseif ($account_type==7) {
            $account_type = 'corporate group admin';
        } elseif ($account_type==8) {
            $account_type = 'corporate user';
        } else {
            $account_type = 'free user';
        }
        $sponsore = Corporate_clients::Join('vieva_team_members', 'vieva_team_members.corporate_client_id', '=', 'vieva_corporate_clients.corporate_client_id')
                                        ->where('user_id', $account_id)
                                        ->first();
        $plan_start = $sponsore ->plan_starting_date;
        $plan_end = $sponsore ->plan_expiration_date;
        $week_check = All_checks::where('user_id', $account_id)
                            ->where('checks_type', 0)
                            ->count();
        $month_check = All_checks::where('user_id', $account_id)
                            ->where('checks_type', 1)
                            ->count();
        $mem_video_views = User_activities_videos::where('user_id', $account_id)
                            ->count();
        $mem_video_likes = Video_likes::where('user_id', $account_id)
                            ->where('likes', 1)
                            ->count();
        $mem_video_comments = Videos_comments::where('user_id', $account_id)
                            ->count();
        $mem_challenge_accepted = Users_challenges::where('user_id', $account_id)
                            ->where('accepted', 1)
                            ->count();
        $mem_coaching_session = Coaching_reports::where('user_id', $account_id)
                            ->count();
        $mem_coaching_report = Coaching_reports::where('user_id', $account_id)
                            ->get();

        $mem_depression = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 1)
                        ->count(); 
        if ($mem_depression !=0) {
            $mem_depression_pro = round($mem_depression/$mem_coaching_session*100);
        } else {
            $mem_depression_pro = 0;
        }

        $mem_parenting = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 2)
                        ->count();
        if ($mem_parenting !=0) {
            $mem_parenting_pro = round($mem_parenting/$mem_coaching_session*100);
        } else {
            $mem_parenting_pro = 0;
        }

        $mem_relationship = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 3)   
                        ->count();
        if ($mem_relationship !=0) {
            $mem_relationship_pro = round($mem_relationship/$mem_coaching_session*100);
        } else {
            $mem_relationship_pro = 0;
        }

        $mem_mouring = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 4)
                        ->count();
        if ($mem_mouring !=0) {
            $mem_mouring_pro = round($mem_mouring/$mem_coaching_session*100);
        } else {
            $mem_mouring_pro = 0;
        }

        $mem_conflict = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 5)
                        ->count();
        if ($mem_conflict !=0) {
            $mem_conflict_pro = round($mem_conflict/$mem_coaching_session*100);
        } else {
            $mem_conflict_pro = 0;
        }

        $mem_confidence = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 6)
                        ->count();
        if ($mem_confidence !=0) {
            $mem_confidence_pro = round($mem_confidence/$mem_coaching_session*100);
        } else {
            $mem_confidence_pro = 0;
        }

        $mem_addiction = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 7)
                        ->count();
        if ($mem_addiction !=0) {
            $mem_addiction_pro = round($mem_addiction/$mem_coaching_session*100);
        } else {
            $mem_addiction_pro = 0;
        }

        $mem_other = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 8)
                        ->count();
        if ($mem_other !=0) {
            $mem_other_pro = round($mem_other/$mem_coaching_session*100);
        } else {
            $mem_other_pro = 0;
        }


        return view('backend.teamadmin.analytics', compact(
            'group_name', 'group_members', 'online_users',
            'fr_users_pro', 'en_users_pro', 'mobile_users_pro',
            'desktop_users_pro', 'weekly_check', 'monthly_check',
            'video_views','coaching_session_num', 'coaching_session',
            'return_user', 'depression_pro', 'parenting_pro', 'relationship_pro',
            'mouring_pro', 'conflict_pro', 'confidence_pro', 'addiction_pro',
            'other_pro',
            'team_members', 'first_member', 'account_type', 'sponsore',
            'plan_start', 'plan_end', 'week_check', 'month_check',
            'mem_video_views', 'mem_video_likes', 'mem_video_comments',
            'mem_challenge_accepted', 'mem_coaching_session', 'mem_coaching_report',
            'mem_depression_pro', 'mem_parenting_pro', 'mem_relationship_pro',
            'mem_mouring_pro', 'mem_conflict_pro', 'mem_confidence_pro', 'mem_addiction_pro',
            'mem_other_pro'
        ));
       
                       
    }

    public function showMember(Request $request){
        $member_id = $request->member_id;
        $first_member = User::where('id', $member_id)->first();

        $account_type = $first_member->user_level; 
        $account_id = $first_member->id; 
        if ($account_type==0) {
            $account_type = 'super admin';
        } elseif ($account_type==1) {
            $account_type = 'admin';
        } elseif ($account_type==2) {
            $account_type = 'corporate admin';
        } elseif ($account_type==3) {
            $account_type = 'premium user';
        } elseif ($account_type==5) {
            $account_type = 'guest';
        } elseif ($account_type==6) {
            $account_type = 'coacht';
        } elseif ($account_type==7) {
            $account_type = 'corporate group admin';
        } elseif ($account_type==8) {
            $account_type = 'corporate user';
        } else {
            $account_type = 'free user';
        }
        $sponsore = Corporate_clients::Join('vieva_team_members', 'vieva_team_members.corporate_client_id', '=', 'vieva_corporate_clients.corporate_client_id')
                                        ->where('user_id', $account_id)
                                        ->first();
        $plan_start = $sponsore ->plan_starting_date;
        $plan_end = $sponsore ->plan_expiration_date;
        $week_check = All_checks::where('user_id', $account_id)
                            ->where('checks_type', 0)
                            ->count();
        $month_check = All_checks::where('user_id', $account_id)
                            ->where('checks_type', 1)
                            ->count();
        $mem_video_views = User_activities_videos::where('user_id', $account_id)
                            ->count();
        $mem_video_likes = Video_likes::where('user_id', $account_id)
                            ->where('likes', 1)
                            ->count();
        $mem_video_comments = Videos_comments::where('user_id', $account_id)
                            ->count();
        $mem_challenge_accepted = Users_challenges::where('user_id', $account_id)
                            ->where('accepted', 1)
                            ->count();
        $mem_coaching_session = Coaching_reports::where('user_id', $account_id)
                            ->count();
        $mem_coaching_report = Coaching_reports::where('user_id', $account_id)
                            ->get();

        $mem_depression = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 1)
                        ->count(); 
        if ($mem_depression !=0) {
            $mem_depression_pro = round($mem_depression/$mem_coaching_session*100);
        } else {
            $mem_depression_pro = 0;
        }

        $mem_parenting = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 2)
                        ->count();
        if ($mem_parenting !=0) {
            $mem_parenting_pro = round($mem_parenting/$mem_coaching_session*100);
        } else {
            $mem_parenting_pro = 0;
        }

        $mem_relationship = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 3)   
                        ->count();
        if ($mem_relationship !=0) {
            $mem_relationship_pro = round($mem_relationship/$mem_coaching_session*100);
        } else {
            $mem_relationship_pro = 0;
        }

        $mem_mouring = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 4)
                        ->count();
        if ($mem_mouring !=0) {
            $mem_mouring_pro = round($mem_mouring/$mem_coaching_session*100);
        } else {
            $mem_mouring_pro = 0;
        }

        $mem_conflict = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 5)
                        ->count();
        if ($mem_conflict !=0) {
            $mem_conflict_pro = round($mem_conflict/$mem_coaching_session*100);
        } else {
            $mem_conflict_pro = 0;
        }

        $mem_confidence = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 6)
                        ->count();
        if ($mem_confidence !=0) {
            $mem_confidence_pro = round($mem_confidence/$mem_coaching_session*100);
        } else {
            $mem_confidence_pro = 0;
        }

        $mem_addiction = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 7)
                        ->count();
        if ($mem_addiction !=0) {
            $mem_addiction_pro = round($mem_addiction/$mem_coaching_session*100);
        } else {
            $mem_addiction_pro = 0;
        }

        $mem_other = Coaching_reports::where('user_id', $account_id)
                        ->where('motif_seance_id', 8)
                        ->count();
        if ($mem_other !=0) {
            $mem_other_pro = round($mem_other/$mem_coaching_session*100);
        } else {
            $mem_other_pro = 0;
        }


        $output= '<h4 class="pt-pb">General member status</h4>
        <div class="card card-primary">
            
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Email</td>
                            <td>'.$first_member->email.'</td>
                        </tr>
                        <tr>
                            <td>First name</td>
                            <td>'.$first_member->first_name.'</td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                            <td>'.$first_member->last_name.'</td>
                        </tr>
                        <tr>
                            <td>Connection status</td>
                            <td>'.$first_member->conncetion_status.'</td>
                        </tr>
                        <tr>
                            <td>Account creation date</td>
                            <td>'.$first_member->last_login.'</td>
                        </tr>
                        <tr>
                            <td>Account creation platform</td>
                            <td>'.$first_member->platform.'</td>
                        </tr>
                        <tr>
                            <td>Account type</td>
                            <td>'.$account_type.'</td>
                        </tr>
                        <tr>
                            <td>Sponsor</td>
                            <td>'.$sponsore->corporate_name.'</td>
                        </tr>
                        <tr>
                            <td>Plan starting date</td>
                            <td>'.$plan_start.'</td>
                        </tr>
                        <tr>
                            <td>Plan expiration date</td>
                            <td>'.$plan_end.'</td>
                        </tr>
                        <tr>
                            <td>Language setting</td>
                            <td>'.$first_member->language.'</td>
                        </tr>
                        <tr>
                            <td>Weekly checks submitted</td>
                            <td>'.$week_check.'</td>
                        </tr>
                        <tr>
                            <td>Monthly checks submitted</td>
                            <td>'.$month_check.'</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- /.card --> 
        </div>

        <h4 class="pt-pb">Member engagement status</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Since begining of time</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
            </select>
        </div>
        <div class="card card-primary">
            
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Usage time (minutes)</td>
                            <td>none</td>
                        </tr>
                        <tr>
                            <td style="width:40%">Video views</td>
                            <td>'.$mem_video_views.'</td>
                        </tr>
                        <tr>
                            <td>Video likes</td>
                            <td>'.$mem_video_likes.'</td>
                        </tr>
                        <tr>
                            <td>Video comments</td>
                            <td>'.$mem_video_comments.'</td>
                        </tr>
                        <tr>
                            <td>Challenges accepted</td>
                            <td>'.$mem_challenge_accepted.'</td>
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
            <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Last week</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
            </select>
        </div>
        <div class="card card-primary">
            
            <div class="card-body">
                
                <table class="table table-bordered">
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
            <select class="form-control select2" style="width: 100%;">
                <option selected="selected">January 2021</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
            </select>
        </div>
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

        <h4 class="pt-pb">Coaching reports</h4>
        <h5 class="pt-pb" style="font-weight: bold">Select timeframe</h5>
        <div class="form-group">
            <select class="form-control select2" style="width: 100%;">
                <option selected="selected">Since begining of time</option>
                <option>January 2021</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
            </select>
        </div>
        <div class="card card-primary">
            
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Coaching sessions</td>
                            <td>'.$mem_coaching_session.'</td>
                        </tr>
                        <tr>
                            <td>Average coach rating</td>
                            <td>'.round($mem_coaching_report->average('rating')).' stars</td>
                        </tr>
                        <tr>
                            <td>Returning users</td>
                            <td>I think this part does not need to put in this page</td>
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
                            <td>'.$mem_depression_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Parenting issues</td>
                            <td>'.$mem_parenting_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Relationship issues</td>
                            <td>'.$mem_relationship_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Mourning</td>
                            <td>'.$mem_mouring_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Conflictss</td>
                            <td>'.$mem_conflict_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Self-confidence</td>
                            <td>'.$mem_confidence_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Addictions</td>
                            <td>'.$mem_addiction_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Others</td>
                            <td>'.$mem_other_pro.'%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <!-- /.card -->
        </div>';
        echo $output;
    }



}