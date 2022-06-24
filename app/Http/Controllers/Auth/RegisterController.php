<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vieva_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    { 
        // desktop or mobile 
        $agent = new \Jenssegers\Agent\Agent;
        // $result = $agent->isMobile();
        $result = $agent->isDesktop(); 
        if($result){
            $user = User::create([
                'first_name' => $data['firstname'],
                'last_name' => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'platform' => 'desktop'
            ]);
        }else{
            $user = User::create([
                'first_name' => $data['firstname'],
                'last_name' => $data['lastname'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'platform' => 'mobile'
            ]);
        }
//        $user->sendEmailVerificationNotification();
        return $user;
    }
}
