<?php

namespace App\Http\Controllers;

use App\Models\log_activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\master_data;
use App\Models\User;
use App\Traits\apiResponser;
use Redirect;

class LogActivityController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Log Activities';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(User::haveIndex($this->namaMenu)){
            $validator = Validator::make($request->all(), 
                [
                    'total'     => 'nullable|numeric|gt:0',
                    'platform'  => 'nullable|regex:/^[a-zA-Z]+$/',
                    'browser'   => 'nullable|regex:/^[a-zA-Z\s]+$/',
                    'method'    => 'nullable|regex:/^[a-zA-Z]+$/',
                    'q'         => 'nullable|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'numeric' => ':attribute yang anda pilih salah!',
                    'gt' => 'Jumlah baris yang anda masukkan salah!',
                    'regex' => 'Nama :attribute yang anda masukkan salah!',
                ]
            );
            if ($validator->fails()) {
                return Redirect::to(url()->previous())
                    -> withErrors($validator);
            }
            $_total = 25;
            if(isset($request->total)){
                $_total = $request->total;
            }
            $_data = log_activity::with('userAccount')
                -> where('status', '<>', '2')
                -> where('description', 'like', '%'.$request->q.'%')
                -> where('method', 'like', '%'.$request->method.'%')
                -> where('platform', 'like', '%'.$request->platform.'%')
                -> where('browser', 'like', '%'.$request->browser.'%')
                -> withTrashed(false)
                -> orderBy('created_at', 'DESC')
                -> paginate($_total)
                -> appends(request()->query());
            $_platform = log_activity::selectRaw('platform')
                -> whereRaw('status = "0"')
                -> groupByRaw('platform')
                -> get();
            $_browser = log_activity::selectRaw('browser')
                -> whereRaw('status = "0"')
                -> groupByRaw('browser')
                -> get();
            $_method = log_activity::selectRaw('method')
                -> whereRaw('status = "0"')
                -> groupByRaw('method')
                -> get();
            $_result = view('home')
                -> with('pages', 'backend.log activities.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('platform', $_platform)
                -> with('browser', $_browser)
                -> with('method', $_method)
                -> with('total', $_total)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(log_activity $log_activity)
    {
        if(User::canDelete($this->namaMenu)){
            $_data = log_activity::where('id', $log_activity->id)
                -> delete();
            if($_data){
                return Redirect::to(url()->previous())
                    -> with('message', 'Log Activity berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Log Activity tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }
}
