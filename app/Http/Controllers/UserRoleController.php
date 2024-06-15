<?php

namespace App\Http\Controllers;

use App\Models\user_role;
use Illuminate\Http\Request;
use App\Models\group_role;
use App\Models\User;
use App\Helpers\logActivities;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class UserRoleController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'User Management';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_role $user_role)
    {
        if(User::canUpdate($this->namaMenu)){
            if (!is_numeric($user_role->id)) {
                return Redirect::to(url()->previous())
                    -> with('error', 'Input paramater salah!');
            }
            $_data = User::where('id', $user_role->id)
                -> first();
            $_list_menu = user_role::getUserMenu($user_role->id, $_data->role);
            $_result = view('backend.user management.edit role')
                -> with('title', 'Edit User Role')
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('list_menu', $_list_menu)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Update User Role';
            return $this->success($_hasil);
        }else{
            return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user_role $user_role)
    {
        if(User::canUpdate($this->namaMenu)){
            if (!is_numeric(@$user_role->id)) {
                return Redirect::to(url()->previous())
                    -> with('error', 'ID menu salah');
            }
            $_check_new_menu = group_role::selectRaw('id, menuid, showMenu, `show`, `create`, `update`, `suspend`, `delete`')
                -> whereRaw('menuid Not In (select b.menuid From tbl_user_role as b where b.userid='.$user_role->id.') And userid='.User::getFieldValue($user_role->id, 'role'))
                -> get();
            foreach($_check_new_menu as $check_new_menu){
                if($check_new_menu->showMenu==='0' || $check_new_menu->show==='0' || $check_new_menu->create==='0' || $check_new_menu->update==='0' || $check_new_menu->suspend==='0' || $check_new_menu->delete==='0'){
                    user_role::create([
                        'userid'    => $user_role->id,
                        'menuid'    => $check_new_menu->menuid,
                        'status'    => '1',
                        'created_by' => \Auth::user()->id
                    ]);
                }
            }
            $_check = user_role::whereRaw('userid='.$user_role->id)
                -> count('id');
            $_list_menu = user_role::getUserMenu($user_role->id, User::getFieldValue($user_role->id, 'role'));
            if($_check > 0){
                foreach($_list_menu as $list_menu){
                    user_role::whereRaw('menuid='.$list_menu->id.' And userid='.$user_role->id)
                        -> update([
                            'showMenu'      => $request->input('showMenu'.$list_menu->id) ? '0' : '1',
                            'show'          => $request->input('show'.$list_menu->id) ? '0' : '1',
                            'create'        => $request->input('create'.$list_menu->id) ? '0' : '1',
                            'update'        => $request->input('update'.$list_menu->id) ? '0' : '1',
                            'suspend'       => $request->input('suspend'.$list_menu->id) ? '0' : '1',
                            'delete'        => $request->input('delete'.$list_menu->id) ? '0' : '1',
                            'status'        => '0',
                            'created_by'    => \Auth::user()->id
                    ]);
                }
                logActivities::addToLog('Update', 'Update Success', 'Update user account permission for '.\Auth::user()->email, '0');
                return Redirect::to(route('user-management.index'))
                    -> with('message', 'User Role berhasil diupdate');
            }else{
                foreach($_list_menu as $list_menu){
                    user_role::create([
                        'userid'        => $user_role->id,
                        'menuid'        => $list_menu->id,
                        'showMenu'      => $request->input('showMenu'.$list_menu->id) ? '0' : '1',
                        'show'          => $request->input('show'.$list_menu->id) ? '0' : '1',
                        'create'        => $request->input('create'.$list_menu->id) ? '0' : '1',
                        'update'        => $request->input('update'.$list_menu->id) ? '0' : '1',
                        'suspend'       => $request->input('suspend'.$list_menu->id) ? '0' : '1',
                        'delete'        => $request->input('delete'.$list_menu->id) ? '0' : '1',
                        'status'        => '0',
                        'created_by'    => \Auth::user()->id
                    ]);
                }
                logActivities::addToLog('Create', 'Create Success', 'Create user account permission for '.\Auth::user()->email, '0');
                return Redirect::to(route('user-management.index'))
                    -> with('message', 'User Role berhasil ditambah');
            }
        }else{
            return view('error.403');
        }
    }
    
}
