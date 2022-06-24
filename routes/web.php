<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// Route::get('/', function () {
//     return view("welcome");
// });
Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/web3', function (){
   return view('web3');
});
Route::get('/web3-login-message', 'Web3LoginController@message');
Route::post('/web3-login-verify', 'Web3LoginController@verify');
Auth::routes();
Auth::routes(['verify' => true]);
Route::get('logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify/{validation_key}', 'SuperAdmin\ActivationController@activateAccountsByValidationkey');

Route::get('generate-pdf', 'PDFController@generatePDF');

// Multi dashboard
// Route::get('/superadmin', 'SuperAdmin\AnalyticsController@index')->name('superadmin')->middleware('superadmin');
// Route::get('/corporateadmin', 'CorporateAdmin\AnalyticsController@index')->name('corporateadmin')->middleware('corporateadmin');
// Route::get('/teamadmin', 'TeamAdmin\AnalyticsController@index')->name('teamadmin')->middleware('teamadmin');
// Route::get('/premiumuser', 'HomeController@index')->name('premiumuser')->middleware('premiumuser');
// Route::get('/freeuser', 'HomeController@index')->name('freeuser')->middleware('freeuser');
// Route::get('/guestuser', 'HomeController@index')->name('guestuser')->middleware('guestuser');
// Route::get('/coach', 'HomeController@index')->name('coach')->middleware('coach');
// Route::get('/corporategroupadmin', 'HomeController@index')->name('corporategroupadmin')->middleware('corporategroupadmin');
// Route::get('/corporateuser', 'HomeController@index')->name('corporateuser')->middleware('corporateuser');

////////////////////////////////////
Route::get('/superadmin', 'SuperAdmin\AnalyticsController@index')->name('superadmin')->middleware('verified');
Route::get('/admin', 'HomeController@index')->name('admin')->middleware('admin');
Route::get('/corporateadmin', 'CorporateAdmin\AnalyticsController@index')->name('corporateadmin')->middleware('corporateadmin');
Route::get('/corporategroupadmin', 'TeamAdmin\AnalyticsController@index')->name('corporategroupadmin')->middleware('corporategroupadmin');
Route::get('/premiumuser', 'HomeController@index')->name('premiumuser')->middleware('premiumuser');
Route::get('/freeuser', 'HomeController@index')->name('freeuser')->middleware('freeuser');
Route::get('/guestuser', 'HomeController@index')->name('guestuser')->middleware('guestuser');
Route::get('/coach', 'HomeController@index')->name('coach')->middleware('coach');
Route::get('/corporateuser', 'HomeController@index')->name('corporateuser')->middleware('corporateuser');

Route::get('/import-csv-coaching', 'SuperAdmin\CoachingController@getUploadCSVStep1')->name('import-csv-coaching');
Route::post('import-csv-coaching', 'SuperAdmin\CoachingController@postUploadCSVStep1')->name('upload-csv-coaching');

// Superadmin dashboard
Route::get('/analytics', 'SuperAdmin\AnalyticsController@index')->name('analytics');
Route::get('/content', 'SuperAdmin\ContentController@index')->name('content');
Route::get('/administration', 'SuperAdmin\AdministrationController@index')->name('administration');
Route::get('/activation', 'SuperAdmin\ActivationController@index')->name('activation');

Route::get('/coaching', 'SuperAdmin\CoachingController@index')->name('coaching');
Route::post('/coaching', 'SuperAdmin\CoachingController@searchIndex')->name('searchIndex');
Route::post('/savecoaching', 'SuperAdmin\CoachingController@saveCoach')->name('saveCoach');
Route::post('/editcoaching', 'SuperAdmin\CoachingController@editcoach')->name('editCoach');
Route::delete('/deletecoaching/{id}', 'SuperAdmin\CoachingController@deleteCoaching')->name('coaching.delete');
Route::post('/show_report_user', 'SuperAdmin\CoachingController@showReportUser');

