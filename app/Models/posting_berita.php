<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class posting_berita extends Model
{
    use HasFactory, SoftDeletes;
    
	protected $table = 'tbl_berita';
	protected $primaryKey = 'id';
	protected $guarded = [];
	protected $dates = ['deleted_at'];

    public function kategoriBerita(){
        return $this->belongsTo(master_data_detail::class,'id_kategori','id')->select('id', 'description');
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

}
