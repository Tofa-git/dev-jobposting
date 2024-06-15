<?php

namespace App\Http\Controllers;

use App\Models\app_properties;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\logActivities;
use Faker\Provider\Image;
use App\Traits\apiResponser;
use App\Helpers\general;
use Validator;
use Redirect;
use Response;

class AppPropertiesController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Application Properties';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(User::haveIndex($this->namaMenu)){
            $_data = app_properties::where('status', '0')
                -> first();
            $_result = view('home')
                -> with('pages', 'backend.application properties.index')
                -> with('title', 'Application Properties')
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }

    public function update(Request $request, $app_properties)
    {
        if(User::canCreate($this->namaMenu)){
            if(!\Auth::user()->isDeveloper()){
                return view('error.403');
            }else{
                if (!is_numeric(@$app_properties)) {
                    return Redirect::to(url()->previous())
                        -> with('error', 'ID parameter salah');
                }
                if($request->tab === 'umum'){
                    $validator = Validator::make($request->all(),
                        [
                            'logo'      => 'nullable|mimes:bmp,jpeg,jpg,png|max:2048',
                            'title_1'   => 'nullable|regex:/^[a-zA-Z0-9è\s]+$/',
                            'title_2'   => 'nullable|regex:/^[a-zA-Z0-9è\s]+$/',
                            'name'      => 'required|regex:/^[a-zA-Z0-9è\s]+$/',
                            'email'     => 'nullable|email:rfc,dns',
                            'website'   => 'nullable|url',
                        ]
                    );
                    if ($validator->fails()){
                        return Redirect::back()
                            -> withErrors($validator);
                    }
                    $_file_name = [];
                    if($request->hasFile('logo')){
                        $request->validate([
                            'logo'      => 'mimes:bmp,jpeg,jpg,png|max:2048',
                        ]);
                        $file           = $request->file('logo');
                        $_file_name     = general::storeFile($file, 'pictures', 'Logo Aplikasi', \Auth::user()->id);
                        if($_file_name){
                            $_file_name = json_decode($_file_name);
                            app_properties::whereRaw('status="0"')
                                -> update([
                                    'logo'      => $_file_name->name,
                                    'icon_logo' => $_file_name->name,
                            ]);
                        }
                    }
                    app_properties::where('id', $app_properties)
                        -> update([
                            'icon_text_1'   => $request->title_1,
                            'icon_text_2'   => $request->title_2,
                            'name'          => $request->name,
                            'address'       => $request->address,
                            'phone'         => $request->phone,
                            'mobile'        => $request->mobile,
                            'fax'           => $request->fax,
                            'email'         => $request->email,
                            'website'       => $request->website,
                    ]);
                    logActivities::addToLog('Application Properties', 'Update Application Properties', 'Update Application Properties information', '0');
                    return Redirect::to(route('application-properties.index'))
                        -> with('tab', 'umum')
                        -> with('message', 'Application properties berhasil diupdate');
                }else if($request->tab === 'medsos'){
                    $validator = Validator::make($request->all(),
                        [
                            'instagram' => 'nullable|url',
                            'facebook'  => 'nullable|url',
                            'twitter'   => 'nullable|url',
                            'linkedin'  => 'nullable|url',
                            'youtube'   => 'nullable|url',
                        ]
                    );
                    if ($validator->fails()){
                        return Redirect::back()
                            -> withErrors($validator);
                    }
                    app_properties::where('id', $app_properties)
                        -> update([
                            'youtube'   => $request->youtube,
                            'facebook'  => $request->facebook,
                            'twitter'   => $request->twitter,
                            'linkedin'  => $request->linkedin,
                            'instagram' => $request->instagram,
                    ]);
                    logActivities::addToLog('Application Properties', 'Update Application Properties', 'Update Application Properties information', '0');
                    return Redirect::to(route('application-properties.index'))
                        -> with('tab', 'sosmed')
                        -> with('message', 'Application properties berhasil diupdate');
                }else if($request->tab === 'setting'){
                    $validator = Validator::make($request->all(),
                        [
                            'mail_driver' => 'nullable|alpha',
                            'mail_host'  => 'nullable|regex:/^[a-zA-Z0-9.\-_\s]+$/',
                            'port'   => 'nullable|numeric',
                            'username'  => 'nullable|email:rfc,dns',
                            'encryption'   => 'nullable|in:SSL,TLS',
                        ]
                    );
                    if ($validator->fails()){
                        return Redirect::back()
                            -> withErrors($validator);
                    }
                    $_frontend = 0;
                    if(@$request->have_website === 'on'){
                        $_frontend = 1;
                    }
                    app_properties::where('id', $app_properties)
                        -> update([
                            'mail_driver'       => $request->mail_driver,
                            'mail_host'         => $request->mail_host,
                            'mail_port'         => $request->port,
                            'mail_username'     => $request->username,
                            'mail_password'     => base64_encode($request->password),
                            'mail_encryption'   => $request->encryption,
                            'copyright'         => $request->copyright,
                            'frontend_website'  => $_frontend,
                    ]);
                    logActivities::addToLog('Application Properties', 'Update Application Properties', 'Update Application Properties information', '0');
                    return Redirect::to(route('application-properties.index'))
                        -> with('tab', 'setting')
                        -> with('message', 'Application properties berhasil diupdate');
                }
            }
        }else{
            return view('error.403');
        }
    }
    
}
