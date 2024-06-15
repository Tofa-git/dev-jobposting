<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class group_role extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_group_role';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

	public static function getMenu($refid, $group)
	{
		$groups = $group;
		$_result = DB::table('tbl_backend_menu as a')
			-> leftJoin('tbl_group_role as b', function($_group) use ($groups){
					$_group->on('b.menuid', '=', 'a.id')
						-> on('b.userid', '=', DB::raw($groups))
						-> on('b.status', '=', DB::raw('"0"'));
				})
			-> leftJoin('tbl_backend_menu as c', 'c.refid', 'a.id')
			-> selectRaw('a.id, a.refid, a.sequence, a.menu_type, a.icon, a.caption, ifnull(b.show, 1) as `show`, ifnull(b.create, 1) as `create`, ifnull(b.update, 1) as `update`, ifnull(b.suspend, 1) as `suspend`, ifnull(b.delete, 1) as `delete`, ifnull(b.showMenu, 1) as showMenu, a.status, count(c.id) as jml_sub_menu, a.action')
			-> whereRaw('a.status<>"2" And a.refid='.$refid)
			-> groupBy('a.id')
			-> orderBy('a.sequence')
			-> get();
		return $_result;
	}

	public static function getDataMenu($refid, $group, $_result)
	{
		$_menu = group_role::getMenu($refid, $group);
		foreach ($_menu as $menu){
			array_push($_result, (object)$menu);
			if((int)$menu->jml_sub_menu > 0){
				$_result = group_role::getDataMenu($menu->id, $group, $_result);
			}
		}
		return $_result;
	}

	public static function getGroupMenu($group)
	{
		$_result = [];
		$_result = group_role::getDataMenu(0, $group, $_result);
		return $_result;
	}
    
}