// Challenges
Route::get('/challenge', 'SuperAdmin\ChallengeController@index')->name('challenge');
Route::post('/savechallenge', 'SuperAdmin\ChallengeController@saveChallenge')->name('saveChallenge');
Route::post('/editchallenge/{id}', 'SuperAdmin\ChallengeController@editChallenge')->name('editChallenge');
Route::delete('/deletechallenge/{id}', 'SuperAdmin\ChallengeController@deleteChallenge')->name('challenge.delete');

// Notification
Route::get('/notification', 'SuperAdmin\NotificationController@index')->name('notification');
Route::post('/notification', 'SuperAdmin\NotificationController@addNotify')->name('addNotify');
Route::get('/notification/{id}', 'SuperAdmin\NotificationController@deleteNotify')->name('deleteNotify');

// Series
Route::post('series_add', 'SuperAdmin\Content\SeriesController@addSeries')->name('addSeries');
Route::post('series_edit/{id}', 'SuperAdmin\Content\SeriesController@editSeries')->name('editSeries');
Route::delete('series_delete/{id}', 'SuperAdmin\Content\SeriesController@delete')->name('serieDestroy');
Route::post('series_display', 'SuperAdmin\Content\SeriesController@seriesDisplay')->name('seriesDisplay');

// Lessons
Route::post('lesson_add', 'SuperAdmin\Content\LessonsController@addLesson')->name('addLesson');
Route::post('lesson_edit/{id}', 'SuperAdmin\Content\LessonsController@editLesson')->name('editLesson');
Route::delete('lesson_delete/{id}', 'SuperAdmin\Content\LessonsController@deleteLesson')->name('deleteLesson');
Route::get('lesson_order/{orgin_id}/{target_id}/{origin_val}/{target_val}', "SuperAdmin\Content\LessonsController@set_order");

// Quotes  addQuote
Route::post('quote_add', 'SuperAdmin\Content\QuotesController@addQuote')->name('addQuote');
Route::post('quote_edit/{id}', 'SuperAdmin\Content\QuotesController@editQuote')->name('editQuote');
Route::delete('quote_delete/{id}', 'SuperAdmin\Content\QuotesController@deleteQuote')->name('deleteQuote');

// Tools editTool
Route::post('tool_edit/{id}', 'SuperAdmin\Content\ToolsController@editTool')->name('editTool');

// Editing superadmin
Route::post('update_superadmin/{id}', 'SuperAdmin\Administration\AdminsController@updateSuperadmin')->name('superadmin_update');

// Adding admin
Route::post('add_admin', 'SuperAdmin\Administration\AdminsController@addAdmin')->name('admin_add');
Route::post('edit_admin/{id}', 'SuperAdmin\Administration\AdminsController@editAdmin')->name('admin-edit');
Route::delete('delete_admin{id}', 'SuperAdmin\Administration\AdminsController@deleteAdmin')->name('admin-delete');

// Adding Client client.add
Route::post('add_corporateadmin', 'SuperAdmin\Administration\ClientsController@addCorporateadmin')->name('corporateadmin.add');
Route::post('update_corporateadmin/{id}', 'SuperAdmin\Administration\ClientsController@updateCorporateadmin')->name('corporateadmin.edit');
Route::delete('delete_corporateadmin/{id}', 'SuperAdmin\Administration\ClientsController@deleteCorporateadmin')->name('corporateadmin.delete');

// Add, update and delete Corporate admin
Route::post('add_client', 'SuperAdmin\Administration\ClientsController@addClient')->name('client.add');
Route::post('update_client/{id}', 'SuperAdmin\Administration\ClientsController@updateClient')->name('client.update');
Route::delete('delete_client/{id}', 'SuperAdmin\Administration\ClientsController@deleteClient')->name('client.delete');

// Showing Teams
Route::post('show_team', 'SuperAdmin\Administration\TeamsController@showTeam');
// autocomplete admin
Route::post('coporateuser/fetch', 'SuperAdmin\Administration\TeamsController@fetchCorporateuser');
// Add, Edit and Delete team
Route::post('/add_team', 'SuperAdmin\Administration\TeamsController@createTeam')->name('team.create');
Route::post('/edit_team/{id}', 'SuperAdmin\Administration\TeamsController@editTeam')->name('team.edit');
Route::delete('/delete_team/{id}', 'SuperAdmin\Administration\TeamsController@deleteTeam')->name('team.delete');

