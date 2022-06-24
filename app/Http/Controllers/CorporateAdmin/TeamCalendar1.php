<?php

namespace App\Http\Controllers\CorporateAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Week_progress;
use App\Model\Video_lessons; 
use App\Model\Video_likes;
use App\Model\User_activities_videos;
use App\Model\Videos_comments;
use App\Model\Users_challenges;
use App\Model\Quotes;
use App\Model\Coaching_reports;
use App\Model\Motif_seance;
use App\Model\Corporate_clients; 
use App\Model\Corporate_groups;
use App\Model\All_checks;
use DB;
use Auth;

class TeamCalendar1 extends Controller 
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

    ////////////////////////////////// Team Calender /////////////////////////////
    // Engagement
    public function teamEngage(Request $request){
        

        $group_id = $request->group_id;

        $dates = $request->date;
        $dates = explode('-', $dates);
        $start_date = $dates[0];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_y = str_replace(' ', "", $start_y);
        $start_date = implode('-', array($start_y, $start_m, $start_d)); 
        $end_date = $dates[1];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_m = str_replace(' ', '', $end_m);
        $end_d = $end_date[1];
        $end_y = $end_date[2]; 
        $end_date = implode('-', array($end_y, $end_m, $end_d));
        
        $video_views = User_activities_videos::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_user_activities_videos.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_user_activities_videos.date', [$start_date, $end_date])
                    ->count();
        
        $output = ' <tbody>
                        <tr class="white-b">
                            <td style="width:40%">Video views</td>
                            <td>'.$video_views.'</td>
                        </tr>
                    </tbody>';
        echo $output;  
    }
    // Weekly
    public function teamWeek(Request $request){
        $group_id = $request->group_id;

        $dates = $request->date;
        $dates = explode('-', $dates);
        $start_date = $dates[0];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_y = str_replace(' ', "", $start_y);
        $start_date = implode('-', array($start_y, $start_m, $start_d)); 
        $end_date = $dates[1];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_m = str_replace(' ', '', $end_m);
        $end_d = $end_date[1];
        $end_y = $end_date[2]; 
        $end_date = implode('-', array($end_y, $end_m, $end_d));

        $week_progress = Week_progress::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
        ->where('corporate_group_admin_id', $group_id)
        ->whereBetween('vieva_week_progress.date', [$start_date, $end_date])->get();
        $output = '<tbody>
                        <tr>
                            <td style="width:40%">Overall average</td>
                            <td>';
                            $output .= round(($week_progress->average("workload_level")+ 
                            $week_progress->average("stress_level")+
                            $week_progress->average("energy_level"))/3, 2);
                            $output .= '/5
                            </td>
                        </tr>
                        <tr>
                            <td>Workload average</td>
                            <td>';
                            $output .= round($week_progress->average("workload_level"), 2);
                            $output .= '/5</td>
                        </tr>
                        <tr>
                            <td>Stress average</td>
                            <td>';
                            $output .= round($week_progress->average("stress_level"), 2);
                            $output .= '/5</td>
                        </tr>
                        <tr>
                            <td>Energy average</td>
                            <td>';
                            $output .= round($week_progress->average("energy_level"), 2);
                            $output .= '/5</td>
                        </tr>
                    </tbody>';
        echo $output;
    }
    // Monthly
    public function teamMonth(Request $request){
        $group_id = $request->group_id;

        $dates = $request->date;
        $dates = explode('-', $dates);
        $start_date = $dates[0];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_y = str_replace(' ', "", $start_y);
        $start_date = implode('-', array($start_y, $start_m, $start_d)); 
        $end_date = $dates[1];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_m = str_replace(' ', '', $end_m);
        $end_d = $end_date[1];
        $end_y = $end_date[2]; 
        $end_date = implode('-', array($end_y, $end_m, $end_d));

        $all_checks = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                            ->where('corporate_group_admin_id', $group_id)
                            ->whereBetween('vieva_all_checks.check_datetime', [$start_date, $end_date])->where('checks_type', 1)->get();
        $tatal_num = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                            ->where('corporate_group_admin_id', $group_id)
                            ->whereBetween('vieva_all_checks.check_datetime', [$start_date, $end_date])->where('checks_type', 1)->count();
        $main_cause_num1=0;
        $main_cause_num2=0;
        $main_cause_num3=0;
        $main_cause_num4=0;
        $main_cause_num5=0;
        $main_cause_num6=0;
        foreach ($all_checks as $all_check) {
            $value1 = explode(',', $all_check->QA6)[0];
            $value2 = explode(',', $all_check->QA6)[1];
            $value3 = explode(',', $all_check->QA6)[2];
            $value4 = explode(',', $all_check->QA6)[3];
            $value5 = explode(',', $all_check->QA6)[4];
            $value6 = explode(',', $all_check->QA6)[5];
            if($value1=='true'){
                $main_cause_num1++;
            }
            if($value2=='true'){
                $main_cause_num2++;
            }
            if($value3=='true'){
                $main_cause_num3++;
            }
            if($value4=='true'){
                $main_cause_num4++;
            }
            if($value5=='true'){
                $main_cause_num5++;
            }
            if($value6=='true'){
                $main_cause_num6++;
            }
        }
        if ($tatal_num != 0) {
            $main_cause_pro1 = round($main_cause_num1/$tatal_num*100, 2);
            $main_cause_pro2 = round($main_cause_num2/$tatal_num*100, 2);
            $main_cause_pro3 = round($main_cause_num3/$tatal_num*100, 2);
            $main_cause_pro4 = round($main_cause_num4/$tatal_num*100, 2);
            $main_cause_pro5 = round($main_cause_num5/$tatal_num*100, 2);
            $main_cause_pro6 = round($main_cause_num6/$tatal_num*100, 2);
        } else {
            $main_cause_pro1 = 0;
            $main_cause_pro2 = 0;
            $main_cause_pro3 = 0;
            $main_cause_pro4 = 0;
            $main_cause_pro5 = 0;
            $main_cause_pro6 = 0;
        }
        
        
        
        $output = '<span>
                        The mood score is the average of questions 1 and 2 of the monthly check. The energy score is the
                        average of questions 3 and 4. The engagement score is the result of question 5.
                    </span>
                    <div class="card card-primary">
                        
                        <div class="card-body">
                            
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width:40%">Well-being score average</td>
                                        <td>';
                                        $output .= round($all_checks->average('percent'), 2);
                                        $output .= '%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Average mood</td>
                                        <td>';
                                        $output .= (round($all_checks->average('QA1'), 2)+
                                            round($all_checks->average('QA2'), 2))*10;
                                        $output .= '%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Average energy</td>
                                        <td>';
                                        $output .= (round($all_checks->average('QA3'), 2)+
                                            round($all_checks->average('QA4'), 2))*10;
                                        $output .= '%
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Average engagement</td>
                                        <td>';
                                        $output .= round($all_checks->average('QA5'), 2)*20;
                                        $output .= '%
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
                                        <td>'.$main_cause_pro1.'%</td>
                                    </tr>
                                    <tr>
                                        <td>Overloaded with work</td>
                                        <td>'.$main_cause_pro2.'%</td>
                                    </tr>
                                    <tr>
                                        <td>Frustrated with colleagues</td>
                                        <td>'.$main_cause_pro3.'%</td>
                                    </tr>
                                    <tr>
                                        <td>Lacking support to do the job</td>
                                        <td>'.$main_cause_pro4.'%</td>
                                    </tr>
                                    <tr>
                                        <td>Family issues</td>
                                        <td>'.$main_cause_pro5.'%</td>
                                    </tr>
                                    <tr>
                                        <td>Unclear expectations</td>
                                        <td>'.$main_cause_pro6.'%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card -->
                    </div>';
        echo $output;
    }
    // Populateion
    public function teamRisk(Request $request){
        $group_id = $request->group_id;

        $dates = $request->date;
        $dates = explode('-', $dates);
        $start_date = $dates[0];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_y = str_replace(' ', "", $start_y);
        $start_date = implode('-', array($start_y, $start_m, $start_d)); 
        $end_date = $dates[1];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_m = str_replace(' ', '', $end_m);
        $end_d = $end_date[1];
        $end_y = $end_date[2]; 
        $end_date = implode('-', array($end_y, $end_m, $end_d));

        $total_num = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_all_checks.check_datetime', [$start_date, $end_date])->where('checks_type', 1)->count();
        $high_risk_num = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_all_checks.check_datetime', [$start_date, $end_date])->where('checks_type', 1)->where('percent', '<=', 35)->count(); 
        $moderate_risk_num = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_all_checks.check_datetime', [$start_date, $end_date])->where('checks_type', 1)->whereBetween('percent', [35, 65])->count();
        $row_risk_num = All_checks::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_all_checks.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_all_checks.check_datetime', [$start_date, $end_date])->where('checks_type', 1)->where('percent', '>=', 65)->count();
        if ($total_num != 0) {
            $high_risk_pro = round($high_risk_num/$total_num*100, 2);
            $moderate_risk_pro = round($moderate_risk_num/$total_num*100, 2);
            $row_risk_pro = round($row_risk_num/$total_num*100, 2);
        } else {
            $high_risk_pro = 0;
            $moderate_risk_pro = 0;
            $row_risk_pro = 0;
        }
        
        $output = '<tbody>
                        <tr>
                            <td style="width:40%">High risk</td>
                            <td>'.$high_risk_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Moderate risk</td>
                            <td>'.$moderate_risk_pro.'%</td>
                        </tr>
                        <tr>
                            <td>Low risk</td>
                            <td>'.$row_risk_pro.'%</td>
                        </tr>
                    </tbody>';
        echo $output;
    }
    // Coaching
    public function teamCoach(Request $request){
        
        $group_id = $request->group_id;
        $dates = $request->date;
        $dates = explode('-', $dates);
        $start_date = $dates[0];
        $start_date = explode('/', $start_date);
        $start_m = $start_date[0];
        $start_d = $start_date[1];
        $start_y = $start_date[2];
        $start_y = str_replace(' ', "", $start_y);
        $start_date = implode('-', array($start_y, $start_m, $start_d)); 
        $end_date = $dates[1];
        $end_date = explode('/', $end_date);
        $end_m = $end_date[0];
        $end_m = str_replace(' ', '', $end_m);
        $end_d = $end_date[1];
        $end_y = $end_date[2]; 
        $end_date = implode('-', array($end_y, $end_m, $end_d));

        $coaching_sessions = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_group_admin_id', $group_id)
                ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->count();
        $average_coaching_rates = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_group_admin_id', $group_id)
                ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->get();
        $total_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_group_admin_id', $group_id)
                ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->get()->count();
        $unique_users = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_group_admin_id', $group_id)
                ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->get()->groupBy('user_id')->count();
        $returning_users = $total_users-$unique_users;
        if ($total_users != 0) {
            $returning_users_pro = $returning_users/$total_users*100;
        } else {
            $returning_users_pro = 0;
        }
        
        $total_reasons = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
        ->where('corporate_group_admin_id', $group_id)
        ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->get()->count();
        if ($total_reasons != 0) {
            $depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '1')->get()->count()/$total_reasons*100;
            $parenting_issues = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '2')->get()->count()/$total_reasons*100;
            $relationship_issues = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '3')->get()->count()/$total_reasons*100;
            $mourning = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '4')->get()->count()/$total_reasons*100;
            $conflicts = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '5')->get()->count()/$total_reasons*100;
            $self_confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '6')->get()->count()/$total_reasons*100;
            $addictions = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '7')->get()->count()/$total_reasons*100;
            $others = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                    ->where('corporate_group_admin_id', $group_id)
                    ->whereBetween('vieva_coaching_reports.report_date', [$start_date, $end_date])->where('motif_seance_id', '8')->get()->count()/$total_reasons*100;    
        } else {
            $depression = 0;
            $parenting_issues = 0;
            $relationship_issues = 0;
            $mourning = 0;
            $conflicts = 0;
            $self_confidence = 0;
            $addictions = 0;
            $others = 0;
        }
        
        

        $output = '<div class="card card-primary">
                
                    <div class="card-body">
                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td style="width:40%">Coaching sessions</td>
                                    <td>'.$coaching_sessions.'</td>
                                </tr>
                                <tr>
                                    <td>Average coach rating</td>
                                    <td>';
                                    $output .= round($average_coaching_rates->average('rating'), 2);
                                    $output .= ' stars</td>
                                </tr>
                                <tr>
                                    <td>Returning users</td>
                                    <td>'.round($returning_users_pro, 2).'%</td>
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
                                    <td>'.round($depression, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Parenting issues</td>
                                    <td>'.round($parenting_issues, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Relationship issues</td>
                                    <td>'.round($relationship_issues, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Mourning</td>
                                    <td>'.round($mourning, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Conflictss</td>
                                    <td>'.round($conflicts, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Self-confidence</td>
                                    <td>'.round($self_confidence, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Addictions</td>
                                    <td>'.round($addictions, 2).'%</td>
                                </tr>
                                <tr>
                                    <td>Others</td>
                                    <td>'.round($others, 2).'%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- /.card -->
                </div>';
        echo $output;
    }

}
