<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\image_slider;
use App\Models\master_data_detail;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class ImageSliderController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Image Slider';

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
                $_where.=' And title Like "%'.$request->q.'%"';
            }
            $_data = image_slider::whereRaw($_where)
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.image slider.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
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
            $_result = view('home')
                -> with('pages', 'backend.image slider.create')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
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
                    'no_urut'       => 'required|numeric|gt:0',
                    'judul'         => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'file_gambar'   => 'required|mimes:bmp,jpeg,jpg,png|max:2048',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Nomor urut yang anda isi salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'file_gambar.max' => 'File yang anda upload tidak boleh lebih dari 2MB!',
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            $_file_name = [];
            if($request->hasFile('file_gambar')){
                $file           = $request->file('file_gambar');
                $_file_name     = general::storeFile($file, 'pictures', 'Gambar slider '.$request->judul, \Auth::user()->id);
                if($_file_name){
                    $_file_name = json_decode($_file_name);
                }
            }
            image_slider::create([
                'sequence'          => $request->no_urut,
                'title'             => $request->judul,
                'file_background'   => @$_file_name->name,
                'content'           => $request->bodyEditor,
                'created_by'        => \Auth::user()->id,
            ]);
            logActivities::addToLog('Image Slider', 'Tambah Image Slider', $request->judul, '0');
            return Redirect::to(route('image-slider.index'))
                -> with('message', 'Image Slider berhasil ditambah');
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
            $_data = image_slider::find($id);
            $_result = view('home')
                -> with('pages', 'backend.image slider.edit')
                -> with('title', 'Edit '.$this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
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
                    'no_urut'       => 'required|numeric|gt:0',
                    'judul'         => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'file_gambar'   => 'nullable|mimes:bmp,jpeg,jpg,png|max:2048',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Nomor urut yang anda isi salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'file_gambar.max' => 'File yang anda upload tidak boleh lebih dari 2MB!',
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            if($request->hasFile('file_gambar')){
                $file           = $request->file('file_gambar');
                $_file_name     = general::storeFile($file, 'pictures', 'Gambar Slider '.$request->judul, \Auth::user()->id);
                if($_file_name){
                    $_file_name = json_decode($_file_name);
                    image_slider::where('id', $id)
                        -> update([
                            'file_background'  => $_file_name->name,
                            'updated_by'        => \Auth::user()->id,
                    ]);
                }
            }
            image_slider::where('id', $id)
                -> update([
                    'sequence'          => $request->no_urut,
                    'title'             => $request->judul,
                    'content'           => $request->bodyEditor,
                    'updated_by'        => \Auth::user()->id,
            ]);
            logActivities::addToLog('Image Slider', 'Update Image Slider', $request->judul, '0');
            return Redirect::to(route('image-slider.index'))
                -> with('message', 'Image Slider berhasil diupdate');
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
            $_check_data = image_slider::find($id);
            if($_check_data){
                $_data = image_slider::where('id', $id)
                    -> delete();
                logActivities::addToLog('Image Slider', 'Delete Image Slider', 'delete Image Slider untuk '.$_check_data->title, '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Image Slider berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Image Slider tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = image_slider::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    image_slider::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Image Slider', 'Update Status Image Slider', 'Update status Image Slider menjadi active untuk '.$_check_data->title, '0');
                }elseif($_check_data->status === '0'){
                    image_slider::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Image Slider', 'Update Status Image Slider', 'Update status Image Slider menjadi suspend untuk '.$_check_data->title, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Image Slider berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Image Slider sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }

    public function publish($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = image_slider::find($id);
            if($_check_data){
                if($_check_data->published_by === 0){
                    image_slider::where('id', $id)
                        -> update([
                            'published_by'  => \Auth::user()->id,
                            'published_at'  => now(),
                    ]);
                    logActivities::addToLog('Image Slider', 'Publikasi Image Slider', 'Publikasi Image Slider untuk '.$_check_data->title, '0');
                }else{
                    image_slider::where('id', $id)
                        -> update([
                            'published_by'  => 0,
                            'published_at'  => null,
                    ]);
                    logActivities::addToLog('Image Slider', 'Publikasi Image Slider', 'Stop Publikasi Image Slider untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status publihasi Image Slider berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Image Slider tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

}