Route::post('/addnew_team', 'SuperAdmin\Administration\TeamsController@newaddTeam')->name('team.newadd');
Route::post('/editnew_team/{id}', 'SuperAdmin\Administration\TeamsController@neweditTeam')->name('team.newedit');
Route::delete('/deletenew_team/{id}', 'SuperAdmin\Administration\TeamsController@newdeleteTeam')->name('team.newdelete');
// Route::post('/add_team', 'SuperAdmin\Administration\TeamsController@addTeam')->name('new_addTeam');
// Add, Edit and Delete team_admin
Route::post('/add_teamadmin', 'SuperAdmin\Administration\TeamsController@addTeamadmin')->name('teamadmin.add');
Route::post('/edit_teamadmin/{id}', 'SuperAdmin\Administration\TeamsController@eidtTeamadmin')->name('teamadmin.edit');
Route::delete('/delete_teamadmin/{id}', 'SuperAdmin\Administration\TeamsController@deleteTeamadmin')->name('teamadmin.delete');

Route::post('/add_newteamadmin', 'SuperAdmin\Administration\TeamsController@addnewTeamadmin')->name('newteamadmin.add');
Route::post('/edit_newteamadmin/{id}', 'SuperAdmin\Administration\TeamsController@eidtnewTeamadmin')->name('newteamadmin.edit');
Route::delete('/delete_newteamadmin/{id}', 'SuperAdmin\Administration\TeamsController@deletenewTeamadmin')->name('newteamadmin.delete');
// Edit and Delete user
Route::post('/add_user', 'SuperAdmin\Administration\UsersController@addUser')->name('user.add');
Route::post('/edit_user/{id}', 'SuperAdmin\Administration\UsersController@eidtUser')->name('user.edit');
Route::delete('/delete_user/{id}', 'SuperAdmin\Administration\UsersController@deleteUser')->name('user.delete');
Route::post('/show_User', 'SuperAdmin\Administration\UsersController@showUser');

Route::post('/add_newuser', 'SuperAdmin\Administration\UsersController@addtnewUser');
Route::post('/edit_newuser/{id}', 'SuperAdmin\Administration\UsersController@eidtnewUser');
Route::delete('/delete_newuser/{id}', 'SuperAdmin\Administration\UsersController@deletenewUser');
// SuperAdmin Page
Route::post('/show_client', 'SuperAdmin\AnalyticsController@showClient');
Route::post('/show_peruser', 'SuperAdmin\AnalyticsController@showPeruser');

