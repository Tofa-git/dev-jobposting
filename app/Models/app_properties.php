<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Config;

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

	public static function setMailConfig(){
		$mail = Self::select('mail_driver', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption')
            -> first();
        if($mail && !is_null($mail->mail_driver) && !is_null($mail->mail_host) && !is_null($mail->mail_port) && !is_null($mail->mail_username) && !is_null($mail->mail_password) && !is_null($mail->mail_encryption)){
            $config = array(
                'transport'     => $mail->mail_driver,
                'host'          => $mail->mail_host,
                'port'          => $mail->mail_port,
                'encryption'    => $mail->mail_encryption,
                'username'      => $mail->mail_username,
                'password'      => base64_decode($mail->mail_password),
            );
            Config::set('mail.mailers.smtp', $config);
        }
	}

}
