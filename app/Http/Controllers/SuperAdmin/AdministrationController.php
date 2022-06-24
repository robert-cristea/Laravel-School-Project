<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Corporate_clients;
use App\Model\Corporate_groups;

class AdministrationController extends Controller
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
    public function index(Request $request)
    {
        $users = User::all();
        $superadmins = User::whereUser_level(0)->get();
        $admins = User::whereUser_level(1)->get();
        $corporate_clients = Corporate_clients::all();

        $first_corporate = Corporate_clients::first();
        $first_corporate_id = $first_corporate->corporate_client_id;
        $teams = Corporate_groups::where('corporate_client_id', $first_corporate_id)->get();
        $teamadmins = User::Join('vieva_corporate_groups', 'vieva_users.id', '=', 'vieva_corporate_groups.corporate_group_admin_id')
                            ->where('corporate_client_id', $first_corporate_id)
                            ->get();
        $corporateadmins = User::where('user_level', 2)->get();
        $newteamadmins = User::where('user_level', 7)->get();
        $onlyusers = User::whereNotIn('user_level', [0, 1, 2, 7])->get();
        $firstonlyusers = User::whereNotIn('user_level', [0, 1, 2, 7])->first();
        
        
        
        // $corporate_id = $request->all()['corporate_name'];

        // $teams = Corporate_groups::where('corporate_client_id', $corporate_id)->get();
        
        
        
        return view('backend.superadmin.administration', compact(
            'users',
            'superadmins',
            'admins',
            'corporate_clients',
            'onlyusers',
            'firstonlyusers',
            'teams',
            'teamadmins',
            'corporateadmins',
            'newteamadmins',
            'first_corporate_id'
            )
        );
    }
}
