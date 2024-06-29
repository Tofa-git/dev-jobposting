<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\user_role;
use App\Models\master_data_detail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Helpers\logActivities;
use App\Traits\apiResponser;
use App\Models\simasn;
use Redirect;

class UserManagementController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'User Management';
    protected $sub_url = '/master-data/skpd';

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
                    'total'         => 'nullable|numeric',
                    'role_account'  => 'numeric|gt:-1',
                    'q'             => 'nullable|regex:/^[a-zA-Z0-9\s\-\_\.\@]+$/',
                ],
                [
                    'total.numeric' => 'Jumlah baris harus bertipe numeric!',
                    'total.gt' => 'Jumlah baris harus lebih besar dari 0!',
                    'role_account.numeric' => 'Jenis Account salah!',
                    'role_account.gt' => 'Jenis Account salah!',
                    'q.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
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
            $_role_account = master_data_detail::where('status', '0')
                -> where('refid', 1)
                -> get();
            $_data = User::where('status', '<>', '2')
                -> when($request->role_account, function ($query) use ($request) {
                    return $query->where('role', $request->role_account);
                })
                -> where(function($query) use ($request){
                    $query->where('name', 'like', '%'.$request->q.'%');
                    $query->orWhere('email', 'like', '%'.$request->q.'%');
                })
                -> with('userRole')
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.user management.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('role_account', $_role_account)
                -> with('total', $_total)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(User::canCreate($this->namaMenu)){
            $_jenis_account = master_data_detail::where('status', '0')
                -> where('refid', 1)
                -> get();
            $_result = view('backend.user management.create')
                -> with('title', $this->namaMenu)
                -> with('jenis_account', $_jenis_account)
                -> with('ref', @$request->role_account)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Tambah User Account';
            return $this->success($_hasil);
        }else{
            $_hasil['content'] = view('error.403')->render();
            $_hasil['title'] = 'Error Message';
            return $this->success($_hasil);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(User::canCreate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'nama'                  => 'required|max:32|regex:/^[a-zA-Z0-9\s\-\_\.]+$/',
                    'email'                 => 'required|min:8|max:64|regex:/^[a-zA-Z0-9\s\-\_\.\@]+$/',
                    'jenis_account'         => 'required|numeric|gt:0',
                    'password'              => 'required|min:8',
                    'password_confirmation' => 'required|min:8|same:password',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => ':attribute mengandung karakter yang dilarang!',
                    'gt' => 'Jenis account belum dipilih!',
                    'min' => 'Jumlah karakter :attribute minimal 8 karakter!',
                    'max' => 'Jumlah karakter :attribute melebihi yang diizinkan!'
                ]
            );
            if ($validator->fails()){
                $_jenis_account = master_data_detail::where('status', '0')
                    -> where('refid', 1)
                    -> get();
                $_result = view('backend.user management.create')
                    -> withErrors($validator)
                    -> with('title', $this->namaMenu)
                    -> with('jenis_account', $_jenis_account)
                    -> with('ref', @$request->role_account)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('user-management.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah User Account')
                    -> with('modal', 'create');
            }
            try{
                $_data = User::create([
                    'name'                  => $request->nama,
                    'email'                 => $request->email,
                    'role'                  => $request->jenis_account,
                    'password'              => Hash::make($request->password),
                    'created_by'            => \Auth::user()->id,
                ]);
                user_role::setRole($_data->id, $request->jenis_account);
                logActivities::addToLog('User Management', 'Tambah User Baru a.n. ', $request->nama, '0');
                return Redirect::to(route('user-management.index'))
                    -> with('message', 'User baru berhasil ditambah');
            }catch(\Illuminate\Database\QueryException $e){
                $_jenis_account = master_data_detail::where('status', '0')
                    -> where('refid', 1)
                    -> get();
                $_result = view('backend.user management.create')
                    -> with('title', $this->namaMenu)
                    -> with('jenis_account', $_jenis_account)
                    -> with('ref', @$request->role_account)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('user-management.index'))
                    -> with('error', $e->errorInfo[2])
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah User Account')
                    -> with('modal', 'create');
            }
        }else{
            return view('error.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(User::canUpdate($this->namaMenu)){
            $_jenis_account = master_data_detail::where('status', '0')
                -> where('refid', 1)
                -> get();
            $_data = User::where('id', $id)->first();
            $_result = view('backend.user management.edit')
                -> with('title', $this->namaMenu)
                -> with('data', $_data)
                -> with('jenis_account', $_jenis_account)
                -> with('ref', @$request->role_account)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = $this->namaMenu;
            return $this->success($_hasil);
        }else{
            $_hasil['content'] = view('error.403')->render();
            $_hasil['title'] = 'Error Message';
            return $this->success($_hasil);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(User::canUpdate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'nama'                  => 'required|regex:/^[a-zA-Z0-9\s\-\_\.]+$/',
                    'jenis_account'         => 'required|numeric|gt:0',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => ':attribute mengandung karakter yang dilarang!',
                    'gt' => 'Jenis account belum dipilih!',
                ]
            );
            if ($validator->fails()){
                $_jenis_account = master_data_detail::where('status', '0')
                    -> where('refid', 1)
                    -> get();
                $_data = User::where('id', $id)->first();
                $_result = view('backend.user management.edit')
                    -> withErrors($validator)
                    -> with('title', $this->namaMenu)
                    -> with('data', $_data)
                    -> with('jenis_account', $_jenis_account)
                    -> with('ref', @$request->role_account)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('user-management.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', $this->namaMenu)
                    -> with('modal', 'create');
            }
            $_check = User::findOrFail($id);
            if((int)$_check->role !== (int)$request->jenis_account){
                user_role::deleteStatus($id);
                user_role::where('userid', $id)->delete();
                user_role::setRole($id, $request->jenis_account);
            }
            $_data = User::where('email', $request->email)
                -> update([
                    'name'                  => $request->nama,
                    'role'                  => $request->jenis_account,
                    'updated_by'            => \Auth::user()->id,
            ]);
            logActivities::addToLog('User Management', 'Update User a.n. ', $request->nama, '0');
            return Redirect::to(route('user-management.index'))
                -> with('message', 'User Account berhasil diupdate');
        }else{
            return view('error.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(User::canDelete($this->namaMenu)){
            //Hapus User Role
            user_role::deleteStatus($id);
            user_role::where('userid', $id)->delete();

            //Hapus User
            User::deleteStatus($id);
            $_data = User::where('id', $id)
                -> delete();
            if($_data){
                logActivities::addToLog('User Account', 'Delete User Account', 'Delete User Account untuk '.User::getFieldValue($id, 'email'), '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'User Account berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'User Account tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = User::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    User::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('User Account', 'Update Status User Account', 'Update status User Account menjadi active untuk '.$_check_data->title, '0');
                }elseif($_check_data->status === '0'){
                    User::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('User Account', 'Update Status User Account', 'Update status User Account menjadi suspend untuk '.$_check_data->title, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status User Account berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'User Account tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function verify($id)
    {
        if(User::canSuspend($this->namaMenu)){
            if(((int)$id===1) && (!\Auth::user()->isDeveloper())){
                return view('error.403');
            }else{
                $_check_data = User::find($id);
                if($_check_data){
                    User::where('id', $id)
                        -> update([
                            'email_verified_at' => now(),
                    ]);
                    logActivities::addToLog('User Management', 'Verify User Management Account', 'Verify user management account for '.User::getFieldValue($id, 'email'), '0');
                    return Redirect::to(url()->previous())
                        -> with('message', 'User account activated successfull');
                }else{
                    return Redirect::to(url()->previous())
                        -> with('error', 'User Account tidak ditemukan');
                }
            }
        }else{
            return view('error.403');
        }
    }

    public function resetPassword(Request $request, $id)
    {
        if(User::canUpdate($this->namaMenu)){
            if(((int)$id===1) && (!\Auth::user()->isDeveloper())){
                return view('error.403');
            }else{
                $_check_data = User::find($id);
                if($_check_data){
                    User::where('id', $id)
                        -> update([
                            'password'  => Hash::make('Berkala@2024'),
                        ]);
                    logActivities::addToLog('User Management', 'Reset Password User', 'Reset password user for '.\Auth::user()->getFieldValue($id, 'email'), '0');
                    return Redirect::to(url()->previous())
                        -> with('message', 'Password user berhasil direset');
                }else{
                    return Redirect::to(url()->previous())
                        -> with('error', 'User Account tidak ditemukan');
                }
            }
        }else{
            return view('error.403');
        }
    }

}
