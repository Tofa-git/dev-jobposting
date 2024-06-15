<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class backend_menu extends Model
{
    use HasFactory;
    
	protected $table = 'tbl_backend_menu';
	protected $primaryKey = 'id';
	protected $guarded = [];

	public static function renderMenu($activeMenu)
	{
		$_result = '<ul class="side-menu">';
		$_result = Self::setupMenu($_result, 0, $activeMenu);
		$_result.='</ul>';
		return $_result;
	}

	public static function getDataMenu($refid)
	{
		$_data = DB::table('tbl_user_role as a')
			-> selectRaw('a.menuid as id, b.refid, b.sequence, b.menu_type, b.icon, b.caption, b.action, b.create, b.update, b.suspend, b.delete, b.status, count(c.id) as jml_sub_menu')
			-> leftJoin('tbl_backend_menu as b', function($menu){
				$menu->on('b.id', '=', 'a.menuid');
				$menu->on('b.status', '=', DB::raw('"0"'));
			})
			-> leftJoin('tbl_backend_menu as c', function($subMenu){
				$subMenu->on('c.refid', '=', 'b.id');
				$subMenu->on('c.status', '=', DB::raw('"0"'));
			})
			-> whereRaw('a.status="0" And a.showMenu="0" And a.userid='.\Auth::user()->id.' And b.refid='.$refid)
			-> groupBy('a.menuid')
			-> orderBy('b.sequence')
			-> get();
		return $_data;
	}

	public static function setupMenu($_result, $id, $currMenu)
	{
		$menu = backend_menu::getDataMenu($id);
		foreach($menu as $_menu){
				if($_menu->menu_type===4){
					$_result.='<li class="title d-flex flex-column align-self-center align-items-center text-light bg-darkBlue pt-1 pb-1">';
					$_result.='<div class="w-100 p-1 px-2 d-flex align-items-center">';
					$_result.='<i class="material-icons-outlined small">apps</i>';
					$_result.='<span class="ms-2 fw-bold lh-sm small">'.ucwords(strtolower($_menu->caption)).'</span></div></li>';
				}elseif($_menu->menu_type===5){
					if($_menu->jml_sub_menu > 0){
						$_result.='<li class="dropdown">';
						$_result.='<a href="#_'.$_menu->id.'" class="p-2 d-flex align-self-center w-100 align-items-center dropdown-toggle" data-bs-toggle="collapse" aria-control="_'.$_menu->id.'" aria-expanded="false">';
						$_result.='<i class="material-icons-outlined">'.$_menu->icon.'</i>';
						$_result.='<span class="ms-2 w-100">'.ucwords(strtolower($_menu->caption)).'</span></a>';
						$childMenu = backend_menu::getDataMenu($_menu->id);
						$_result.='<div id="_'.$_menu->id.'" class="collapse bg-secondary">';
						foreach ($childMenu as $_childMenu){
							
								if($_childMenu->menu_type===6){
									$_result.='<div style="border-top: 1px solid rgba(255,255,255,0.5); margin-left: -20px"></div>';
								}elseif($_childMenu->menu_type===5){
									$_result.='<a href="'.$_childMenu->action.'" class="p-2 d-flex align-self-center align-items-center text-decoration-none text-nowrap text-light bg-light-hover"><i class="material-icons-outlined">'.$_childMenu->icon.'</i><span class="ms-2">'.ucwords(strtolower($_childMenu->caption)).'</span></a>';
								}
							
						}
						$_result.='</div></li>';
					}else{
						$_result.='<li class="menu">';
						$_result.='<a href="'.$_menu->action.'" class="p-2 ';

						if(str_replace(' ', '-', strtolower($_menu->caption)) === str_replace(' ', '-', strtolower($currMenu))){
							$_result.='active ';
						}
						$_result.='d-flex align-self-center align-items-center">';
						$_result.='<i class="material-icons-outlined">'.$_menu->icon.'</i>';
						$_result.='<span class="ms-2">'.ucwords(strtolower($_menu->caption)).'</span></a></li>';
					}
				}elseif($_menu->menu_type===6){
					$_result.='<li class="separator"></li>';
				}
				if(($_menu->jml_sub_menu > 0) && ($_menu->refid===0)){
					$_result = backend_menu::setupMenu($_result, $_menu->id, $currMenu);
				}
		}
		return $_result;
	}
	
	public static function getIdMenu($caption)
	{
		$_result = DB::table('tbl_backend_menu')
			-> selectRaw('id')
			-> whereRaw('caption="'.$caption.'"')
			-> first();
		return @$_result->id;
	}

}
