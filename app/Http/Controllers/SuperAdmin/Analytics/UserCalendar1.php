<?php

namespace App\Http\Controllers\SuperAdmin\Analytics;

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
use App\Model\Quote_likes;
use App\Model\Coaching_reports;
use App\Model\Motif_seance;
use App\Model\Corporate_clients; 
use App\Model\Corporate_groups;
use App\Model\All_checks;
use DB;

class UserCalendar1 extends Controller 
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

 
    ////////////////////////////////// User Calender /////////////////////////////
    // Engagement
    public function engageUser(Request $request){
        $dates = $request->date;
        $user_id = $request->user_id;
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

        $user_views = Video_likes::whereBetween('date', [$start_date, $end_date])
                                ->where('user_id', $user_id)->count();
        $usage_time = 0;
        $user_likes = Video_likes::whereBetween('date', [$start_date, $end_date])
                                ->where('user_id', $user_id)->where('likes', 1)->count();
        $user_comments = Videos_comments::whereBetween('date', [$start_date, $end_date])
                                ->where('user_id', $user_id)->count();
        $user_challenges = Users_challenges::whereBetween('date', [$start_date, $end_date])
                                ->where('user_id', $user_id)->count();
        $quote_likes = Quote_likes::whereBetween('creation_date', [$start_date, $end_date])
                                ->where('user_id', $user_id)->count();
        $output = '<tbody>
                        <tr>
                            <td style="width:40%">Video views</td>
                            <td>'.$user_views.'</td>
                        </tr>
                        <tr>
                            <td>Usage time (minutes)</td>
                            <td>'.$usage_time.'</td>
                        </tr>
                        <tr>
                            <td>Video likes</td>
                            <td>'.$user_likes.'</td>
                        </tr>
                        <tr>
                            <td>Video comments</td>
                            <td>'.$user_comments.'</td>
                        </tr>
                        <tr>
                            <td>Challenges accepted</td>
                            <td>'.$user_challenges.'</td>
                        </tr>
                        <tr>
                            <td>Quote likes</td>
                            <td>'.$quote_likes.'</td>
                        </tr>
                    </tbody>';
        echo $output;
    }
    // Weekly
    public function weekUser(Request $request){
        $dates = $request->date;
        $user_id = $request->user_id;
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

        $week_progress = Week_progress::where('user_id', $user_id)
                            ->whereBetween('date', [$start_date, $end_date])
                            ->get();
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
    public function monthUser(Request $request){
        $dates = $request->date;
        $user_id = $request->user_id;
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

        $all_checks = All_checks::where('user_id', $user_id)
                            ->whereBetween('check_datetime', [$start_date, $end_date])
                            ->where('checks_type', 1)
                            ->get();
        $tatal_num = $all_checks->count();
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
    // Coaching
    public function coachingUser(Request $request){
        $dates = $request->date;
        $user_id = $request->user_id;
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

        $user_coaching = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])
                            ->where('user_id', $user_id)->count();

        $user_ave_rates = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])
                            ->where('user_id', $user_id)->get();
        

        $user_depress = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 1)->count();
        if ($user_depress != 0) {
            $user_depress = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 1)->count()/$user_coaching*100;
        } else {
            $user_depress = 0;
        }
        $user_parenting = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 2)->count();
        if ($user_parenting !=0) {
            $user_parenting = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 2)->count()/$user_coaching*100;
        } else {
            $user_parenting = 0;
        }
        $user_relation = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 3)->count();
        if ($user_relation != 0) {
            $user_relation = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 3)->count()/$user_coaching*100;    
        } else {
            $user_relation = 0;
        }
        $user_mouring = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 4)->count();
        if ($user_mouring != 0) {
            $user_mouring = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 4)->count()/$user_coaching*100;
        } else {
            $user_mouring = 0;
        }
        $user_conflict = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 5)->count();
        if ($user_conflict != 0) {
            $user_conflict = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 5)->count()/$user_coaching*100;    
        } else {
            $user_conflict = 0;
        }
        $user_confidence = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 6)->count();
        if ($user_confidence != 0) {
            $user_confidence = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 6)->count()/$user_coaching*100;    
        } else {
            $user_confidence = 0;
        }
        $user_addiction = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 7)->count();
        if ($user_addiction != 0) {
            $user_addiction = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 7)->count()/$user_coaching*100;    
        } else {
            $user_addiction = 0;
        }
        $user_others = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 8)->count();
        if ($user_others != 0) {
            $user_others = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->where('user_id', $user_id)->where('motif_seance_id', 8)->count()/$user_coaching*100;    
        } else {
            $user_others = 0;
        }
        $output = '<div class="card card-primary">
                    
                        <div class="card-body">
                            
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="width:40%">Coaching sessions</td>
                                        <td>'.$user_coaching.'</td>
                                    </tr>
                                    <tr>
                                        <td>Average coach rating</td>
                                        <td>';
                                        $output .= round($user_ave_rates->sum('rating'));
                                        $output .=' stars</td>
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
                                        <td>'.round($user_depress, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Parenting issues</td>
                                        <td>'.round($user_parenting, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Relationship issues</td>
                                        <td>'.round($user_relation, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Mourning</td>
                                        <td>'.round($user_mouring, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Conflictss</td>
                                        <td>'.round($user_conflict, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Self-confidence</td>
                                        <td>'.round($user_confidence, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Addictions</td>
                                        <td>'.round($user_addiction, 2).'%</td>
                                    </tr>
                                    <tr>
                                        <td>Others</td>
                                        <td>'.round($user_others, 2).'%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    <!-- /.card -->
                    </div>';
        echo $output;
    }
    
}
