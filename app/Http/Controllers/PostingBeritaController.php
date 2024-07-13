<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posting_berita;
use App\Models\master_data_detail;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class PostingBeritaController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Posting Berita';

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
                    'jenis'     => 'nullable|numeric',
                    'kategori'  => 'nullable|numeric'
                ],
                [
                    'total.numeric' => 'Jumlah baris harus bertipe numeric!',
                    'total.gt' => 'Jumlah baris harus lebih besar dari 0!',
                    'q.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!',
                    'jenis.numeric' => 'Jenis berita yang anda pilih salah!',
                    'kategori.numeric' => 'Kategori berita yang anda pilih salah!'
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
            if(isset($request->jenis) && (int)@$request->jenis > 0){
                $_where.=' And id_jenis='.@$request->jenis;
            }
            if(isset($request->kategori) && (int)@$request->kategori > 0){
                $_where.=' And id_kategori='.@$request->kategori;
            }
            $_kategori_berita = master_data_detail::where('status', '0')
                -> where('refid', 15)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_jenis_berita = master_data_detail::where('status', '0')
                -> where('refid', 16)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_data = posting_berita::select('id', 'id_jenis', 'id_kategori', 'title', 'slug', 'foto_utama',  'published_by', 'published_at', 'status', 'created_by', 'created_at')
                -> with('postUser')
                -> with('jenisBerita')
                -> with('kategoriBerita')
                -> whereRaw($_where)
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.posting berita.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('jenis_berita', $_jenis_berita)
                -> with('kategori_berita', $_kategori_berita)
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
            $_kategori_berita = master_data_detail::where('status', '0')
                -> where('refid', 15)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_jenis_berita = master_data_detail::where('status', '0')
                -> where('refid', 16)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_result = view('home')
                -> with('pages', 'backend.posting berita.create')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('jenis_berita', $_jenis_berita)
                -> with('kategori_berita', $_kategori_berita)
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
                    'jenis'             => 'required|numeric|gt:0',
                    'kategori'          => 'required|numeric|gt:0',
                    'url_slug'          => 'required|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'foto_utama'        => 'nullable|mimes:bmp,jpeg,jpg,png|max:2048',
                    'keterangan_foto'   => 'nullable|max:128|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                    'judul'             => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'meta_title'        => 'nullable|max:100|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                    'meta_description'  => 'nullable|max:150|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Layout yang anda pilih salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'foto_utama.max' => 'File yang anda upload tidak boleh lebih dari 2MB!',
                    'keterangan_foto.max' => 'Maksimal keterangan foto adalah 255 karakter!',
                    'meta_title.max' => 'Maksimal meta title adalah 100 karakter!',
                    'meta_description.max' => 'Maksimal meta description adalah 150 karakter!',
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            $_file_name = [];
            if($request->hasFile('foto_utama')){
                $file           = $request->file('foto_utama');
                $_file_name     = general::storeFile($file, 'pictures', 'Foto utama halaman '.$request->judul, \Auth::user()->id);
                if($_file_name){
                    $_file_name = json_decode($_file_name);
                }
            }
            posting_berita::create([
                'id_jenis'          => $request->jenis,
                'id_kategori'       => $request->kategori,
                'title'             => $request->judul,
                'slug'              => $request->url_slug,
                'foto_utama'        => @$_file_name->name,
                'keterangan_foto'   => $request->keterangan_foto,
                'content'           => $request->bodyEditor,
                'meta_title'        => $request->meta_title,
                'meta_description'  => $request->meta_description,
                'created_by'        => \Auth::user()->id,
            ]);
            logActivities::addToLog('Posting Berita', 'Tambah Posting Berita', $request->judul, '0');
            return Redirect::to(route('posting-berita.index'))
                -> with('message', 'Berita berhasil ditambah');
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
            $_kategori_berita = master_data_detail::where('status', '0')
                -> where('refid', 15)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_jenis_berita = master_data_detail::where('status', '0')
                -> where('refid', 16)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_data = posting_berita::find($id);
            $_result = view('home')
                -> with('pages', 'backend.posting berita.edit')
                -> with('title', 'Edit '.$this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('jenis_berita', $_jenis_berita)
                -> with('kategori_berita', $_kategori_berita)
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
    public function update(Request $request, string $id)
    {
        if(User::canUpdate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'jenis'             => 'required|numeric|gt:0',
                    'kategori'          => 'required|numeric|gt:0',
                    'url_slug'          => 'required|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'foto_utama'        => 'nullable|mimes:bmp,jpeg,jpg,png|max:2048',
                    'keterangan_foto'   => 'nullable|max:128|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                    'judul'             => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'meta_title'        => 'nullable|max:100|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                    'meta_description'  => 'nullable|max:150|regex:/^[a-zA-Z0-9\s\-\,\.\(\)]+$/',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Layout yang anda pilih salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'foto_utama.max' => 'File yang anda upload tidak boleh lebih dari 2MB!',
                    'keterangan_foto.max' => 'Maksimal keterangan foto adalah 255 karakter!',
                    'meta_title.max' => 'Maksimal meta title adalah 100 karakter!',
                    'meta_description.max' => 'Maksimal meta description adalah 150 karakter!',
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            $_file_name = [];
            if($request->hasFile('foto_utama')){
                $file           = $request->file('foto_utama');
                $_file_name     = general::storeFile($file, 'pictures', 'Foto utama halaman '.$request->judul, \Auth::user()->id);
                if($_file_name){
                    $_file_name = json_decode($_file_name);
                    posting_berita::where('id', $id)
                        -> update([
                            'foto_utama' => $_file_name->name,
                            'updated_by' => \Auth::user()->id,
                    ]);
                }
            }
            posting_berita::where('id', $id)
                -> update([
                    'id_jenis'          => $request->jenis,
                    'id_kategori'       => $request->kategori,
                    'title'             => $request->judul,
                    'slug'              => $request->url_slug,
                    'keterangan_foto'   => $request->keterangan_foto,
                    'content'           => $request->bodyEditor,
                    'meta_title'        => $request->meta_title,
                    'meta_description'  => $request->meta_description,
                    'updated_by'        => \Auth::user()->id,
            ]);
            logActivities::addToLog('Posting Berita', 'Update Posting Berita', $request->judul, '0');
            return Redirect::to(route('posting-berita.index'))
                -> with('message', 'Berita berhasil diupdate');
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
            $_check_data = posting_berita::find($id);
            if($_check_data){
                $_data = posting_berita::where('id', $id)
                    -> delete();
                logActivities::addToLog('Posting Berita', 'Delete Posting Berita', 'delete Posting Berita untuk '.$_check_data->title, '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Posting Berita berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Posting Berita tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = posting_berita::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    posting_berita::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Posting Berita', 'Update Status Posting Berita', 'Update status Posting Berita menjadi active untuk '.$_check_data->title, '0');
                }elseif($_check_data->status === '0'){
                    posting_berita::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Posting Berita', 'Update Status Posting Berita', 'Update status Posting Berita menjadi suspend untuk '.$_check_data->title, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Posting Berita berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Posting Berita sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }

    public function publish($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = posting_berita::find($id);
            if($_check_data){
                if($_check_data->published_by === 0){
                    posting_berita::where('id', $id)
                        -> update([
                            'published_by'  => \Auth::user()->id,
                            'published_at'  => now(),
                    ]);
                    logActivities::addToLog('Posting Berita', 'Publikasi Posting Berita', 'Publikasi Posting Berita untuk '.$_check_data->title, '0');
                }else{
                    posting_berita::where('id', $id)
                        -> update([
                            'published_by'  => 0,
                            'published_at'  => null,
                    ]);
                    logActivities::addToLog('Posting Berita', 'Publikasi Posting Berita', 'Stop Publikasi Posting Berita untuk '.$_check_data->title, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status publihasi Posting Berita berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Posting Berita tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

}