//////// Superadmin //////////////
//////// General calender //////////////
Route::post('/super_engage_general', 'SuperAdmin\Analytics\GeneralCalendar@showEngageGeneral');
Route::post('/super_monthly_general', 'SuperAdmin\Analytics\GeneralCalendar@showMonthlyGeneral');
Route::post('/super_weekly_general', 'SuperAdmin\Analytics\GeneralCalendar@showWeeklyGeneral');
Route::post('/super_population_general', 'SuperAdmin\Analytics\GeneralCalendar@showPopulationGeneral');
Route::post('/super_coaching_general', 'SuperAdmin\Analytics\GeneralCalendar@showCoachingGeneral');
//////// Superadmin //////////////
//////// Client calender0 //////////////
Route::post('/super_engage_client', 'SuperAdmin\Analytics\ClientCalendar@showEngageClient');
Route::post('/super_monthly_client', 'SuperAdmin\Analytics\ClientCalendar@showMonthlyClient');
Route::post('/super_weekly_client', 'SuperAdmin\Analytics\ClientCalendar@showWeeklyClient');
Route::post('/super_population_client', 'SuperAdmin\Analytics\ClientCalendar@showPopulationClient');
Route::post('/super_coaching_client', 'SuperAdmin\Analytics\ClientCalendar@showCoachingClient');
//////// Client calender1 //////////////
Route::post('/client_engage', 'SuperAdmin\Analytics\ClientCalendar1@engageClient');
Route::post('/client_week', 'SuperAdmin\Analytics\ClientCalendar1@weekClient');
Route::post('/client_month', 'SuperAdmin\Analytics\ClientCalendar1@monthClient');
Route::post('/client_population', 'SuperAdmin\Analytics\ClientCalendar1@populationClient');
Route::post('/client_coaching', 'SuperAdmin\Analytics\ClientCalendar1@coachingClient');
//////// Superadmin //////////////
//////// User calender0 //////////////
Route::post('/super_engage_user', 'SuperAdmin\Analytics\UserCalendar@showEngageUser');
Route::post('/super_monthly_user', 'SuperAdmin\Analytics\UserCalendar@showMonthlyUser');
Route::post('/super_weekly_user', 'SuperAdmin\Analytics\UserCalendar@showWeeklyUser');
Route::post('/super_coaching_user', 'SuperAdmin\Analytics\UserCalendar@showCoachingUser');
//////// User calender1 //////////////
Route::post('/user_engage', 'SuperAdmin\Analytics\UserCalendar1@engageUser');
Route::post('/user_week', 'SuperAdmin\Analytics\UserCalendar1@weekUser');
Route::post('/user_month', 'SuperAdmin\Analytics\UserCalendar1@monthUser');
Route::post('/user_coaching', 'SuperAdmin\Analytics\UserCalendar1@coachingUser');
//////// Corporate //////////////
//////// General calender //////////////
Route::post('/cor_engage_general', 'CorporateAdmin\GeneralCalendar@showCorEngageGeneral');
Route::post('/cor_monthly_general', 'CorporateAdmin\GeneralCalendar@showCorMonthlyGeneral');
Route::post('/cor_weekly_general', 'CorporateAdmin\GeneralCalendar@showCorWeeklyGeneral');
Route::post('/cor_population_general', 'CorporateAdmin\GeneralCalendar@showCorPopulationGeneral');
Route::post('/cor_coaching_general', 'CorporateAdmin\GeneralCalendar@showCorCoachingGeneral');
//////// Corporate //////////////
//////// Team calender 0 //////////////
Route::post('/team_engage_general', 'CorporateAdmin\TeamCalendar@showTeamEngageGeneral');
Route::post('/team_monthly_general', 'CorporateAdmin\TeamCalendar@showTeamMonthlyGeneral');
Route::post('/team_weekly_general', 'CorporateAdmin\TeamCalendar@showTeamWeeklyGeneral');
Route::post('/team_population_general', 'CorporateAdmin\TeamCalendar@showTeamPopulationGeneral');
Route::post('/team_coaching_general', 'CorporateAdmin\TeamCalendar@showTeamCoachingGeneral');
//////// Team calender 1 //////////////
Route::post('/team_engage', 'CorporateAdmin\TeamCalendar1@teamEngage');
Route::post('/team_month', 'CorporateAdmin\TeamCalendar1@teamMonth');
Route::post('/team_week', 'CorporateAdmin\TeamCalendar1@teamWeek');
Route::post('/team_risk', 'CorporateAdmin\TeamCalendar1@teamRisk');
Route::post('/team_coach', 'CorporateAdmin\TeamCalendar1@teamCoach');
//////// Teamadmin //////////////
//////// Team calender //////////////
Route::post('/myteam_engage_general', 'TeamAdmin\TeamCalendar@showMyteamEngageGeneral');
Route::post('/myteam_monthly_general', 'TeamAdmin\TeamCalendar@showMyteamMonthlyGeneral');
Route::post('/myteam_weekly_general', 'TeamAdmin\TeamCalendar@showMyteamWeeklyGeneral');
Route::post('/myteam_population_general', 'TeamAdmin\TeamCalendar@showMyteamPopulationGeneral');
Route::post('/myteam_coaching_general', 'TeamAdmin\TeamCalendar@showMyteamCoachingGeneral');
//////// Teamadmin //////////////
//////// Per Member calender //////////////
Route::post('/member_engage_general', 'TeamAdmin\MemberCalendar@showMemberEngage');
Route::post('/member_monthly_general', 'TeamAdmin\MemberCalendar@showMemberMonthly');
Route::post('/member_weekly_general', 'TeamAdmin\MemberCalendar@showMemberWeekly');
Route::post('/member_coaching_general', 'TeamAdmin\MemberCalendar@showMemberCoaching');
// Corporate Page
Route::post('/show_group', 'CorporateAdmin\AnalyticsController@showGroup');
// Teamadmin Page
Route::post('/show_member', 'TeamAdmin\AnalyticsController@showMember');

