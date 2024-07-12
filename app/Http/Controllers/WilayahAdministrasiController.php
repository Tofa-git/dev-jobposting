<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wilayah_administrasi;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;
use Response;

class WilayahAdministrasiController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Wilayah Administrasi';

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(User::haveIndex($this->namaMenu)){
            $validator = Validator::make($request->all(), 
                [
                    'total'     => 'nullable|numeric|gt:0',
                    'q'         => 'nullable|regex:/^[a-zA-Z0-9\s]+$/|max:255',
                ],
                [
                    'total.numeric' => 'Jumlah baris harus bertipe numeric!',
                    'total.gt' => 'Jumlah baris harus lebih besar dari 0!',
                    'q.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()) {
                return Redirect::to(url()->previous())
                    -> withErrors($validator);
            }
            $_total = 25;
            if(isset($request->total)){
                $_total = $request->total;
            }
            $_provinsi = wilayah_administrasi::whereRaw('length(kode)=2')
                -> get();
            $_kabupaten = [];
            $_kecamatan = [];
            $_kelurahan = [];

            $_where = '';
            $_active = 0;
            if(isset($request->provinsi)){
                $_kabupaten = wilayah_administrasi::getChild($request->provinsi, 'kabupaten');
                $_active = 1;
            }
            if(isset($request->kabupaten)){
                $_kecamatan = wilayah_administrasi::getChild($request->kabupaten, 'kecamatan');
                $_active = 2;
            }
            if(isset($request->kecamatan)){
                $_active = 3;
            }
            if($_active === 0){
                $_where.='length(kode) = 2';
            }elseif($_active === 1){
                $_where.='kode Like "'.$request->provinsi.'.%" And length(kode) = 5';
            }elseif($_active === 2){
                $_where.='kode Like "'.$request->kabupaten.'.%" And length(kode) = 8';
            }elseif($_active === 3){
                $_where.='kode Like "'.$request->kecamatan.'.%" And length(kode) = 13';
            }
            if(isset($request->q)){
                $_where.=' And nama Like "%'.$request->q.'%"';
            }
            $_data = wilayah_administrasi::whereRaw($_where)
                -> orderBy('kode')
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.wilayah administrasi.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('provinsi', $_provinsi)
                -> with('kabupaten', $_kabupaten)
                -> with('kecamatan', $_kecamatan)
                -> with('total', $_total)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(User::canUpdate($this->namaMenu)){
            $_data = wilayah_administrasi::find($id);
            $_jenis = ['Provinsi', 'Kabupaten/Kota', 'Kecamatan'];
            $_parent = [];
            if(strlen($_data->kode) > 2){
                $_kode = explode('.', $_data->kode);
                $_kd = '';
                for($_i = 0; $_i < (count($_kode) - 1); $_i++){
                    if($_i === 0){
                        $_kd = $_kode[$_i];
                    }else{
                        $_kd.='.'.$_kode[$_i];
                    }
                    $_temp = [];
                    $_temp['jenis'] = $_jenis[$_i];
                    $_check = wilayah_administrasi::where('kode', $_kd)->first();
                    $_temp['kode'] = @$_check->kode;
                    $_temp['nama'] = @$_check->nama;
                    $_parent[] = $_temp;
                }
            }
            $_result = view('backend.wilayah administrasi.edit')
                -> with('title', 'Edit '.$this->namaMenu)
                -> with('data', $_data)
                -> with('parent', $_parent)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Edit '.$this->namaMenu;
            return $this->success($_hasil);
        }else{
            return view('error.403');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(User::canUpdate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'kode_wilayah'  => 'required|max:16|regex:/^[0-9\.]+$/',
                    'nama'          => 'required|max:64|regex:/^[a-zA-Z0-9\s\-\,\.]+$/',
                ],
                [
                    'required' => 'Nilai :attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'max' => 'Nilai :attribute melebihi batas maksimal!',
                ]
            );
            $_data = wilayah_administrasi::find($id);
            $_param = [];
            $_kode = explode('.', $_data->kode);
            if(count($_kode) === 2){
                $_param['provinsi'] = $_kode[0];
            }elseif(count($_kode) === 3){
                $_param['provinsi'] = $_kode[0];
                $_param['kabupaten'] = $_kode[0].'.'.$_kode[1];
            }elseif(count($_kode) === 4){
                $_param['provinsi'] = $_kode[0];
                $_param['kabupaten'] = $_kode[0].'.'.$_kode[1];
                $_param['kecamatan'] = $_kode[0].'.'.$_kode[1].'.'.$_kode[2];
            }
            if ($validator->fails()){
                $_jenis = ['Provinsi', 'Kabupaten/Kota', 'Kecamatan'];
                $_parent = [];
                if(strlen($_data->kode) > 2){
                    $_kd = '';
                    for($_i = 0; $_i < (count($_kode) - 1); $_i++){
                        if($_i === 0){
                            $_kd = $_kode[$_i];
                        }else{
                            $_kd.='.'.$_kode[$_i];
                        }
                        $_temp = [];
                        $_temp['jenis'] = $_jenis[$_i];
                        $_check = wilayah_administrasi::where('kode', $_kd)->first();
                        $_temp['kode'] = @$_check->kode;
                        $_temp['nama'] = @$_check->nama;
                        $_parent[] = $_temp;
                    }
                }
                $_result = view('backend.wilayah administrasi.edit')
                    -> withErrors($validator)
                    -> with('title', $this->namaMenu)
                    -> with('data', $_data)
                    -> with('parent', $_parent)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('master-data.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Edit '.$this->namaMenu)
                    -> with('modal', 'edit');
            }
            wilayah_administrasi::where('id', $id)
                -> update([
                    'kode'   => $request->kode_wilayah,
                    'nama'   => $request->nama,
            ]);
            logActivities::addToLog('Wilayah Administrasi', 'Update Wilayah Administrasi', $request->description, '0');
            return Redirect::to(route('wilayah-administrasi.index', $_param))
                -> with('message', 'Wilayah Administrasi berhasil diupdate');
        }else{
            return view('error.403');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if(User::canDelete($this->namaMenu)){
            $_check_data = wilayah_administrasi::find($id);
            if($_check_data){
                $_data = wilayah_administrasi::where('id', $id)
                    -> delete();
                logActivities::addToLog('Wilayah Administrasi', 'Delete Wilayah Administrasi', 'delete Wilayah Administrasi untuk '.$_check_data->nama, '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Wilayah Administrasi berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Wilayah Administrasi tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = wilayah_administrasi::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    wilayah_administrasi::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Wilayah Administrasi', 'Update Status Wilayah Administrasi', 'Update status Wilayah Administrasi menjadi active untuk '.$_check_data->nama, '0');
                }elseif($_check_data->status === '0'){
                    wilayah_administrasi::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Wilayah Administrasi', 'Update Status Wilayah Administrasi', 'Update status Wilayah Administrasi menjadi suspend untuk '.$_check_data->nama, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Wilayah Administrasi berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Wilayah Administrasi sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }

    public function getChild(Request $request)
    {
        $_result = wilayah_administrasi::getChild($request->ref, $request->type);
        return response()->json($_result);
    }
}
