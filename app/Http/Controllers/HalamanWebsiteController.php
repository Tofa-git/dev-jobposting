<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\halaman_website;
use App\Models\master_data_detail;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class HalamanWebsiteController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Halaman Website';

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
            $_total = 15;
            if(isset($request->total)){
                $_total = $request->total;
            }
            $_where = 'status <> "2"';
            if(isset($request->q)){
                $_where.=' And description Like "%'.$request->q.'%"';
            }
            $_referensi = master_data_detail::where('status', '0')
                -> where('refid', 14)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_data = halaman_website::whereRaw($_where)
                -> with('layout')
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.halaman website.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('referensi', $_referensi)
                -> with('total', $_total)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(User::canCreate($this->namaMenu)){
            $_layout = master_data_detail::where('status', '0')
                -> withTrashed(false)
                -> where('refid', 3)
                -> orderBy('sequence')
                -> get();
            $_result = view('home')
                -> with('pages', 'backend.halaman website.create')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('layout', $_layout)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(User::canCreate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'layout'            => 'required|numeric|gt:0',
                    'judul'             => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'url_halaman'       => 'required|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'gambar_utama'      => 'nullable|mimes:bmp,jpeg,jpg,png|max:2048',
                    'meta_title'        => 'nullable|max:100|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                    'meta_description'  => 'nullable|max:150|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Layout yang anda pilih salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'gambar_utama.max' => 'File yang anda upload tidak boleh lebih dari 2MB!',
                    'meta_title.max' => 'Maksimal meta title adalah 100 karakter!',
                    'gambar_utama.max' => 'Maksimal meta description adalah 150 karakter!',
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            $_file_name = [];
            if($request->hasFile('gambar_utama')){
                $file           = $request->file('logo');
                $_file_name     = general::storeFile($file, 'pictures', 'Gambar utama halaman '.$request->judul, \Auth::user()->id);
                if($_file_name){
                    $_file_name = json_decode($_file_name);
                }
            }
            halaman_website::create([
                'id_layout'         => $request->layout,
                'title'             => $request->judul,
                'url'               => $request->url_halaman,
                'gambar_utama'      => @$_file_name->name,
                'content'           => $request->bodyEditor,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'created_by'        => \Auth::user()->id,
            ]);
            logActivities::addToLog('Halaman Website', 'Tambah Halaman Website', $request->judul, '0');
            return Redirect::to(route('halaman-website.index'))
                -> with('message', 'Halaman Website berhasil ditambah');
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
            $_layout = master_data_detail::where('status', '0')
                -> withTrashed(false)
                -> where('refid', 3)
                -> orderBy('sequence')
                -> get();
            $_data = halaman_website::find($id);
            $_result = view('home')
                -> with('pages', 'backend.halaman website.edit')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('layout', $_layout)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
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
                    'layout'            => 'required|numeric|gt:0',
                    'judul'             => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'url_halaman'       => 'required|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'gambar_utama'      => 'nullable|mimes:bmp,jpeg,jpg,png|max:2048',
                    'meta_title'        => 'nullable|max:100|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                    'meta_description'  => 'nullable|max:150|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Layout yang anda pilih salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'gambar_utama.max' => 'File yang anda upload tidak boleh lebih dari 2MB!',
                    'meta_title.max' => 'Maksimal meta title adalah 100 karakter!',
                    'gambar_utama.max' => 'Maksimal meta description adalah 150 karakter!',
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            if($request->hasFile('gambar_utama')){
                $file           = $request->file('logo');
                $_file_name     = general::storeFile($file, 'pictures', 'Gambar utama halaman '.$request->judul, \Auth::user()->id);
                if($_file_name){
                    $_file_name = json_decode($_file_name);
                    halaman_website::where('id', $id)
                        -> update([
                            'gambar_utama'  => $_file_name->name,
                    ]);
                }
            }
            halaman_website::where('id', $id)
                -> update([
                    'id_layout'         => $request->layout,
                    'title'             => $request->judul,
                    'url'               => $request->url_halaman,
                    'content'           => $request->bodyEditor,
                    'meta_title'        => $request->meta_title,
                    'meta_description'  => $request->meta_description,
            ]);
            logActivities::addToLog('Halaman Website', 'Update Halaman Website', $request->judul, '0');
            return Redirect::to(route('halaman-website.index'))
                -> with('message', 'Halaman Website berhasil diupdate');
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
            $_check_data = halaman_website::find($id);
            if($_check_data){
                $_data = halaman_website::where('id', $id)
                    -> delete();
                logActivities::addToLog('Halaman Website', 'Delete Halaman Website', 'delete Halaman Website untuk '.$_check_data->title, '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Halaman Website berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Halaman Website tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = halaman_website::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    halaman_website::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Halaman Website', 'Update Status Halaman Website', 'Update status Halaman Website menjadi active untuk '.$_check_data->title, '0');
                }elseif($_check_data->status === '0'){
                    halaman_website::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Halaman Website', 'Update Status Halaman Website', 'Update status Halaman Website menjadi suspend untuk '.$_check_data->title, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Halaman Website berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Halaman Website sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }

    public function publish($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = halaman_website::find($id);
            if($_check_data){
                if($_check_data->published_by === 0){
                    halaman_website::where('id', $id)
                        -> update([
                            'published_by'  => \Auth::user()->id,
                            'published_at'  => now(),
                    ]);
                    logActivities::addToLog('Halaman Website', 'Publikasi Halaman Website', 'Publikasi Halaman Website untuk '.$_check_data->title, '0');
                }else{
                    halaman_website::where('id', $id)
                        -> update([
                            'published_by'  => 0,
                            'published_at'  => null,
                    ]);
                    logActivities::addToLog('Halaman Website', 'Publikasi Halaman Website', 'Stop Publikasi Halaman Website untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status publihasi halaman website berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Halaman Website tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

}
