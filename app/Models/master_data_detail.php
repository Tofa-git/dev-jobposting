<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class master_data_detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_master_data_detail';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public function masterData(){
        return $this->belongsTo(master_data::class,'refid','id')->select('id', 'description');
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }
    
}