Route::get('/send/email', 'SuperAdmin\ActivationController@mail')->name('sendmail');
Route::post('/sendactivecode', 'SuperAdmin\ActivationController@semdActivecode')->name('sendActiveCode');
Route::post('/get_date', 'SuperAdmin\ActivationController@getDate');

Route::post('/cor_population_general_chart', 'CorporateAdmin\GeneralCalendar@showCorPopulationGeneralChart')->name('Population-chart');
Route::get('/generate-reports-pdf', 'SuperAdmin\AnalyticsController@GenerateReportsPDF')->name('generate-reports-pdf');

// Analytics Routes
Route::group([
    'prefix' => 'analytics-chart',
    'namespace' => '\App\Http\Controllers\SuperAdmin\AnalyticsCharts',
], function () {

    Route::group([
        'prefix' => 'general',
    ], function () {
        Route::post('weekly-check', 'GeneralController@weekly_check');
        Route::post('monthly-check', 'GeneralController@monthly_check');
        Route::post('population-risk-distribution', 'GeneralController@population_risk_distribution');
        Route::post('coaching-report', 'GeneralController@coaching_report');
    });

    Route::group([
        'prefix' => 'client',
    ], function () {
        Route::post('weekly-check', 'ClientController@weekly_check');
        Route::post('monthly-check', 'ClientController@monthly_check');
        Route::post('population-risk-distribution', 'ClientController@population_risk_distribution');
        Route::post('coaching-report', 'ClientController@coaching_report');
    });
    Route::group([
        'prefix' => 'user',
    ], function () {
        Route::post('weekly-check', 'UserController@weekly_check');
        Route::post('monthly-check', 'UserController@monthly_check');
        Route::post('coaching-report', 'UserController@coaching_report');
    });

});

Route::group([
    'prefix' => 'sub-tool',
    'namespace' => '\App\Http\Controllers\SuperAdmin\Content\SubTools',
], function () {
    Route::resource('breathing-tools', 'BreathingToolController')->only(['store', 'update', 'destroy']);
    Route::resource('mindfullness-tools', 'MindfulnessToolController')->only(['store', 'update', 'destroy']);
    Route::resource('guided-tools', 'GuidedToolController')->only(['store', 'update', 'destroy']);
    Route::resource('selfhyp-tools', 'SelfHypToolController')->only(['store', 'update', 'destroy']);
});

Route::group([
    'namespace' => '\App\Http\Controllers\SuperAdmin',
    'middleware' => 'superadmin',
], function () {
    Route::get('questions', 'QuestionsController@index')->name('questions');
    Route::resource('question_list', 'Question\QuestionController');
    Route::resource('choice', 'Question\ChoiceController');
});

Route::group([
    'namespace' => '\App\Http\Controllers\SuperAdmin',
    'middleware' => 'superadmin',
], function () {
    Route::get('quizes', 'QuizController@index')->name('quizes');
    Route::resource('quiz_list', 'Quiz\QuizController');
    Route::resource('question', 'Quiz\QuestionController');
    Route::post('find_question/{question_id}','QuizController@findQuestion')->name('find_question');
    Route::post('get_quiz/{quiz_id}','QuizController@getQuiz')->name('get_quiz');
});
