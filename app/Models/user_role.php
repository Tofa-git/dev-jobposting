<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class user_role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_user_role';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public static function deleteStatus($userid){
		Self::where('userid', $userid)
			-> where('status', '<>', '2')
			-> update([
				'status' => '2',
				'updated_by' => \Auth::user()->id,
		]);
	}

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

	public static function setRole($user, $group)
	{
		if((int)$user > 0 && (int)$group > 0){
			user_role::where('userid', $user)
				-> update([
					'status'	=> '2',
			]);
			$_data_role = DB::table('tbl_group_role')
				-> where('userid', $group)
                -> where('status', '0')
				-> get();
			foreach($_data_role as $data_role){
				if($data_role->showMenu==='0' || $data_role->show==='0' || $data_role->create==='0' || $data_role->update==='0' || $data_role->suspend==='0' || $data_role->delete==='0'){
					user_role::create([
						'userid'	=> $user,
						'menuid'	=> $data_role->menuid,
						'showMenu'	=> $data_role->showMenu,
						'show'		=> $data_role->show,
						'create'	=> $data_role->create,
						'update'	=> $data_role->update,
						'suspend'	=> $data_role->suspend,
						'delete'	=> $data_role->delete,
						'status'	=> '0',
						'created_by'=> \Auth::user()->id
					]);
				}
			}
			return [
				'success'	=> true,
				'message' 	=> 'Role created successfull'
			];
		}else{
			return [
				'success'	=> false,
				'message' 	=> 'Akun user atau Role tidak terdaftar!'
			];
		}
	}

	public static function getMenu($refid, $userid, $group)
	{
		$_group = $group;
		$_result = DB::table('tbl_backend_menu as a')
			-> leftJoin('tbl_backend_menu as b', 'b.refid', '=', 'a.id')
			-> leftJoin('tbl_group_role as c', function($groups) use($_group){
					$groups->on('c.menuid', '=', 'a.id');
				})
			-> leftJoin('tbl_user_role as d', function($user) use($userid){
					$user->on('d.menuid', '=', 'c.menuid')
						-> on('d.userid', '=', DB::raw($userid));
				})
			-> selectRaw('a.id, a.refid, a.sequence, a.menu_type, a.icon, a.caption, ifnull(c.show, 1) as `show`, ifnull(c.create, 1) as `create`, ifnull(c.update, 1) as `update`, ifnull(c.suspend, 1) as `suspend`, ifnull(c.delete, 1) as `delete`, ifnull(c.showMenu, 1) as showMenu, ifnull(d.show, 1) AS user_show, ifnull(d.create, 1) AS user_create, ifnull(d.update, 1) AS user_update, ifnull(d.suspend, 1) as user_suspend, ifnull(d.delete, 1) AS user_delete, ifnull(d.showMenu, 1) AS user_showMenu, a.status, count(b.id) as jml_sub_menu, a.action')
			-> whereRaw('a.status="0" And a.refid='.$refid.' And c.userid='.$_group.' And c.status="0"')
			-> groupBy('a.id')
			-> orderBy('a.sequence')
			-> get();
		return $_result;
	}

	public static function getDataMenu($refid, $userid, $group, $_result)
	{
		$_menu = user_role::getMenu($refid, $userid, $group);
		foreach ($_menu as $menu){
			if($menu->showMenu==='0' || $menu->show==='0' || $menu->create==='0' || $menu->update==='0' || $menu->suspend==='0' || $menu->delete==='0'){
				array_push($_result, (object)$menu);
			}
			if((int)$menu->jml_sub_menu > 0){
				$_result = user_role::getDataMenu($menu->id, $userid, $group, $_result);
			}
		}
		return $_result;
	}

	public static function getUserMenu($userid, $group)
	{
		$_result = [];
		$_result = user_role::getDataMenu(0, $userid, $group, $_result);
		return $_result;
	}
    
}
