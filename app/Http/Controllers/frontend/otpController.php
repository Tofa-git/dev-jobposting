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
use App\Mail\ActivationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

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

    public function showRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), 
            [
                'username'      => 'required|min:8|max:64|regex:/^[a-zA-Z0-9\_\.\@\-]+$/',
                'nama_lengkap'  => 'required|min:8|max:64|regex:/^[a-zA-Z0-9\s\.\,]+$/',
//                'g-recaptcha-response'  => 'required|captcha',
            ],[
                'username.required' => 'Username tidak boleh kosong!',
                'username.regex' => 'Username mengandung karakter yang dilarang!',
                'username.max' => 'Jumlah karakter maksimal 64!',
                'username.min' => 'Jumlah karakter minimal 8!',
                'nama_lengkap.required' => 'Nama lengkap tidak boleh kosong!',
                'nama_lengkap.min' => 'Jumlah karakter nama lengkap minimal 8!',
                'nama_lengkap.max' => 'Jumlah karakter nama lengkap maksimal 64!',
                'nama_lengkap.regex' => 'Nama lengkap mengandung karakter yang dilarang!',
            ]
        );
        if ($validator->fails()) {
            return Redirect::to(url()->previous())
                -> withErrors($validator);
        }
        $_data = User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->username,
            'role' => 44, //General Account
            'activation_expired_at' => Carbon::now()->addHours(12),
            'password' => Hash::make((string)rand(10000000, 99999999)),
            'param' => Str::uuid(),
        ]);
        try{
            app_properties::setMailConfig();
            Mail::to($request->username)->send(new ActivationEmail($_data));
            return Redirect::to('/')
                -> with('message', 'Silahkan check Inbox email anda untuk proses berikutnya!');
        }catch(\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function activation($id)
    {
        $_check = User::where('param', $id)->first();
        $now = Carbon::now();
        if($_check){
            if($now->isAfter($_check->activation_expired_at)){
                dd('expired');
            }else{
                $_data = app_properties::whereRaw('status="0"')
                    -> first();
                return view('auth.register info')
                    -> with('check', $_check)
                    -> with('info', $_data);
            }
        }else{
            dd('blank');
        } 
    }

}