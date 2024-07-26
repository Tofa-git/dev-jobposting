<?php

namespace App\Helpers;
use Carbon\Carbon;
use DateTime;
use DateInterval;
use DatePeriod;
use Request;
use Storage;
use File;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\data_file;
use App\Models\app_properties;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\User;

class general
{

	const bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    const short_bulan = array('Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des');
    const hari = array('Seluruh Hari','Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

    public static function formatTanggal($tanggal, $format){
        $waktu = date_create($tanggal);
        $dt = new Carbon($waktu);
        setlocale(LC_TIME, 'IND');
        return $dt->isoFormat($format);        
    }

    public static function waktuPosting($tanggal){
        $waktu = date_create($tanggal);
        $waktu_sekarang = date_create();
        $selisih = date_diff($waktu, $waktu_sekarang);
        $dt = new Carbon($waktu);
        setlocale(LC_TIME, 'IND');
        if($selisih->d > 0){
            return $dt->isoFormat('dddd, D MMMM Y');
        }else{
            return $dt->diffForHumans();
            /*
            if($selisih->h > 0){
                return (int)$selisih->h.' Jam yang lalu';
            }elseif($selisih->i > 0){
                return (int)$selisih->i.' menit yang lalu';
            }else{
                return 'Baru saja';
            }
            */
        }
    }

    function createSlug($str, $delimiter = '-'){
        $_slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        return $_slug;
    }
    
    public function yyyymmddToShort($tanggal){
        $_result = substr($tanggal, 8,2).'-'.Self::short_bulan[(int)substr($tanggal, 5,2) - 1].'-'.substr($tanggal, 0,4);
        return $_result;
    }

    public static function potongKalimat($kalimat, $jumlah){
        $_kalimat = substr(strip_tags($kalimat), 0, $jumlah);
        if(strlen($kalimat) > $jumlah){
            $_endpoint = strrpos($_kalimat, ' ');
            $_kalimat = $_endpoint? substr($_kalimat, 0, $_endpoint) : substr($_kalimat, 0);
            $_kalimat .= '...';
        }
        return $_kalimat;
    }

    public static function getPublicToken(){
        $_user = \Auth::user();
        if(is_null($_user->public_token)){
            $url = app_properties::apiHost()."/auth/create-token";
            $headers = [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ];
            $options = [
                'verify' => false,
            ];
            $date = now();
            $date_req = now();
            date_add($date, date_interval_create_from_date_string("5 hours"));
            $param = [
                'user' => $_user->email,
                'origin' => config('app.url'),
                'role' => 'guest',
                'date_request' => date_format($date_req, 'Y-m-d h:i:s'),
                'date_expired' => date_format($date, 'Y-m-d h:i:s'),
                'token' => app_properties::apiSecret(),
            ];
            $_result = Http::withHeaders($headers)
                -> withOptions($options)
                -> post($url, $param)
                -> json();
            $_hasil = json_decode(json_encode(@$_result));
            return @$_hasil->token;
        }else{
            return null;
        }
    }

    public static function getToken(){
        $_user = \Auth::user();
        if(is_null($_user->access_token)){
            $url = app_properties::apiHost()."/auth/create-token";
            $headers = [
                'Accept'        => 'application/json',
                'Content-Type'  => 'application/json',
            ];
            $options = [
                'verify' => false,
            ];
            $param = [
                'user' => $_user->email,
                'role' => $_user->role,
                'token' => app_properties::apiSecret(),
            ];
            $_result = Http::withHeaders($headers)
                -> withOptions($options)
                -> post($url, $param)
                -> json();
            $_hasil = json_decode(json_encode(@$_result));
            return @$_hasil->token;
        }else{
            return null;
        }
    }

    public static function checkFolder($_check_ext){
        if(($_check_ext==='JPG') || ($_check_ext==='PNG') || ($_check_ext==='BMP') || ($_check_ext==='JPEG') || ($_check_ext==='GIF')){
            return 'pictures';
        }elseif(($_check_ext==='DOC') || ($_check_ext==='DOCX') || ($_check_ext==='XLS') || ($_check_ext==='XLSX') || ($_check_ext==='PPT') || ($_check_ext==='PPTX') || ($_check_ext==='PDF')){
            return 'documents';
        }else{
            return 'others';
        }
    }

    public static function storeFile($fname, $fType, $desc, $owner){
        $fExt               = strtoupper($fname->getClientOriginalExtension());
        $_group_folder      = Self::checkFolder($fExt);
        $_file_name         = (string) Str::uuid().'.'.$fExt;
        $_upload = $fname->storeAS('upload'.DIRECTORY_SEPARATOR.$_group_folder, $_file_name, 'public');

        if(($fExt==='JPG') || ($fExt==='JPEG') || ($fExt==='PNG') || ($fExt==='BMP') || ($fExt==='GIF')){
            /*/resize height to 320 */
            $resizeImage = Image::read($fname);
            $resizeImage->scale(height: 320);
            $resizeImage->save(storage_path('/app/public/upload').DIRECTORY_SEPARATOR.$_group_folder.DIRECTORY_SEPARATOR.'small'.DIRECTORY_SEPARATOR.$_file_name);
        }
        $_size = $fname->getSize();
        $_satuan = 'B';
        if($_size > 1024){
            $_size = $_size / 1024;
            $_satuan = 'KB';
        }
        if($_size > 1024){
            $_size = $_size / 1024;
            $_satuan = 'MB';
        }
        if($_size > 1024){
            $_size = $_size / 1024;
            $_satuan = 'GB';
        }
        if($_size > 1024){
            $_size = $_size / 1024;
            $_satuan = 'TB';
        }
        $_upload_data       = data_file::create([
            'type'          => $_group_folder,
            'location'      => '/' . $_group_folder,
            'filename'      => $_file_name,
            'extension'     => $fExt,
            'size'          => $fname->getSize(),
            'description'   => $desc,
            'owner'         => $owner,
            'created_by'    => @\Auth::user()->id ?? $owner,
            'status'        => '0'
        ]);
        $_result = [
            'name'          => $_file_name,
            'type'          => $_group_folder,
            'ext'           => $fExt,
            'size'          => number_format($_size, 2). ' '. $_satuan,
            'folder'        => '/' . $_group_folder,
        ];
        return json_encode($_result);
    }

    public static function convertAngkaToMininal($angka){
        $_satuan = '';
        $_nomor = (int)@$angka;
        if($_nomor > 0 && $_nomor < 1000){
            $_satuan = ''; 
        }
        if($_nomor > 1000){
            $_nomor = $_nomor / 1000;
            $_satuan = 'K';
        }
        if($_nomor > 1000){
            $_nomor = $_nomor / 1000;
            $_satuan = 'M';
        }
        return str_replace('.0', '', number_format($_nomor, 1)).$_satuan;
    }

    public static function convertFileSize($angka){
        $_satuan = '';
        $_nomor = (int)@$angka;
        if($_nomor > 0 && $_nomor < 1024){
            $_satuan = ' B'; 
        }
        if($_nomor > 1024){
            $_nomor = $_nomor / 1024;
            $_satuan = ' KB';
        }
        if($_nomor > 1024){
            $_nomor = $_nomor / 1024;
            $_satuan = ' MB';
        }
        if($_nomor > 1024){
            $_nomor = $_nomor / 1024;
            $_satuan = ' GB';
        }
        $_nomor = number_format($_nomor, 0);
        return $_nomor.$_satuan;
    }

}