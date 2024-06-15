<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class log_activity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_log_activities';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public function userAccount(){
        return $this->belongsTo(User::class,'created_by','id')->select('id', 'email');
    }

    public static function destroy($id){
    	$_hapus = false;
    	if(\Auth::user()->isDeveloper()){
    		$_hapus = true;
    	}
    	if(\AUth::user()->isAdministrator()){
    		$_hapus = true;
    	}
    	if($_hapus){
    		Self::where('status', '<>', '"2"')
    			-> where('id', $id)
    			-> update([
    				'status'	=> '2'
    		]);
    	}
    	return $_hapus;
    }
    
}
