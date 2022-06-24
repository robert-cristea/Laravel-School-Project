<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo;
    public function redirectTo(){
       
        switch(Auth::user()->user_level){
            case 0:
                $this->redirectTo = '/superadmin';
                return $this->redirectTo;
            break;
            case 1:
                $this->redirectTo = '/admin';
                return $this->redirectTo;
            break;
            case 2:
                $this->redirectTo = '/corporateadmin';
                return $this->redirectTo;
            break;
            case 3:
                $this->redirectTo = '/premiumuser';
                return $this->redirectTo;
            break;
            case 4:
                $this->redirectTo = '/freeuser';
                return $this->redirectTo;
            break;
            case 5:
                $this->redirectTo = '/guestuser';
                return $this->redirectTo;
            break;
            case 6:
                $this->redirectTo = '/coach';
                return $this->redirectTo;
            break;
            case 7:
                $this->redirectTo = '/corporategroupadmin';
                return $this->redirectTo;
            break;
            case 8:
                $this->redirectTo = '/corporateuser';
                return $this->redirectTo;
            break;
            default:
            $this->redirectTo = '/login';
            return $this->redirectTo;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
}
