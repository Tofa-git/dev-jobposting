<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class wilayah_administrasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_wilayah_administrasi';
	protected $primaryKey = 'id';
	protected $guarded = [];

    const keterangan = array('Provinsi', 'Kabupaten', 'Kecamatan', 'Kelurahan');

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

    public static function getChild($ref, $type){
    	$_length = 0;
    	if($type===strtolower('kabupaten')){
    		$_length = 5;
    	}elseif($type===strtolower('kecamatan')){
    		$_length = 8;
    	}elseif($type===strtolower('kelurahan')){
    		$_length = 13;
    	}
    	$_result = Self::whereRaw('kode Like "'.$ref.'.%" And length(kode)='.$_length)
    		-> get();
    	return $_result;
    }

    public static function getName($kode){
        $_kode = explode('.', $kode);
        return Self::keterangan[count($_kode) - 1];
    }
}