<?php

namespace App\Http\Controllers\openApi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\wilayah_administrasi;
use Response;

class OpenApiController extends Controller
{

    public static function checkOrigin($_origin)
    {
        $_allowed_domains = config('app.allowed_domains');
        if(in_array($_origin, $_allowed_domains)){
            return true;
        }else{
            return false;
        }
    }

    public function getWilayahAdministrasi(Request $request)
    {
        if(Self::checkOrigin(parse_url($request->headers->get('origin'),  PHP_URL_HOST))){
            $_where = 'status="0" And length(kode)=2';
            $_data = wilayah_administrasi::whereRaw($_where)
                -> get();
            $_result['type'] = 'Provinsi';
            $_result['data'] = $_data;
            $_results[] = $_result;
            if(isset($request->refid)){
            }else{

            }

            return response()->json([
                'status'    =>false,
                'code'      => 200,
                'message'   =>'Ok',
                'data'      => $_results
            ]);
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
