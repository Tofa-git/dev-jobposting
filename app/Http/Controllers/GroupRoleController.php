<?php

namespace App\Http\Controllers;

use App\Models\group_role;
use Illuminate\Http\Request;
use App\Models\backend_menu;
use App\Models\master_data_detail;
use App\Models\User;
use App\Helpers\logActivities;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class GroupRoleController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Group Roles';

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
                    'total'     => 'nullable|numeric',
                    'q'         => 'nullable|regex:/^[a-zA-Z0-9\s\-]+$/',
                ],
                [
                    'total.numeric' => 'Jumlah baris harus bertipe numeric!',
                    'total.gt' => 'Jumlah baris harus lebih besar dari 0!',
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
            $_data = [];
            if(User::isAdministrator()){
                $_data = master_data_detail::where('status', '<>', '2')
                    -> where('refid', 1)
                    -> where('description', 'like', '%'.$request->q.'%')
                    -> where('id', '>', 1)
                    -> withTrashed(false)
                    -> paginate($_total)
                    -> appends(request()->query());
            }elseif(User::isDeveloper()){
                $_data = master_data_detail::where('status', '<>', '2')
                    -> where('refid', 1)
                    -> where('description', 'like', '%'.$request->q.'%')
                    -> withTrashed(false)
                    -> paginate($_total)
                    -> appends(request()->query());
            }
            $_result = view('home')
                -> with('pages', 'backend.group role.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
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
            $_result = view('backend.group role.create')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Tambah '.$this->namaMenu;
            return $this->success($_hasil);
        }else{
            return view('error.403');
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
                    'description'   => 'required|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'description.required' => 'Deskripsi tidak boleh kosong!',
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_result = view('backend.group role.create')
                    -> withErrors($validator)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('group-roles.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah '.$this->namaMenu)
                    -> with('modal', 'create');
            }
            master_data_detail::create([
                'refid'         => 1,
                'description'   => $request->description,
                'created_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Group Role', 'Tambah Group Role', $request->description, '0');
            return Redirect::to(route('group-roles.index'))
                -> with('message', 'Group Role berhasil ditambah');
        }else{
            return view('error.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(User::canUpdate($this->namaMenu)){
            $_data = master_data_detail::where('id',$id)->first();
            $_result = view('backend.group role.edit')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Edit '.$this->namaMenu;
            return $this->success($_hasil);
        }else{
            return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(User::canUpdate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'description'   => 'nullable|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_data = master_data_detail::where('id', $id)
                    -> first();
                $_result = view('backend.group role.edit')
                    -> withErrors($validator)
                    -> with('title', 'Edit '.$this->namaMenu)
                    -> with('data', $_data)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('group-roles.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Edit '.$this->namaMenu)
                    -> with('modal', 'edit');
            }
            master_data_detail::where('id', $id)
                -> update([
                    'refid'         => 1,
                    'description'   => $request->description,
            ]);
            logActivities::addToLog('Group Role', 'Update Group Role', 'Update grup role untuk : '.$request->description, '0');
            return Redirect::to(route('group-roles.index'))
                -> with('message', 'Group Role berhasil diupdate');
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
            $_data = master_data_detail::where('id', $id)
                -> delete();
            if($_data){
                group_role::where('userid', $id)->delete();
                logActivities::addToLog('Group Role', 'Delete Group Role', 'Delete Group Role untuk '.master_data_detail::getFieldValue($id, 'description'), '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Group Role berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Group Role tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            if (!is_numeric(@$id)) {
                return Redirect::to(url()->previous())
                    -> with('error', 'Input paramater salah!');
            }
            $_check = master_data_detail::where('id', $id)
                -> first();
            if($_check){
                if($_check->status==='3' || $_check->status==='1'){
                    master_data_detail::where('id', $id)
                        -> update([
                            'status'    => '0',
                            'updated_by'=> \Auth::user()->id,
                    ]);
                    logActivities::addToLog('Group Role', 'Update Status Group Role', 'Update status Group Role menjadi active untuk '.$_check->description, '0');
                }elseif($_check->status==='0'){
                    master_data_detail::where('id', $id)
                        -> update([
                            'status'    => '1',
                            'updated_by'=> \Auth::user()->id,
                    ]);
                    logActivities::addToLog('Group Role', 'Update Status Group Role', 'Update status Group Role menjadi suspend untuk '.$_check->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Group Role berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Uknown error...');
            }
        }else{
            return view('error.403');
        }
    }

    public function editRole($id)
    {
        if(User::canUpdate($this->namaMenu)){
            if (!is_numeric(@$id)) {
                return Redirect::to(url()->previous())
                    -> with('error', 'Input paramater salah!');
            }
            $_data = master_data_detail::where('id', $id)
                -> first();
            $_list_menu = \App\Models\group_role::getGroupMenu($id);
            $_result = view('backend.group role.edit permission')
                -> with('title', 'Edit Group Role')
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('list_menu', $_list_menu)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Update '.$this->namaMenu;
            return $this->success($_hasil);
        }else{
            return view('error.403');
        }
    }

    public function updateRole(Request $request, $id)
    {
        if(User::canUpdate($this->namaMenu)){
            if (!is_numeric(@$id)) {
                return Redirect::to(url()->previous())
                    -> with('error', 'Input paramater salah!');
            }
            $_filter = group_role::select('menuid')
                -> where('userid', (int)$id)
                -> withTrashed(true)
                -> get()
                -> toArray();

            //Check jika ada penambahan Menu
            $_check_new_menu = backend_menu::select('id')
                -> whereNotIn('id', $_filter)
                -> get();

            foreach($_check_new_menu as $check_new_menu){
                group_role::Insert([
                        'userid'    => $id,
                        'menuid'    => $check_new_menu->id,
                        'status'    => '2',
                        'created_by' => \Auth::user()->id
                ]);
            }
            group_role::where('userid', (int)$id)
                -> withTrashed(true)
                -> update([
                    'showMenu'  => '1',
                    'show'      => '1',
                    'create'    => '1',
                    'update'    => '1',
                    'suspend'   => '1',
                    'delete'    => '1',
                    'status'    => '2',
                    'deleted_at'=> now(),
            ]);

            $_list_menu = backend_menu::get();
            foreach($_list_menu as $list_menu){
                if(
                    ($request->input('showMenu'.$list_menu->id)) ||
                    ($request->input('show'.$list_menu->id)) ||
                    ($request->input('create'.$list_menu->id)) ||
                    ($request->input('update'.$list_menu->id)) ||
                    ($request->input('suspend'.$list_menu->id)) ||
                    ($request->input('delete'.$list_menu->id))){
                    group_role::whereRaw('userid='.$id.' And menuid='.$list_menu->id)
                        -> withTrashed(true)
                        -> update([
                            'show'          => $request->input('show'.$list_menu->id) ? '0' : '1',
                            'create'        => $request->input('create'.$list_menu->id) ? '0' : '1',
                            'update'        => $request->input('update'.$list_menu->id) ? '0' : '1',
                            'suspend'       => $request->input('suspend'.$list_menu->id) ? '0' : '1',
                            'delete'        => $request->input('delete'.$list_menu->id) ? '0' : '1',
                            'showMenu'      => $request->input('showMenu'.$list_menu->id) ? '0' : '1',
                            'status'        => '0',
                            'created_by'    => \Auth::user()->id,
                            'deleted_at'    => null,
                    ]);
                }
            }
            logActivities::addToLog('Group Role and Permission', 'Update Group Role and Permission', 'Update group role and permission for '.master_data_detail::getFieldValue($id, 'description'), '0');
            return Redirect::to(route('group-roles.index'))
                -> with('message', 'Group role berhasil diupdate');
        }else{
            return view('error.403');
        }
    }

}
