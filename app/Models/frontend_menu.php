<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class frontend_menu extends Model
{
    use HasFactory, SoftDeletes;
    
	protected $table = 'tbl_frontend_menu';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

    public static function parentCaption($refid){
        $_result = Self::where('id', $refid)->first();
        return @$_result->caption;
    }

    public static function getMenu($refid){
        $_result = Self::selectRaw('tbl_frontend_menu.*, count(b.id) as jml_sub')
            -> leftJoin('tbl_frontend_menu as b', 'b.refid', '=', 'tbl_frontend_menu.id')
            -> whereRaw('tbl_frontend_menu.status <> "2" And tbl_frontend_menu.refid='.$refid)
            -> orderBy('tbl_frontend_menu.sequence')
            -> groupBy('tbl_frontend_menu.id')
            -> get();
        return $_result;
    }

}
