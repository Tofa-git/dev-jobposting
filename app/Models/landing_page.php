<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class landing_page extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_landing_page';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public function widget(){
        return $this->belongsTo(widget::class,'id_widget','id')->select('id', 'sequence', 'description', 'target');
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

}
