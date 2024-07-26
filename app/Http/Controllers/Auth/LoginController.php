<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Helpers\logActivities;
use App\Models\app_properties;
use App\Models\User;

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
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        logActivities::addToLog('Login', 'Login Page', 'Show login page', '1');
        $_data = app_properties::whereRaw('status="0"')
            -> first();
        return view('auth.login')
            -> with('data', $_data);
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|regex:/^[a-zA-Z0-9\s\_\.\@\-]+$/',
//            'password'  => 'required|min:8',
            'g-recaptcha-response'  => 'required|captcha',
        ]);
    }
    
    protected function authenticated(Request $request, $user)
    {
        User::whereRaw('id='.$user->id)
            -> update([
                'last_login'    => $user->current_login,
                'last_ip'       => $user->current_ip,
                'current_login' => now(),
                'current_ip'    => \Request::ip(),
        ]);
        if(! User::haveToken()){
            $_token = \App\Helpers\general::getToken($request);
            if(!is_null($_token)){
                User::whereRaw('id='.\Auth::user()->id)
                    -> update([
                        'access_token' => $_token,
                ]);
            }
        }
        logActivities::addToLog('Login', 'Submit Login', 'Submit login with status success', '0');
        return redirect()
            -> intended($this->redirectPath());
    }

}