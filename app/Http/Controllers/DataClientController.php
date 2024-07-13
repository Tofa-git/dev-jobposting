<?php

namespace App\Http\Controllers;

use App\Models\data_client;
use Illuminate\Http\Request;
use App\Models\master_data_detail;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class DataClientController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Mitra dan Klien';

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
            $_where = 'status <> "2"';
            if(isset($request->q)){
                $_where.=' And description Like "%'.$request->q.'%"';
            }
            $_jenis_client = master_data_detail::where('status', '0')
                -> where('refid', 18)
                -> withTrashed(false)
                -> get();
            $_jenis_kerjasama = master_data_detail::where('status', '0')
                -> where('refid', 19)
                -> withTrashed(false)
                -> get();
            $_type_bisnis = master_data_detail::where('status', '0')
                -> where('refid', 10)
                -> withTrashed(false)
                -> get();
            $_data = data_client::whereRaw($_where)
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.mitra dan klien.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('jenis_client', $_jenis_client)
                -> with('jenis_kerjasama', $_jenis_kerjasama)
                -> with('type_bisnis', $_type_bisnis)
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(data_client $data_client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(data_client $data_client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, data_client $data_client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(data_client $data_client)
    {
        //
    }
}
