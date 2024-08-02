<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'related_to_employee',
        'pictures',
        'role',
        'created_by',
        'status',
        'current_login',
        'current_ip',
        'last_login',
        'last_ip',
        'role_absen',
        'email_verified_at',
        'access_token',
        'macAddr',
        'manufacture',
        'sysName',
        'sysModel',
        'deviceId',
        'androidId',
        'noHp',
        'id_div',
        'activation_expired_at',
        'param',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userRole(){
        return $this->belongsTo(master_data_detail::class,'role','id')->select('id', 'description');
    }

    public static function haveToken(){
        $_check = \Auth::user()->access_token;
        if(!is_null($_check)){
            return true;
        }
        return false;
    }

    public static function haveIndex($menu)
    {
        if(Self::hasPermission($menu, 'show')){
            return true;
        }else{
            return false;
        }
    }

    public static function canCreate($menu)
    {
        if(Self::hasPermission($menu, 'create')){
            return true;
        }else{
            return false;
        }
    }

    public static function canUpdate($menu)
    {
        if(Self::hasPermission($menu, 'update')){
            return true;
        }else{
            return false;
        }
    }

    public static function canSuspend($menu)
    {
        if(Self::hasPermission($menu, 'suspend')){
            return true;
        }else{
            return false;
        }
    }

    public static function canDelete($menu)
    {
        if(Self::hasPermission($menu, 'delete')){
            return true;
        }else{
            return false;
        }
    }
    
    public static function isDeveloper(){
        if(\Auth::user() && \Auth::user()->getRoleName()==='Developer'){
            return true;
        }else{
            return false;
        }
    }
    
    public static function isSuperAdministrator(){
        if(\Auth::user() && (\Auth::user()->getRoleName()==='Super Administrator')){
            return true;
        }else{
            return false;
        }
    }
    
    public static function isAdministrator(){
        if(\Auth::user() && (\Auth::user()->getRoleName()==='Administrator')){
            return true;
        }else{
            return false;
        }
    }
    
    public static function isAdminSkpd(){
        if(\Auth::user() && (\Auth::user()->getRoleName()==='Admin SKPD')){
            return true;
        }else{
            return false;
        }
    }

    public static function getRoleName(){
        $_result = DB::table('tbl_master_data_detail as a')
            -> selectRaw('description')
            -> whereRaw('id='.\Auth::user()->role)
            -> first();
        return $_result->description;
    }

    public static function hasPermission($title, $index)
    {
        if(\Auth::user()->isDeveloper()){
            return true;
        }else{
            $_id = \App\Models\backend_menu::getIdMenu($title);
            $_check = DB::table('tbl_user_role')
                -> whereRaw('status="0" And userid='.\Auth::user()->id.' And menuid='.($_id ?? 0).' And `'.$index.'`="0"')
                -> count('id');
            if((int)$_check===1){
                return true;
            }else{
                return false;
            }
        }
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return @$_result->{$field};
    }

	public static function deleteStatus($id){
		Self::where('id', $id)
			-> where('status', '<>', '2')
			-> update([
				'status' => '2',
				'updated_by' => \Auth::user()->id,
		]);
	}
    
}
