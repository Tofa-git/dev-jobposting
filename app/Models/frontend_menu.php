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

}
