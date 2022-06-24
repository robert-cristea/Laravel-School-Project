<?php

namespace App\Http\Controllers\CorporateAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User; 
use App\Model\Corporate_clients;
use App\Model\Corporate_groups;
use App\Model\Team_members;
use App\Model\Week_progress;
use App\Model\All_checks;
use App\Model\User_activities_videos;
use App\Model\Video_likes;
use App\Model\Coaching_reports;

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
        ///////////////////// General //////////////////////////
        ///////////////////////////////////////////////////////
        $id = Auth::user()->id;
        $corporate = Corporate_clients::where('admin_id', $id)->first();
        $corporate_id = $corporate->corporate_client_id; 
        $plan_start = $corporate->plan_starting_date; 
        $plan_end = $corporate->plan_expiration_date; 
        $licence_num = $corporate->Number_licences;
        $corporate_name = $corporate->corporate_name;
        $enrolled_users = Team_members::where('corporate_client_id', $corporate_id)->count();
        $online_users = 0;
        $fr_users = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                            ->where('corporate_client_id', $corporate_id)
                            ->where('language', 'french')
                            ->count();
        if ($fr_users != 0) {
            $fr_users_pro = round($fr_users/$enrolled_users*100);
        }else {
            $fr_users_pro = 0;
        }
        $en_users_pro = 100-$fr_users_pro;
        $mobile_acc = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('platform', 'mobile')
                        ->count();
        if ($mobile_acc != 0) {
            $mobile_acc_pro = round($mobile_acc/$enrolled_users*100);
        } else {
            $mobile_acc_pro = 0;
        }
        
        $desktop_acc_pro = 100-$mobile_acc_pro;
        $weekly_checks = Week_progress::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->count();
        $monthly_checks = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('checks_type', 1)
                        ->count();
        $video_views = Video_likes::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_likes.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->count();
        $coachings = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                            ->where('corporate_client_id', $corporate_id)->get();
                            
        $coaching_session = $coachings->count();
       


        $duplicated_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                            ->where('corporate_client_id', $corporate_id)
                            ->get()->duplicates()->groupBy('user_id')->count();   
                                        
        $unique_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                ->where('corporate_client_id', $corporate_id)
                                ->get()
                                ->groupBy('user_id')
                                ->count(); 
        $returning_user_pro = $duplicated_users/$unique_users*100;


        $depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 1)
                        ->count();
        if ($depression !=0) {
            $depression_pro = round($depression/$coaching_session*100);
        } else {
            $depression_pro = 0;
        }

        $parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 2)
                        ->count();
        if ($parenting !=0) {
            $parenting_pro = round($parenting/$coaching_session*100);
        } else {
            $parenting_pro = 0;
        }

        $relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 3)
                        ->count();
        if ($relationship !=0) {
            $relationship_pro = round($relationship/$coaching_session*100);
        } else {
            $relationship_pro = 0;
        }

        $mouring = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 4)
                        ->count();
        if ($mouring !=0) {
            $mouring_pro = round($mouring/$coaching_session*100);
        } else {
            $mouring_pro = 0;
        }

        $conflict = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 5)
                        ->count();
        if ($conflict !=0) {
            $conflict_pro = round($conflict/$coaching_session*100);
        } else {
            $conflict_pro = 0;
        }

        $confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 6)
                        ->count();
        if ($confidence !=0) {
            $confidence_pro = round($confidence/$coaching_session*100);
        } else {
            $confidence_pro = 0;
        }

        $addiction = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 7)
                        ->count();
        if ($addiction !=0) {
            $addiction_pro = round($addiction/$coaching_session*100);
        } else {
            $addiction_pro = 0;
        }

        $other = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_client_id', $corporate_id)
                        ->where('motif_seance_id', 8)
                        ->count();
        if ($other !=0) {
            $other_pro = round($other/$coaching_session*100);
        } else {
            $other_pro = 0;
        }


        //////////////////// Per Team /////////////////////////
        ///////////////////////////////////////////////////////
        $groups = Corporate_groups::where('corporate_client_id', $corporate_id)->get();
        $firstgroup = Corporate_groups::where('corporate_client_id', $corporate_id)->first();
        $firstgroup_id = $firstgroup->corporate_group_admin_id; 
        $team_members = Team_members::where('corporate_group_admin_id', $firstgroup_id)->count();
        
        $team_online_users = 0;
        $team_fr_users = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                            ->where('corporate_group_admin_id', $firstgroup_id)
                            ->where('language', 'french')->count();
        if ($team_members != 0) {
            $team_fr_users_pro = round($team_fr_users/$team_members*100);
        } else {
            $team_fr_users_pro = 0;
        }
        $team_en_users_pro = 100-$team_fr_users_pro;

        $team_mobile = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('platform', 'mobile')->count();
        if ($team_mobile != 0) {
            $team_mobile_pro = round($team_mobile/$team_members*100);
        } else {
            $team_mobile_pro = 0;
        }
        $team_desktop_pro = 100-$team_mobile_pro;
        $team_week = Week_progress::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->count();
        $team_month = 0;
        $team_v_views = User_activities_videos::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_user_activities_videos.user_id')
                            ->where('corporate_group_admin_id', $firstgroup_id)
                            ->count();
        $t_coaching_session = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                ->where('corporate_group_admin_id', $firstgroup_id)
                                ->count();
        $t_ave_ratings = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->get();
           
        $t_duplicated_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                            ->where('corporate_group_admin_id', $firstgroup_id)
                            ->get()->duplicates()->groupBy('user_id')->count();   
                                        
        $t_unique_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                ->where('corporate_group_admin_id', $firstgroup_id)
                                ->get()
                                ->groupBy('user_id')
                                ->count();
        if ($t_duplicated_users != 0) {
            $t_returning_user_pro = $t_duplicated_users/$t_unique_users*100;
        } else {
            $t_returning_user_pro = 0; 
        }  
        
        $t_depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 1)
                        ->count();
        if ($t_depression !=0) {
            $t_depression_pro = round($t_depression/$t_coaching_session*100);
        } else {
            $t_depression_pro = 0;
        }

        $t_parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 2)
                        ->count();
        if ($t_parenting !=0) {
            $t_parenting_pro = round($t_parenting/$t_coaching_session*100);
        } else {
            $t_parenting_pro = 0;
        }

        $t_relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 3)
                        ->count();
        if ($t_relationship !=0) {
            $t_relationship_pro = round($t_relationship/$t_coaching_session*100);
        } else {
            $t_relationship_pro = 0;
        }
  
        $t_mouring = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 4)
                        ->count();
        if ($t_mouring !=0) {
            $t_mouring_pro = round($t_mouring/$t_coaching_session*100);
        } else {
            $t_mouring_pro = 0;
        }

        $t_conflict = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 5)
                        ->count();
        if ($t_conflict !=0) {
            $t_conflict_pro = round($t_conflict/$t_coaching_session*100);
        } else {
            $t_conflict_pro = 0;
        }

        $t_confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 6)
                        ->count();
        if ($t_confidence !=0) {
            $t_confidence_pro = round($t_confidence/$t_coaching_session*100);
        } else {
            $t_confidence_pro = 0;
        }

        $t_addiction = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 7)
                        ->count();
        if ($t_addiction !=0) {
            $t_addiction_pro = round($t_addiction/$t_coaching_session*100);
        } else {
            $t_addiction_pro = 0;
        }

        $t_other = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $firstgroup_id)
                        ->where('motif_seance_id', 8)
                        ->count();
        if ($t_other !=0) {
            $t_other_pro = round($t_other/$t_coaching_session*100);
        } else {
            $t_other_pro = 0;
        }

        return view('backend.corporateadmin.analytics', compact(
            'plan_start', 'plan_end', 'licence_num',
            'corporate_name', 'enrolled_users', 'online_users',
            'fr_users_pro', 'en_users_pro', 'mobile_acc_pro', 'desktop_acc_pro',
            'weekly_checks', 'monthly_checks', 'video_views',
            'coaching_session', 'coachings', 'returning_user_pro', 'depression_pro',
            'parenting_pro', 'relationship_pro', 'mouring_pro',
            'conflict_pro', 'confidence_pro', 'addiction_pro',
            'other_pro',
            'groups', 'team_members', 'team_online_users',
            'team_fr_users_pro', 'team_en_users_pro', 'team_mobile_pro',
            'team_desktop_pro', 'team_week', 'team_month', 'team_v_views',
            't_coaching_session', 't_ave_ratings', 't_returning_user_pro',
            't_depression_pro', 't_parenting_pro', 't_relationship_pro',
            't_mouring_pro', 't_conflict_pro', 't_confidence_pro', 't_addiction_pro', 
            't_other_pro',

        ));
    }

    //When clicking per team
    public function showGroup(Request $request){
        
        $group_id = $request->group_id;
        $team_members = Team_members::where('corporate_group_admin_id', $group_id)->count();
        
        $team_online_users = 0;
        $team_fr_users = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                            ->where('corporate_group_admin_id', $group_id)
                            ->where('language', 'french')->count();
        if ($team_fr_users != 0) {
            $team_fr_users_pro = round($team_fr_users/$team_members*100);
        } else {
            $team_fr_users_pro = 0;
        }
        $team_en_users_pro = 100-$team_fr_users_pro;

        $team_mobile = User::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('platform', 'mobile')->count();
        if ($team_mobile != 0) {
            $team_mobile_pro = round($team_mobile/$team_members*100);
        } else {
            $team_mobile_pro = 0;
        }
        $team_desktop_pro = 100-$team_mobile_pro;
        $team_week = Week_progress::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->count();
        $team_month = 0;
        $team_v_views = User_activities_videos::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_user_activities_videos.user_id')
                            ->where('corporate_group_admin_id', $group_id)
                            ->count();
        $t_coaching_session = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                ->where('corporate_group_admin_id', $group_id)
                                ->count();
        $t_ave_ratings = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->get();
           
        $t_duplicated_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                            ->where('corporate_group_admin_id', $group_id)
                            ->get()->duplicates()->groupBy('user_id')->count();   
                                        
        $t_unique_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                                ->where('corporate_group_admin_id', $group_id)
                                ->get()
                                ->groupBy('user_id')
                                ->count(); 
        if ($t_duplicated_users != 0) {
            $t_returning_user_pro = $t_duplicated_users/$t_unique_users*100;
        } else {
            $t_returning_user_pro = 0; 
        }
                                        
        
        
        $t_depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 1)
                        ->count();
        if ($t_depression !=0) {
            $t_depression_pro = round($t_depression/$t_coaching_session*100);
        } else {
            $t_depression_pro = 0;
        }

        $t_parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 2)
                        ->count();
        if ($t_parenting !=0) {
            $t_parenting_pro = round($t_parenting/$t_coaching_session*100);
        } else {
            $t_parenting_pro = 0;
        }

        $t_relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 3)
                        ->count();
        if ($t_relationship !=0) {
            $t_relationship_pro = round($t_relationship/$t_coaching_session*100);
        } else {
            $t_relationship_pro = 0;
        }
  
        $t_mouring = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 4)
                        ->count();
        if ($t_mouring !=0) {
            $t_mouring_pro = round($t_mouring/$t_coaching_session*100);
        } else {
            $t_mouring_pro = 0;
        }

        $t_conflict = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 5)
                        ->count();
        if ($t_conflict !=0) {
            $t_conflict_pro = round($t_conflict/$t_coaching_session*100);
        } else {
            $t_conflict_pro = 0;
        }

        $t_confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 6)
                        ->count();
        if ($t_confidence !=0) {
            $t_confidence_pro = round($t_confidence/$t_coaching_session*100);
        } else {
            $t_confidence_pro = 0;
        }

        $t_addiction = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 7)
                        ->count();
        if ($t_addiction !=0) {
            $t_addiction_pro = round($t_addiction/$t_coaching_session*100);
        } else {
            $t_addiction_pro = 0;
        }

        $t_other = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                        ->where('corporate_group_admin_id', $group_id)
                        ->where('motif_seance_id', 8)
                        ->count();
        if ($t_other !=0) {
            $t_other_pro = round($t_other/$t_coaching_session*100);
        } else {
            $t_other_pro = 0;
        }
        $output = '<h4 class="pt-pb">Team status</h4>
        <div class="card card-primary">
            
            <div class="card-body">
                
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Members</td>
                            <td>'.$team_members.'</td>
                        </tr>
                        <tr>
                            <td>Online users</td>
                            <td>'.$team_online_users.'</td>
                        <tr>
                            <td>French language</td>
                            <td>'.$team_fr_users_pro.'%</td>
                        </tr>
                        <tr>
                            <td>English language</td>
                            <td>'.$team_en_users_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Accounts created on mobile</td>
                            <td>'.$team_mobile_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Accounts created on the web</td>
                            <td>'.$team_desktop_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Weekly checks submitted</td>
                            <td>'.$team_week.'</td>
                        </tr>
                        <tr>
                            <td>Monthly checks submitted</td>
                            <td>'.$team_month.'</td>
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
                <input type="hidden" id="group_id" value="'.$group_id.'"/>
                <input type="text" id="team_engage" class="form-control float-right reservation">
            </div>
        </div>
                
        <table id="team_engage_html" class="table table-bordered white-b">
            <tbody>
                <tr>
                    <td style="width:40%">Video views</td>
                    <td>'.$team_v_views.'</td>
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
                <input type="text" id="team_week" class="form-control float-right reservation">
            </div>
        </div>
                
        <table id="team_week_html" class="table table-bordered white-b">
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
                <input type="text" id="team_month" class="form-control float-right reservation">
            </div>
        </div>
        <div id="team_month_html">
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
                <input type="text" id="team_risk" class="form-control float-right reservation">
            </div>
        </div>
                
        <table id="team_risk_html" class="table table-bordered white-b">
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
                <input type="text" id="team_coach" class="form-control float-right reservation">
            </div>
        </div>
        <div id="team_coach_html">       
            <table class="table table-bordered white-b">
                <tbody>
                    <tr>
                        <td style="width:40%">Coaching sessions</td>
                        <td>'.$t_coaching_session.'</td>
                    </tr>
                    <tr>
                        <td>Average coach rating</td>
                        <td>';
                        
                        $output .= round($t_ave_ratings->average('rating')).' stars';
                    
                        $output .='</td>
                    </tr>
                    <tr>
                        <td>Returning users</td>
                        <td>'.$t_returning_user_pro.'%</td>
                    </tr>
                </tbody>
            </table>

            <h5 class="pt-pb" style="font-weight: bold">Reasons for sessions</h5>
            
                    
            <table class="table table-bordered white-b">
                <tbody>
                    <tr>
                        <td style="width:40%">Depression</td>
                        <td>'.$t_depression_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Parenting issues</td>
                        <td>'.$t_parenting_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Relationship issues</td>
                        <td>'.$t_relationship_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Mourning</td>
                        <td>'.$t_mouring_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Conflictss</td>
                        <td>'.$t_conflict_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Self-confidence</td>
                        <td>'.$t_confidence_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Addictions</td>
                        <td>'.$t_addiction_pro.'%</td>
                    </tr>
                    <tr>
                        <td>Others</td>
                        <td>'.$t_other_pro.'%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="space-h3"></div>';
        echo $output;
    }

    
    
}