<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class master_data extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_master_data';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }
    
}
