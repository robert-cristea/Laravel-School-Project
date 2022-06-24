<?php

namespace App\Http\Controllers\SuperAdmin\AnalyticsCharts;

use App\Http\Controllers\Controller;
use App\Model\All_checks;
use App\Model\Coaching_reports;
use App\Model\Week_progress;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class GeneralController extends Controller
{
    public function weekly_check(Request $request)
    {
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

        $week_progress = Week_progress::whereBetween('date', [$start_date, $end_date])->orderBy('date')->get();
        // $labels = Week_progress::whereBetween('date', [$start_date, $end_date])->pluck('date');
        $labels = Arr::pluck($week_progress, 'ymd');
        $workload = Week_progress::whereBetween('date', [$start_date, $end_date])->pluck('workload_level');
        $stress = Week_progress::whereBetween('date', [$start_date, $end_date])->pluck('stress_level');
        $energy = Week_progress::whereBetween('date', [$start_date, $end_date])->pluck('energy_level');

        $overall_average = round(($week_progress->average("workload_level") +
            $week_progress->average("stress_level") +
            $week_progress->average("energy_level")) / 3, 2);
        $overall_average .= '/5';

        $workload_average = round($week_progress->average("workload_level"), 2);
        $workload_average .= '/5';

        $stress_average = round($week_progress->average("stress_level"), 2);
        $stress_average .= '/5';

        $energy_average = round($week_progress->average("energy_level"), 2);
        $energy_average .= '/5';

        return response(compact(
            'week_progress',
            'labels',
            'overall_average',
            'workload_average',
            'stress_average',
            'energy_average',
            'workload',
            'stress',
            'energy',
        ));
    }

    public function monthly_check(Request $request)
    {
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

        $all_checks = All_checks::whereBetween('check_datetime', [$start_date, $end_date])->where('checks_type', 1)->get();
        $tatal_num = $all_checks->count();
        $main_cause_num1 = 0;
        $main_cause_num2 = 0;
        $main_cause_num3 = 0;
        $main_cause_num4 = 0;
        $main_cause_num5 = 0;
        $main_cause_num6 = 0;
        foreach ($all_checks as $all_check) {
            $value1 = explode(',', $all_check->QA6)[0];
            $value2 = explode(',', $all_check->QA6)[1];
            $value3 = explode(',', $all_check->QA6)[2];
            $value4 = explode(',', $all_check->QA6)[3];
            $value5 = explode(',', $all_check->QA6)[4];
            $value6 = explode(',', $all_check->QA6)[5];
            if ($value1 == 'true') {
                $main_cause_num1++;
            }
            if ($value2 == 'true') {
                $main_cause_num2++;
            }
            if ($value3 == 'true') {
                $main_cause_num3++;
            }
            if ($value4 == 'true') {
                $main_cause_num4++;
            }
            if ($value5 == 'true') {
                $main_cause_num5++;
            }
            if ($value6 == 'true') {
                $main_cause_num6++;
            }
        }
        if ($tatal_num != 0) {
            $main_cause_pro1 = round($main_cause_num1 / $tatal_num * 100, 2);
            $main_cause_pro2 = round($main_cause_num2 / $tatal_num * 100, 2);
            $main_cause_pro3 = round($main_cause_num3 / $tatal_num * 100, 2);
            $main_cause_pro4 = round($main_cause_num4 / $tatal_num * 100, 2);
            $main_cause_pro5 = round($main_cause_num5 / $tatal_num * 100, 2);
            $main_cause_pro6 = round($main_cause_num6 / $tatal_num * 100, 2);
        } else {
            $main_cause_pro1 = 0;
            $main_cause_pro2 = 0;
            $main_cause_pro3 = 0;
            $main_cause_pro4 = 0;
            $main_cause_pro5 = 0;
            $main_cause_pro6 = 0;
        }

        $wellbeing_val = round($all_checks->average('percent'), 2);
        $wellbeing = [
            'data' => [$wellbeing_val, 100 - $wellbeing_val],
            'backgroundColor' => ['coral', '#f2f3f8'],
            'labels' => ['Wellbeing Average (%)', ''],
        ];
        $mood_val = (round($all_checks->average('QA1'), 2) + round($all_checks->average('QA2'), 2)) * 10;
        $mood = [
            'data' => [$mood_val, 100 - $mood_val],
            'backgroundColor' => ['#5064ed', '#e9fabe'],
            'labels' => ['Mood Average Score (%)', ''],
        ];

        $energy_val = round(((round($all_checks->average('QA3'), 2) + round($all_checks->average('QA4'), 2)) * 10), 2);
        $energy = [
            'data' => [$energy_val, 100 - $energy_val],
            'backgroundColor' => ['#5064ed', '#e9fabe'],
            'labels' => ['Energy Average Score (%)', ''],
        ];
        $engagement_val = round($all_checks->average('QA5'), 2) * 20;
        $engagement = [
            'data' => [$engagement_val, 100 - $engagement_val],
            'backgroundColor' => ['#5064ed', '#e9fabe'],
            'labels' => ['Engagement Average Score (%)', ''],
        ];

        $main_causes_table = '<table class="table">
                    <tbody>
                        <tr>
                            <td style="" class="badge badge-info">1</td>
                            <td style="width:100%;">Current project not engaging</td>
                            <td style="" class="badge badge-info">' . $main_cause_pro1 . '%</td>
                        </tr>
                        <tr>
                            <td class="badge badge-info">2</td>
                            <td>Overloaded with work</td>
                            <td class="badge badge-info">' . $main_cause_pro2 . '%</td>
                        </tr>
                        <tr>
                            <td class="badge badge-info">3</td>
                            <td>Frustrated with colleagues</td>
                            <td class="badge badge-info">' . $main_cause_pro3 . '%</td>
                        </tr>
                        <tr>
                            <td class="badge badge-info">4</td>
                            <td>Lacking support to do the job</td>
                            <td class="badge badge-info">' . $main_cause_pro4 . '%</td>
                        </tr>
                        <tr>
                            <td class="badge badge-info">5</td>
                            <td>Family issues</td>
                            <td class="badge badge-info">' . $main_cause_pro5 . '%</td>
                        </tr>
                        <tr>
                            <td class="badge badge-info">6</td>
                            <td>Unclear expectations</td>
                            <td class="badge badge-info">' . $main_cause_pro6 . '%</td>
                        </tr>
                    </tbody>
                </table>';

        return response(compact(
            'wellbeing',
            'mood',
            'energy',
            'engagement',
            'main_causes_table',
        ));
    }

    // Populateion
    public function population_risk_distribution(Request $request)
    {
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

        $total_num = All_checks::whereBetween('check_datetime', [$start_date, $end_date])->where('checks_type', 1)->count();
        $high_risk_num = All_checks::whereBetween('check_datetime', [$start_date, $end_date])->where('checks_type', 1)->where('percent', '<=', 35)->count();
        $moderate_risk_num = All_checks::whereBetween('check_datetime', [$start_date, $end_date])->where('checks_type', 1)->whereBetween('percent', [35, 65])->count();
        $row_risk_num = All_checks::whereBetween('check_datetime', [$start_date, $end_date])->where('checks_type', 1)->where('percent', '>=', 65)->count();
        if ($total_num != 0) {
            $high_risk_pro = round($high_risk_num / $total_num * 100, 2);
            $moderate_risk_pro = round($moderate_risk_num / $total_num * 100, 2);
            $row_risk_pro = round($row_risk_num / $total_num * 100, 2);
        } else {
            $high_risk_pro = 0;
            $moderate_risk_pro = 0;
            $row_risk_pro = 0;
        }

        $chart = [
            'data' => [$high_risk_pro, $moderate_risk_pro, $row_risk_pro, (100 - $high_risk_pro - $moderate_risk_pro - $row_risk_pro)],
            'backgroundColor' => ['#f3a633', '#e93f33', '#6ed326', '#f2f3f8'],
            'labels' => ['High risk (%)', 'Moderate risk (%)', 'Low risk (%)', ''],
        ];
        return response(compact('chart'));
    }

    // Coaching
    public function coaching_report(Request $request)
    {
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

        $average_coaching_rates = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->get()->groupBy('status');
        $average_coaching_rates_createdat = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->get()->groupBy('status')->groupBy('report_date');
        // $unique_users = Coaching_reports::whereBetween('report_date', [$start_date, $end_date])->get()->groupBy('user_id')->count();

        return response(compact(
            'average_coaching_rates',
            'average_coaching_rates_createdat',
        ));
    }
}
