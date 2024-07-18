<?php

namespace App\Http\Controllers\openApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wilayah_administrasi;
use Validator;
use Response;

class OpenApiController extends Controller
{

    public static function checkOrigin($_origin)
    {
        $_allowed_domains = config('app.allowed_domains');
        return true;
        if(in_array($_origin, $_allowed_domains)){
            return true;
        }else{
            return false;
        }
    }

    public function getWilayahAdministrasi(Request $request)
    {
        if(Self::checkOrigin(parse_url($request->headers->get('origin'), PHP_URL_HOST))){
            $_result['status'] = false;
            $_result['code'] = 502;
            $_result['data'] = [];
            $validator = Validator::make($request->all(), 
                [
                    'ref' => 'nullable|regex:/^[0-9\.]+$/|max:255',
                ],
                [
                    'regex' => 'Kode referensi salah!',
                ]
            );
            if ($validator->fails()) {
                $_result['message'] = $validator->errors()->first();
                return response()->json($_result);
            }
            $_kode = array();
            if(isset($request->ref) && $request->ref !== '0'){
                $_kode = explode('.', $request->ref);
            }
            $_kodex = $_kode;
            $_cur_code = @$_kode[0];

            //Provinsi
            $_where = 'status="0" And length(kode)=2';
            $_data = wilayah_administrasi::whereRaw($_where)
                -> get();
            $_prov = '<select class="form-select rounded-0 bg-white" name="provinsi" id="provinsi" data-target="'.route('public.wilayah-administrasi').'">';
            $_prov.='<option value="0" selected>Seluruh Provinsi</option>';
            foreach($_data as $data){
                $_prov.='<option value="'.$data->kode.'"';
                if($_cur_code === $data->kode){
                    $_prov.=' selected';
                }
                $_prov.='>'.$data->nama.'</option>';
            }
            $_prov.='</select>';
            $_result['data'][] = $_prov;

            $_refid = null;
            $_length_code = 5;
            $_i = 1;
            $_caption = ['Provinsi', 'Kabupaten', 'Kecamatan', 'Kelurahan'];
            foreach($_kode as $kode){
                $_cur_code.='.'.@$_kodex[$_i];
                $_refid.=$kode.'.';
                $_where = 'status="0" And length(kode)='.$_length_code;
                if(!is_null($_refid)){
                    $_where.=' And kode Like "'.$_refid.'%"';
                }
                $_data = wilayah_administrasi::whereRaw($_where)
                    -> get();
                $_select = '<select class="form-select rounded-0 bg-white" name="'.strtolower($_caption[$_i]).'" id="'.strtolower($_caption[$_i]).'" data-target="'.route('public.wilayah-administrasi').'">';
                $_select.='<option value="0" selected>Seluruh '.$_caption[$_i].'</option>';
                foreach($_data as $data){
                    $_select.='<option value="'.$data->kode.'"';
                    if($_cur_code === $data->kode){
                        $_select.=' selected';
                    }
                    $_select.='>'.$data->nama.'</option>';
                }
                $_select.='</select>';
                $_result['data'][] = $_select;
                if($_length_code < 8){
                    $_length_code+=3;
                }else{
                    $_length_code=13;
                }
                $_i++;
            }
            $_result['status'] = true;
            $_result['code'] = 200;
            $_result['message'] = 'Ok';
            return response()->json($_result);
        }else{
            return response()->json([
                'status'    =>false,
                'code'      => 502,
                'message'   =>'Bad Request',
                'data'      => []
            ]);
        }
    }

}
