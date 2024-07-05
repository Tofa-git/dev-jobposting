<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_properties extends Model
{
    use HasFactory;
    
	protected $table = 'tbl_app_properties';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

	public static function haveFrontend(){
		$_data = app_properties::select('frontend_website')
			-> where('status', '0')
			-> first();
		if($_data->frontend_website===0){
			return false;
		}else{
			return true;
		}
	}

	public static function apiHost():string {
		$_result = Self::select('api_host')
			-> where('status', '0')
			-> first();
		return @$_result->api_host;
	}

	public static function apiSecret():string {
		$_result = Self::select('api_secret')
			-> where('status', '0')
			-> first();
		return @$_result->api_secret;
	}

}
