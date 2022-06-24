<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Model\All_checks;
use App\Model\Coaching_reports;
use App\Model\Corporate_clients;
use App\Model\Quotes;
use App\Model\Team_members;
use App\Model\Users_challenges;
use App\Model\User_activities_videos;
use App\Model\Videos_comments;
use App\Model\Video_likes;
use App\Model\Week_progress;
use App\User;
use DB;
use Illuminate\Http\Request;
use PDF;

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
        // General
        $registered_users = User::all()->count();
        $free_accounts = User::get()->where('user_level', '=', '4')->count();
        $premium_accounts = User::get()->where('user_level', '=', '3')->count();
        $corporate_accounts = User::get()->where('user_level', '=', '2')->count();
        $user = new User;
        $online_users = $user->allOnline()->count();
        $desktop_accounts = User::get()->where('platform', '=', 'desktop')->count();
        $desktop_pro = $desktop_accounts / $registered_users * 100;
        $mobile_pro = 100 - $desktop_pro;
        $french_users = User::get()->where('language', '=', 'french')->count();
        $french_users_pro = $french_users / $registered_users * 100;
        $english_users_pro = 100 - $french_users_pro;
        $week_checks = All_checks::where('checks_type', 0)->count();
        $month_checks = All_checks::where('checks_type', 1)->count();
        $video_views = User_activities_videos::all()->count();
        $video_likes = Video_likes::where('likes', 1)->count();
        $video_comments = Videos_comments::all()->count();
        $challenges_accepted = Users_challenges::where('accepted', 1)->count();
        $quotes = Quotes::all()->count();
        $week_progress = Week_progress::all();
        $all_checks = All_checks::where('checks_type', 1)->get();
        $coaching_sessions = Coaching_reports::all()->count();
        $average_coaching_rates = Coaching_reports::all();
        // $uniqued_users = Coaching_reports::get()->groupBy('user_id')->count();
        // $duplicated_users = Coaching_reports::get('user_id')->duplicates();
        // dd($duplicated_users);

        $total_reasons = Coaching_reports::all()->count();
        $depression = Coaching_reports::where('motif_seance_id', '1')->get()->count() / $total_reasons * 100;
        $parenting_issues = Coaching_reports::where('motif_seance_id', '2')->get()->count() / $total_reasons * 100;
        $relationship_issues = Coaching_reports::where('motif_seance_id', '3')->get()->count() / $total_reasons * 100;
        $mourning = Coaching_reports::where('motif_seance_id', '4')->get()->count() / $total_reasons * 100;
        $conflicts = Coaching_reports::where('motif_seance_id', '5')->get()->count() / $total_reasons * 100;
        $self_confidence = Coaching_reports::where('motif_seance_id', '6')->get()->count() / $total_reasons * 100;
        $addictions = Coaching_reports::where('motif_seance_id', '7')->get()->count() / $total_reasons * 100;
        $others = Coaching_reports::where('motif_seance_id', '8')->get()->count() / $total_reasons * 100;

        //Per Client
        $corporate_clients = Corporate_clients::all();
        $first_client = Corporate_clients::first();
        $first_client_id = Corporate_clients::first()->corporate_client_id;
        $start_date = $first_client->plan_starting_date;
        $end_date = $first_client->plan_expiration_date;
        $licence_num = $first_client->Number_licences;
        $general_licence_num = Corporate_clients::sum('Number_licences');
        $enrolled_users = Team_members::where('corporate_client_id', $first_client_id)->get()->count();
        $general_enrolled_users = Team_members::get()->count();
        $cor_online_users = 0;
        $cor_fr_users = DB::table('vieva_users')
            ->Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
            ->select('vieva_users.language')
            ->where('corporate_client_id', $first_client_id)
            ->where('language', 'french')
            ->count();
        $cor_fr_users_pro = $enrolled_users ? $cor_fr_users / $enrolled_users * 100 : 0;
        $cor_en_users_pro = 100 - $cor_fr_users_pro;
        $cor_web = DB::table('vieva_users')
            ->Join("vieva_team_members", 'vieva_team_members.user_id', '=', 'vieva_users.id')
            ->select('vieva_users.platform')
            ->where('corporate_client_id', $first_client_id)
            ->where('platform', 'desktop')
            ->count();
        $cor_web_pro = $enrolled_users ? $cor_web / $enrolled_users * 100 : 0;
        $cor_mobile_pro = 100 - $cor_web_pro;
        $cor_weekly = Week_progress::
            Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
        // ->select('vieva_users.language')
            ->where('corporate_client_id', $first_client_id)
            ->count();
        $cor_video_views = Video_likes::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_likes.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->count();
        $cor_video_likes = Video_likes::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_likes.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('likes', 1)
            ->count();
        $cor_video_comments = Videos_comments::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_comments.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->count();
        $cor_video_challenges = Users_challenges::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users_challenges.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('accepted', 1)
            ->count();
        $cor_quotes = Quotes::all()->count();
        // $cor_workload_ave =
        // $cor_stress_ave =
        // $cor_energy_ave =
        // $cor_overall_ave =
        $cor_coaching_session = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->count();
        $cor_ave_coaching = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->get();
        $cor_depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '1')
            ->count();

        if ($cor_depression > 0) {
            $cor_depression = $cor_depression / $cor_coaching_session * 100;
        }

        $cor_parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '2')
            ->count();

        if ($cor_parenting > 0) {
            $cor_parenting = $cor_parenting / $cor_coaching_session * 100;
        }

        $cor_relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '3')
            ->count();

        if ($cor_relationship > 0) {
            $cor_relationship = $cor_relationship / $cor_coaching_session * 100;
        }

        $cor_mourning = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '4')
            ->count();

        if ($cor_mourning > 0) {
            $cor_mourning = $cor_mourning / $cor_coaching_session * 100;
        }

        $cor_conflicts = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '5')
            ->count();

        if ($cor_conflicts > 0) {
            $cor_conflicts = $cor_conflicts / $cor_coaching_session * 100;
        }

        $cor_confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '6')
            ->count();

        if ($cor_confidence > 0) {
            $cor_confidence = $cor_confidence / $cor_coaching_session * 100;
        }

        $cor_addictions = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '7')
            ->count();

        if ($cor_addictions > 0) {
            $cor_addictions = $cor_addictions / $cor_coaching_session * 100;
        }

        $cor_others = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $first_client_id)
            ->where('motif_seance_id', '8')
            ->count();

        if ($cor_others > 0) {
            $cor_others = $cor_others / $cor_coaching_session * 100;
        }

        // Per User
        $users = User::whereNotIn('user_level', [0, 1, 2, 7])->get();
        $first_user = $users->first();
        $first_user_id = $first_user->id;
        $email = $first_user->email;
        $firstname = $first_user->first_name;
        $lastname = $first_user->last_name;
        // $con_status = $first_user->connection_status;
        $con_status = 'offline';
        // if ($con_status=0) {
        //     $con_status = 'offline';
        // } else {
        //     $con_status = 'online';
        // }
        $created_day = $first_user->last_login;
        $platform = $first_user->platform;
        $user_level = $first_user->user_level;
        if ($user_level = 0) {
            $user_level = 'superadmin';
        } elseif ($user_level = 1) {
            $user_level = 'admin';
        } elseif ($user_level = 2) {
            $user_level = 'corporate admin';
        } elseif ($user_level = 3) {
            $user_level = 'premium user';
        } elseif ($user_level = 4) {
            $user_level = 'free user';
        } elseif ($user_level = 5) {
            $user_level = 'guest';
        } elseif ($user_level = 6) {
            $user_level = 'coach';
        } elseif ($user_level = 7) {
            $user_level = 'corporate group';
        } else {
            $user_level = 'corporate user';
        }

        $sponsor = $first_user->sponsore_id;
        $user_start_day = 0;
        $user_end_day = 0;
        $user_language = $first_user->language;
        $user_week = 0;
        $user_month = 0;
        $user_views = Video_likes::where('user_id', $first_user_id)->count();
        $usage_time = 0;
        $user_likes = Video_likes::where('user_id', $first_user_id)->where('likes', 1)->count();
        $user_comments = Videos_comments::where('user_id', $first_user_id)->count();
        $user_challenges = Users_challenges::where('user_id', $first_user_id)->count();
        $quote_likes = 0;
        $user_coaching = Coaching_reports::where('user_id', $first_user_id)->count();
        $user_ave_rates = Coaching_reports::where('user_id', $first_user_id)->get();
        $user_depress = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 1)->count();
        if ($user_depress != 0) {
            $user_depress = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 1)->count() / $user_coaching * 100;
        } else {
            $user_depress = 0;
        }
        $user_parenting = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 2)->count();
        if ($user_parenting != 0) {
            $user_parenting = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 2)->count() / $user_coaching * 100;
        } else {
            $user_parenting = 0;
        }
        $user_relation = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 3)->count();
        if ($user_relation != 0) {
            $user_relation = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 3)->count() / $user_coaching * 100;
        } else {
            $user_relation = 0;
        }
        $user_mouring = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 4)->count();
        if ($user_mouring != 0) {
            $user_mouring = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 4)->count() / $user_coaching * 100;
        } else {
            $user_mouring = 0;
        }
        $user_conflict = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 5)->count();
        if ($user_conflict != 0) {
            $user_conflict = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 5)->count() / $user_coaching * 100;
        } else {
            $user_conflict = 0;
        }
        $user_confidence = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 6)->count();
        if ($user_confidence != 0) {
            $user_confidence = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 6)->count() / $user_coaching * 100;
        } else {
            $user_confidence = 0;
        }
        $user_addiction = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 7)->count();
        if ($user_addiction != 0) {
            $user_addiction = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 7)->count() / $user_coaching * 100;
        } else {
            $user_addiction = 0;
        }
        $user_others = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 8)->count();
        if ($user_others != 0) {
            $user_others = Coaching_reports::where('user_id', $first_user_id)->where('motif_seance_id', 8)->count() / $user_coaching * 100;
        } else {
            $user_others = 0;
        }

        return view('backend.superadmin.analytics', compact(
            'registered_users', 'free_accounts', 'premium_accounts',
            'corporate_accounts', 'online_users', 'desktop_pro', 'mobile_pro', 'french_users_pro', 'english_users_pro',
            'week_checks', 'month_checks', 'video_views', 'video_likes', 'video_comments',
            'challenges_accepted', 'quotes', 'week_progress', 'all_checks', 'coaching_sessions',
            'average_coaching_rates', 'depression', 'parenting_issues',
            'relationship_issues', 'mourning', 'conflicts', 'self_confidence', 'addictions',
            'others',
            'corporate_clients', 'start_date', 'end_date', 'licence_num', 'general_licence_num',
            'enrolled_users', 'general_enrolled_users', 'cor_online_users', 'cor_fr_users_pro', 'cor_en_users_pro',
            'cor_web_pro', 'cor_mobile_pro', 'cor_weekly', 'cor_video_views',
            'cor_video_likes', 'cor_video_comments', 'cor_video_challenges',
            'cor_quotes', 'cor_coaching_session', 'cor_ave_coaching',
            'cor_depression', 'cor_parenting', 'cor_relationship', 'cor_mourning',
            'cor_conflicts', 'cor_confidence', 'cor_addictions',
            'cor_others',
            'users',
            'email', 'firstname', 'lastname', 'con_status', 'created_day',
            'platform', 'user_level', 'sponsor', 'user_start_day', 'user_end_day',
            'user_language', 'user_week', 'user_month',
            'user_views', 'usage_time', 'user_likes',
            'user_comments', 'user_challenges', 'quote_likes',
            'user_coaching', 'user_ave_rates', 'user_depress',
            'user_parenting', 'user_relation', 'user_mouring',
            'user_conflict', 'user_confidence', 'user_addiction',
            'user_others'
        ));
    }

    // Per client
    public function showClient(Request $request)
    {
        $client_id = $request->get('corporate_id');
        $selected_corporate = Corporate_clients::where('corporate_client_id', $client_id)->first();
        $start_date = $selected_corporate['plan_starting_date'];
        $end_date = $selected_corporate['plan_expiration_date'];
        $licence_num = $selected_corporate['Number_licences'];
        $enrolled_users = Team_members::where('corporate_client_id', $client_id)->get()->count();
        $cor_online_users = 0;
        $cor_fr_users = DB::table('vieva_users')
            ->Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users.id')
            ->select('vieva_users.language')
            ->where('corporate_client_id', $client_id)
            ->where('language', 'french')
            ->count();
        $cor_fr_users_pro = $enrolled_users ? $cor_fr_users / $enrolled_users * 100 : 0;
        $cor_en_users_pro = 100 - $cor_fr_users_pro;
        $cor_web = DB::table('vieva_users')
            ->Join("vieva_team_members", 'vieva_team_members.user_id', '=', 'vieva_users.id')
            ->select('vieva_users.platform')
            ->where('corporate_client_id', $client_id)
            ->where('platform', 'desktop')
            ->count();
        $cor_web_pro = $enrolled_users ? $cor_web / $enrolled_users * 100 : 0;
        $cor_mobile_pro = 100 - $cor_web_pro;
        $cor_weekly = Week_progress::
            Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_week_progress.user_id')
        // ->select('vieva_users.language')
            ->where('corporate_client_id', $client_id)
            ->count();
        $cor_video_views = Video_likes::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_likes.user_id')
            ->where('corporate_client_id', $client_id)
            ->count();
        $cor_video_likes = Video_likes::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_likes.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('likes', 1)
            ->count();
        $cor_video_comments = Videos_comments::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_video_comments.user_id')
            ->where('corporate_client_id', $client_id)
            ->count();
        $cor_video_challenges = Users_challenges::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_users_challenges.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('accepted', 1)
            ->count();
        $cor_quotes = Quotes::all()->count();
        // $cor_workload_ave =
        // $cor_stress_ave =
        // $cor_energy_ave =
        // $cor_overall_ave =
        $cor_coaching_session = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->count();
        $cor_ave_coaching = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->get();
        $cor_depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '1')
            ->count();
        if ($cor_depression != 0) {
            $cor_depression = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '1')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_depression = 0;
        }
        $cor_parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '2')
            ->count();
        if ($cor_parenting != 0) {
            $cor_parenting = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '2')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_parenting = 0;
        }
        $cor_relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '3')
            ->count();
        if ($cor_relationship != 0) {
            $cor_relationship = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '3')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_relationship = 0;
        }
        $cor_mourning = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '4')
            ->count();
        if ($cor_mourning != 0) {
            $cor_mourning = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '4')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_mourning = 0;
        }
        $cor_conflicts = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '5')
            ->count();
        if ($cor_conflicts != 0) {
            $cor_conflicts = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '5')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_conflicts = 0;
        }
        $cor_confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '6')
            ->count();
        if ($cor_confidence != 0) {
            $cor_confidence = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '6')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_confidence = 0;
        }
        $cor_addictions = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '7')
            ->count();
        if ($cor_addictions != 0) {
            $cor_addictions = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '7')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_addictions = 0;
        }
        $cor_others = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
            ->where('corporate_client_id', $client_id)
            ->where('motif_seance_id', '8')
            ->count();
        if ($cor_others != 0) {
            $cor_others = Coaching_reports::Join('vieva_team_members', 'vieva_team_members.user_id', '=', 'vieva_coaching_reports.user_id')
                ->where('corporate_client_id', $client_id)
                ->where('motif_seance_id', '8')
                ->count() / $cor_coaching_session * 100;
        } else {
            $cor_others = 0;
        }

        $output = '<h4 class="pt-pb">General client status</h4>
        <div class="card card-primary">

            <div class="card-body">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Plan starting date</td>
                            <td>' . $start_date . '</td>
                        </tr>
                        <tr>
                            <td>Plan expiration date</td>
                            <td>' . $end_date . '</td>
                        </tr>
                        <tr>
                            <td>Number of licenses</td>
                            <td>' . $licence_num . '</td>
                        </tr>
                        <tr>
                            <td>Enrolled users</td>
                            <td>' . $enrolled_users . '</td>
                        </tr>
                        <tr>
                            <td>Online users</td>
                            <td>' . $cor_online_users . '</td>
                        </tr>
                        <tr>
                            <td>French language</td>
                            <td>' . round($cor_fr_users_pro, 2) . '%</td>
                        </tr>
                        <tr>
                            <td>English language</td>
                            <td>' . round($cor_en_users_pro, 2) . '%</td>
                        </tr>
                        <tr>
                            <td>Accounts created on mobile</td>
                            <td>' . round($cor_mobile_pro, 2) . '%</td>
                        </tr>
                        <tr>
                            <td>Accounts created on the web</td>
                            <td>' . round($cor_web_pro, 2) . '%</td>
                        </tr>
                        <tr>
                            <td>Weekly checks submitted</td>
                            <td>' . $cor_weekly . '</td>
                        </tr>
                        <tr>
                            <td>Monthly checks submitted</td>
                            <td>14</td>
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
                <input type="hidden" id="client_id" value="' . $client_id . '">
                <input type="text" id="client_engage" class="form-control float-right reservation">
            </div>
        </div>
        <div class="card card-primary">

            <div class="card-body">

                <table id="client_engage_html" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Video views</td>
                            <td>' . $cor_video_views . '</td>
                        </tr>
                        <tr>
                            <td>Video likes</td>
                            <td>' . $cor_video_likes . '</td>
                        </tr>
                        <tr>
                            <td>Video comments</td>
                            <td>' . $cor_video_comments . '</td>
                        </tr>
                        <tr>
                            <td>Challenges accepted</td>
                            <td>' . $cor_video_challenges . '</td>
                        </tr>
                        <tr>
                            <td>Quote likes</td>
                            <td>' . $cor_quotes . '</td>
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
                <input type="text" id="client_week" class="form-control float-right reservation">
            </div>
        </div>
        <div class="card card-primary">

            <div class="card-body">

                <table id="client_week_html" class="table table-bordered">
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
                <input type="text" id="client_month" class="form-control float-right reservation">
            </div>
        </div>
        <div id="client_month_html">
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
                <input type="text" id="client_population" class="form-control float-right reservation">
            </div>
        </div>
        <div class="card card-primary">

            <div class="card-body">

                <table id="client_population_html" class="table table-bordered">
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
                <input type="text" id="client_coaching" class="form-control float-right reservation">
            </div>
        </div>
        <div id="client_coaching_html">
            <div class="card card-primary">

                <div class="card-body">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:40%">Coaching sessions</td>
                                <td>' . $cor_coaching_session . '</td>
                            </tr>
                            <tr>
                                <td>Average coach rating</td>
                                <td>';
        foreach ($cor_ave_coaching as $ave_coaching) {
            $output .= round($ave_coaching->average('rating')) . ' stars';
        }

        $output .= '</td>
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
                                <td>' . round($cor_depression, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Parenting issues</td>
                                <td>' . round($cor_parenting, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Relationship issues</td>
                                <td>' . round($cor_relationship, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Mourning</td>
                                <td>' . round($cor_mourning, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Conflictss</td>
                                <td>' . round($cor_conflicts, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Self-confidence</td>
                                <td>' . round($cor_confidence, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Addictions</td>
                                <td>' . round($cor_addictions, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Others</td>
                                <td>' . round($cor_others, 2) . '%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- /.card -->
            </div>
        </div>';
        echo $output;
    }

    //Per user
    public function showPeruser(Request $request)
    {
        $peruser_id = $request->id;
        $peruser = User::where('id', $peruser_id)->first();
        $email = $peruser['email'];
        $firstname = $peruser->first_name;
        $lastname = $peruser->last_name;
        // $con_status = $peruser->connection_status;
        $con_status = 'offline';

        $created_day = $peruser->last_login;
        $platform = $peruser->platform;
        $user_level = $peruser->user_level;

        switch ($user_level) {
            case 0:
                $user_level = 'superadmin';
                break;
            case 1:
                $user_level = 'admin';
                break;
            case 2:
                $user_level = 'corporate';
                break;
            case 3:
                $user_level = 'premium user';
                break;
            case 4:
                $user_level = 'free user';
                break;
            case 5:
                $user_level = 'guest';
                break;
            case 6:
                $user_level = 'coach';
                break;
            case 7:
                $user_level = 'corporate group';
                break;
            case 8:
                $user_level = 'corporate user';
            default:
                $user_level = $peruser->user_level;
                break;
        }

        $sponsor = $peruser->sponsore_id;
        $user_start_day = 0;
        $user_end_day = 0;
        $user_language = $peruser->language;
        $user_week = 0;
        $user_month = 0;
        $user_views = Video_likes::where('user_id', $peruser_id)->count();
        $usage_time = 0;
        $user_likes = Video_likes::where('user_id', $peruser_id)->where('likes', 1)->count();
        $user_comments = Videos_comments::where('user_id', $peruser_id)->count();
        $user_challenges = Users_challenges::where('user_id', $peruser_id)->count();
        $quote_likes = 0;
        $user_coaching = Coaching_reports::where('user_id', $peruser_id)->count();
        $user_ave_rates = Coaching_reports::where('user_id', $peruser_id)->get();

        $user_depress = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 1)->count();
        if ($user_depress != 0) {
            $user_depress = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 1)->count() / $user_coaching * 100;
        } else {
            $user_depress = 0;
        }
        $user_parenting = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 2)->count();
        if ($user_parenting != 0) {
            $user_parenting = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 2)->count() / $user_coaching * 100;
        } else {
            $user_parenting = 0;
        }
        $user_relation = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 3)->count();
        if ($user_relation != 0) {
            $user_relation = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 3)->count() / $user_coaching * 100;
        } else {
            $user_relation != 0;
        }
        $user_mouring = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 4)->count();
        if ($user_mouring != 0) {
            $user_mouring = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 4)->count() / $user_coaching * 100;
        } else {
            $user_mouring = 0;
        }
        $user_conflict = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 5)->count();
        if ($user_conflict != 0) {
            $user_conflict = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 5)->count() / $user_coaching * 100;
        } else {
            $user_conflict = 0;
        }
        $user_confidence = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 6)->count();
        if ($user_confidence != 0) {
            $user_confidence = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 6)->count() / $user_coaching * 100;
        } else {
            $user_confidence = 0;
        }
        $user_addiction = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 7)->count();
        if ($user_addiction != 0) {
            $user_addiction = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 7)->count() / $user_coaching * 100;
        } else {
            $user_addiction = 0;
        }
        $user_others = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 8)->count();
        if ($user_others != 0) {
            $user_others = Coaching_reports::where('user_id', $peruser_id)->where('motif_seance_id', 8)->count() / $user_coaching * 100;
        } else {
            $user_others = 0;
        }

        $output = '<h4 class="pt-pb">General user status</h4>
        <div class="card card-primary">

            <div class="card-body">

                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Email</td>
                            <td>' . $email . '</td>
                        </tr>
                        <tr>
                            <td>First name</td>
                            <td>' . $firstname . '</td>
                        </tr>
                        <tr>
                            <td>Last name</td>
                            <td>' . $lastname . '</td>
                        </tr>
                        <tr>
                            <td>Connection status</td>
                            <td>' . $con_status . '</td>
                        </tr>
                        <tr>
                            <td>Account creation date</td>
                            <td>' . $created_day . '</td>
                        </tr>
                        <tr>
                            <td>Account creation platform</td>
                            <td>' . $platform . '</td>
                        </tr>
                        <tr>
                            <td>Account type</td>
                            <td>' . $user_level . '</td>
                        </tr>
                        <tr>
                            <td>Sponsor</td>
                            <td>' . $sponsor . '</td>
                        </tr>
                        <tr>
                            <td>Plan starting date</td>
                            <td>' . $user_start_day . '</td>
                        </tr>
                        <tr>
                            <td>Plan expiration date</td>
                            <td>' . $user_end_day . '</td>
                        </tr>
                        <tr>
                            <td>Language</td>
                            <td>' . $user_language . '</td>
                        </tr>
                        <tr>
                            <td>Weekly checks submitted</td>
                            <td>' . $user_week . '</td>
                        </tr>
                        <tr>
                            <td>Monthly checks submitted</td>
                            <td>' . $user_month . '</td>
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
                <input type="hidden" id="user_id" value="' . $peruser_id . '"/>
                <input type="text" id="user_engage" class="form-control float-right reservation">
            </div>
        </div>
        <div class="card card-primary">

            <div class="card-body">

                <table id="user_engage_html" class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="width:40%">Video views</td>
                            <td>' . $user_views . '</td>
                        </tr>
                        <tr>
                            <td>Usage time (minutes)</td>
                            <td>' . $usage_time . '</td>
                        </tr>
                        <tr>
                            <td>Video likes</td>
                            <td>' . $user_likes . '</td>
                        </tr>
                        <tr>
                            <td>Video comments</td>
                            <td>' . $user_comments . '</td>
                        </tr>
                        <tr>
                            <td>Challenges accepted</td>
                            <td>' . $user_challenges . '</td>
                        </tr>
                        <tr>
                            <td>Quote likes</td>
                            <td>' . $quote_likes . '</td>
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
                <input type="text" id="user_week" class="form-control float-right reservation">
            </div>
        </div>
        <div class="card card-primary">

            <div class="card-body">

                <table id="user_week_html" class="table table-bordered">
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
                <input type="text" id="user_month" class="form-control float-right reservation">
            </div>
        </div>
        <div id="user_month_html">
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
                <input type="text" id="user_coaching" class="form-control float-right reservation">
            </div>
        </div>
        <div id="user_coaching_html">
            <div class="card card-primary">

                <div class="card-body">

                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td style="width:40%">Coaching sessions</td>
                                <td>' . $user_coaching . '</td>
                            </tr>
                            <tr>
                                <td>Average coach rating</td>
                                <td>';

        // foreach ($user_ave_rates as $user_ave_rate) {
        $output .= round($user_ave_rates->average('rating'));
        // }

        $output .= ' stars</td>
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
                                <td>' . round($user_depress, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Parenting issues</td>
                                <td>' . round($user_parenting, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Relationship issues</td>
                                <td>' . round($user_relation, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Mourning</td>
                                <td>' . round($user_mouring, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Conflictss</td>
                                <td>' . round($user_conflict, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Self-confidence</td>
                                <td>' . round($user_confidence, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Addictions</td>
                                <td>' . round($user_addiction, 2) . '%</td>
                            </tr>
                            <tr>
                                <td>Others</td>
                                <td>' . round($user_others, 2) . '%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <!-- /.card -->
            </div>
        </div>';
        echo $output;
    }

    public function GenerateReportsPDF()
    {
        $data = [];

        return view('reports-pdf');

        // share data to view
        view()->share('title', "title");
        $pdf = PDF::loadView('reports-pdf', $data)->setPaper('a4', 'landscape');

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }

}
