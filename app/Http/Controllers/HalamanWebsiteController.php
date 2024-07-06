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
                -> orderBy('sequence')
                -> withTrashed(false)
                -> get();
            $_data = halaman_website::whereRaw($_where)
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
                -> where('refid', 3)
                -> orderBy('sequence')
                -> withTrashed(false)
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
                    'layout'        => 'required|numeric|gt:0',
                    'judul'         => 'required|regex:/^[a-zA-Z0-9\s\-\,]+$/',
                    'url_halaman'   => 'required|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'gambar_utama'  => 'required|mimes:bmp,jpeg,jpg,png|max:2048',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Layout yang anda pilih salah!',
                    'mimes' => 'Type file yang anda upload salah!',
                    'max' => 'File yang anda upload tidak boleh lebih dari 2MB!'
                ]
            );
            if ($validator->fails()){
                return Redirect::to(url()->previous())
                    -> withErrors($validator)
                    -> withInput();
            }
            halaman_website::create([
                'id_layout'     => $request->layout,
                'title'         => $request->judul,
                'url'           => $request->url_halaman,
                'gambar_utama'  => '',
                'content'       => $request->bodyEditor,
                'created_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Halaman Website', 'Tambah Halaman Website', $request->description, '0');
            return Redirect::to(route('halaman-website.index'))
                -> with('message', 'Halaman Website berhasil ditambah');
        }else{
            return view('error.403');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
