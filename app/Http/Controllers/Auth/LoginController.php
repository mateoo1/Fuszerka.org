<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

//added:
use App\User;
Use Illuminate\Http\Request;
use Auth;
use App\Traffic;

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
    // protected $redirectTo = '/home';

    protected function redirectTo()
    {
        $user_ip = \Request::ip();
        
        //save user login time and last IP address in firt found row
        $user_record = User::where('name', auth()->user()->name)->first();
        $user_record->last_ip = $user_ip;
        $user_record->last_login = date("Y-m-d H:i:s");
        $user_record->save();

        //save username and user id in traffic table (this data will be updated if another user log in from the same IP)
        $traffic = Traffic::where('ip', $user_ip)->first();
        $traffic->user_name = auth()->user()->name;
        $traffic->user_id = auth()->user()->id;
        $traffic->save();

        // logout if user has been blocked
        if ($user_record->blocked == 1) {
            Auth::logout();
            return view('auth.login');
        }

        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
