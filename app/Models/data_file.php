<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;

class data_file extends Model
{
    use HasFactory, SoftDeletes;
    
	protected $table = 'tbl_data_file';
	protected $primaryKey = 'id';
	protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'created_by','id')->select('id', 'name', 'email');
    }

    public static function getFieldValue($id, $field){
        $_result = Self::find($id, [$field]);
        return $_result->{$field};
    }

    public static function createPublicParam($fName){
    	if(is_null($fName)){
    		return null;
    	}
		$date = now();
		date_add($date, date_interval_create_from_date_string("30 minutes"));
		$data = [
			'user'			=> \Auth::user()->email ?? 'guest',
			'filename'		=> $fName,
			'date_request'	=> date_format(now(), 'Y-m-d H:i:s'),
			'expiration'	=> $date,
		];
		$depth = rand(100,999);
		for($_i=0; $_i<3; $_i++){
			$data = base64_encode(json_encode($data));
		}
		$salt = str_replace('-', '', Str::uuid()->toString());
		$data = substr_replace($data, $depth.$salt, 16, 0);
		return $data;
	}

    public static function createParam($fName){
    	if(is_null($fName)){
    		return null;
    	}
		$date = now();
		date_add($date, date_interval_create_from_date_string("1 hours"));
		$data = [
			'user'			=> \Auth::user()->email ?? 'guest',
			'filename'		=> $fName,
			'date_request'	=> date_format(now(), 'Y-m-d H:i:s'),
			'expiration'	=> date_format($date, 'Y-m-d H:i:s'),
		];
		$depth = rand(100,999);
		for($_i=0; $_i<3; $_i++){
			$data = base64_encode(json_encode($data));
		}
		$salt = str_replace('-', '', Str::uuid()->toString());
		$data = substr_replace($data, $depth.$salt, 16, 0);
		return $data;
	}

    public static function decParam($ref){
    	$check = $ref;
    	$_results['status'] = false;
		$_results['code'] = 0;
		$_results['message'] = 'Not authorized';
		$_results['data'] = null;
		if(is_null($ref)){
			return $_results;
		}
		$check = substr_replace($ref, '', 16, 35);
		for($_i=0; $_i<3; $_i++){
			$check = base64_decode(json_encode($check));
		}
		$check = json_decode($check);
		if(strtotime($check->expiration) < strtotime($check->date_request)){
			$_results['message'] = 'Link request expired!';
		}else{
			$_checkFile = Self::checkFileExists($check->filename);
			if($_checkFile->status){
	    		$_results['status'] = true;
				$_results['code'] = 1;
				$_results['message'] = 'Authorized';			
				$_results['data'] = $_checkFile;
			}else{
	    		$_results['status'] = false;
				$_results['message'] = 'File not exists';
			}
		}
		return json_encode($_results);
	}

	public static function checkFileExists($fName){
		$check = Self::where('status', '0')
			-> where('filename', $fName)
			-> first();
		$_result['status'] = false;
		$_result['message'] = 'File not found!';
		$_result['fileInfo'] = null;
		if($check){
			if(File::exists(public_path('storage'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.$check->location.DIRECTORY_SEPARATOR.$check->filename))){
				$_result['status'] = true;
				$_result['message'] = 'File exists';
				$_result['fileInfo']['folder'] = $check->location;
				$_result['fileInfo']['filename'] = $check->filename;
				$_result['fileInfo']['extension'] = $check->extension;
				$_result['fileInfo']['description'] = $check->description;
			}
		}
		return json_decode(json_encode($_result));
	}

    public static function decImage($ref){
    	$check = $ref;
    	$_results['status'] = false;
		$_results['code'] = 0;
		$_results['message'] = 'Not authorized';
		$_results['data'] = null;
		if(is_null($ref)){
			return $_results;
		}
		$check = substr_replace($ref, '', 16, 35);
		for($_i=0; $_i<3; $_i++){
			$check = base64_decode(json_encode($check));
		}
		$check = json_decode($check);
		if($check->expiration < $check->date_request){
			$_results['message'] = 'Link request expired!';
		}else{
			$_checkFile = Self::checkFileExists($check->filename);
			if($_checkFile->status){
	    		$_results['status'] = true;
				$_results['code'] = 1;
				$_results['message'] = 'Authorized';			
				$_results['data'] = $_checkFile;
			}else{
	    		$_results['status'] = false;
				$_results['message'] = 'File not exists';
			}
		}
		return json_encode($_results);
	}

    public static function getAvatar($fName){
    	$_get_file = null;
    	if(!is_null($fName)){
	    	$ref = Self::createParam($fName);
    	    $_get_file = Self::decParam($ref);
        	$_get_file = json_decode($_get_file);
        }
        if(@$_get_file->status){
            $_file = 'data:image/'.strtolower($_get_file->data->fileInfo->extension).';base64,'.base64_encode(file_get_contents(
            	public_path('storage'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.str_replace('/', '', $_get_file->data->fileInfo->folder).DIRECTORY_SEPARATOR.'small'.DIRECTORY_SEPARATOR.$_get_file->data->fileInfo->filename)));
        }else{
            $_file = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'icons'.DIRECTORY_SEPARATOR.'unknown avatar.png')));
        }
        return $_file;
    }

    public static function getThumbnailImage($fName){
    	$_get_file = null;
    	if(!is_null($fName)){
	    	$ref = Self::createParam($fName);
    	    $_get_file = Self::decParam($ref);
        	$_get_file = json_decode($_get_file);
        }
        if(@$_get_file->status){
            $_file = 'data:image/'.strtolower($_get_file->data->fileInfo->extension).';base64,'.base64_encode(file_get_contents(
            	public_path('storage'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.str_replace('/', '', $_get_file->data->fileInfo->folder).DIRECTORY_SEPARATOR.'small'.DIRECTORY_SEPARATOR.$_get_file->data->fileInfo->filename)));
        }else{
            $_file = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'icons'.DIRECTORY_SEPARATOR.'404.jpg')));
        }
        return $_file;
    }

    public static function getLogo($fName){
    	$_get_file = null;
    	if(!is_null($fName)){
	    	$ref = Self::createParam($fName);
    	    $_get_file = Self::decParam($ref);
        	$_get_file = json_decode($_get_file);
        }
        if(@$_get_file->status){
            $_file = 'data:image/'.strtolower($_get_file->data->fileInfo->extension).';base64,'.base64_encode(file_get_contents(
            	public_path('storage'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.str_replace('/', '', $_get_file->data->fileInfo->folder).DIRECTORY_SEPARATOR.'small'.DIRECTORY_SEPARATOR.$_get_file->data->fileInfo->filename)));
        }else{
            $_file = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'logo.png')));
        }
        return $_file;
    }

    public static function getImage($fName){
    	$_get_file = null;
    	if(!is_null($fName)){
	    	$ref = Self::createParam($fName);
    	    $_get_file = Self::decParam($ref);
        	$_get_file = json_decode($_get_file);
        }
        if(@$_get_file->status){
            $_file = 'data:image/'.strtolower($_get_file->data->fileInfo->extension).';base64,'.base64_encode(file_get_contents(
            	public_path('storage'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.str_replace('/', '', $_get_file->data->fileInfo->folder).DIRECTORY_SEPARATOR.$_get_file->data->fileInfo->filename)));
        }else{
            $_file = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'icon'.DIRECTORY_SEPARATOR.'404.jpg')));
        }
        return $_file;
    }

    public static function getPublicImage($fName){
    	$_get_file = null;
    	if(!is_null($fName)){
    	    $_get_file = Self::decParam($fName);
        	$_get_file = json_decode($_get_file);
        }
        if(@$_get_file->status){
            $_file = 'data:image/'.strtolower($_get_file->data->fileInfo->extension).';base64,'.base64_encode(file_get_contents(
            	public_path('storage'.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.str_replace('/', '', $_get_file->data->fileInfo->folder).DIRECTORY_SEPARATOR.$_get_file->data->fileInfo->filename)));
        }else{
            $_file = 'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'icon'.DIRECTORY_SEPARATOR.'404.jpg')));
        }
        return $_file;
    }

}
