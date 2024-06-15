<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class informasi_penting extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_informasi_penting';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public function jenis(){
        return $this->belongsTo(master_data_detail::class,'id_jenis','id')->select('id', 'description');
    }

    public function kategori(){
        return $this->belongsTo(master_data_detail::class,'id_kategori','id')->select('id', 'description');
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }
}
