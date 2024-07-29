<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\app_properties;
use App\Models\User;
use App\Models\verification_code;
use Validator;
use Redirect;
use Carbon\Carbon;
use App\Mail\TokenEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class otpController extends Controller
{

    /**
     * Show the login form.
     */
    public function showLogin()
    {
        $_data = app_properties::whereRaw('status="0"')
            -> first();
        return view('auth.otplogin')
            -> with('data', $_data);
    }

    /**
     * Generate OTP.
     */
    public function generate(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'email'     => 'required|min:8|max:64|regex:/^[a-zA-Z0-9\_\.\@\-]+$/',
                'g-recaptcha-response'  => 'required|captcha',
            ],[
                'email.required' => 'Username tidak boleh kosong!',
                'email.regex' => 'Username mengandung karakter yang dilarang!',
                'email.max' => 'Jumlah karakter maksimal 64!',
                'email.min' => 'Jumlah karakter minimal 8!'
            ]
        );
        if ($validator->fails()) {
            return Redirect::to(url()->previous())
                -> withErrors($validator);
        }
        $check_user = User::where('email', $request->email)->first();
        if($check_user){
            //Kirim Email Notifikasi
            try{
                $kode = verification_code::create([
                    'user_id' => $check_user->id,
                    'otp' => rand(123456, 999999),
                    'expired_at' => Carbon::now()->addMinutes(5),
                    'param' => Str::uuid(),
                ]);
                app_properties::setMailConfig();
                Mail::to($check_user->email)->send(new TokenEmail($kode));
                return Redirect::to(route('otp.show-otp', $kode->param))
                    -> with('message', 'Check inbox email anda untuk melihat kode OTP');
            }catch(\Exception $e){
                dd($e->getMessage());
                return redirect()->back()->withErrors($e->getMessage());
            }
        }else{

        }
    }

    /**
     * Show the OTP form.
     */
    public function showOtp($id)
    {
        $_data = app_properties::whereRaw('status="0"')
            -> first();
        $_param = verification_code::where('param', $id)
            -> first();
        if($_param){
            if($_param->expired_at > now()){
                return view('auth.otpcode')
                    -> with('data', $_data)
                    -> with('param', $_param);
            }else{
                return view('auth.otpexpired')
                    -> with('data', $_data);
            }
        }else{
            return view('error.403');
        }
    }

    public function checkOtp($id)
    {
        $_check = verification_code::where('param', $id)
            -> first();
        if($_check){
            if($_check->expired_at > now()){
                $user = User::find($_check->user_id);
                if ($user){
                    $_check->update([
                        'expired_at' => Carbon::now()
                    ]);
                    Auth::login($user);
                    return Redirect::to(route('dashboard.index'));
                }else{
                    return view('error.403');
                }
            }else{
                $_data = app_properties::whereRaw('status="0"')
                    -> first();
                return view('auth.otpexpired')
                    -> with('data', $_data);
            }
        }else{
            return view('error.403');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to(route('login'));
    }

}
