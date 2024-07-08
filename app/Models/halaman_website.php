<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class halaman_website extends Model
{
    use HasFactory, SoftDeletes;
    
	protected $table = 'tbl_halaman_website';
	protected $primaryKey = 'id';
	protected $guarded = [];
	protected $dates = ['deleted_at'];

    public function layout(){
        return $this->belongsTo(master_data_detail::class,'id_layout','id')->select('id', 'description');
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

}
