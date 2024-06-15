<?php

namespace App\Http\Controllers;

use App\Models\master_data;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class MasterDataController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Master Data';

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
            $_data = master_data::whereRaw($_where)
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.master data.index')
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
            $_result = view('backend.master data.create')
                -> with('title', $this->namaMenu)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Tambah '.$this->namaMenu;
            return $this->success($_hasil);
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
                    'description'   => 'required|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'description.required' => 'Deskripsi tidak boleh kosong!',
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_result = view('backend.master data.create')
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('master-data.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah '.$this->namaMenu)
                    -> with('modal', 'create');
            }
            master_data::create([
                'description'   => $request->description,
                'created_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Master Data', 'Tambah Master Data', $request->description, '0');
            return Redirect::to(route('master-data.index'))
                -> with('message', 'Master Data berhasil ditambah');
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
            $_data = master_data::where('id', $id)
                -> first();
            $_result = view('backend.master data.edit')
                -> with('title', 'Edit '.$this->namaMenu)
                -> with('data', $_data)
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
                    'description'   => 'nullable|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_data = master_data::where('id', $id)
                    -> first();
                $_result = view('backend.master data.edit')
                    -> with('title', $this->namaMenu)
                    -> with('data', $_data)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('master-data.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Edit '.$this->namaMenu)
                    -> with('modal', 'edit');
            }
            master_data::where('id', $id)
                -> update([
                'description'   => $request->description,
            ]);
            logActivities::addToLog('Master Data', 'Update Master Data', $request->description, '0');
            return Redirect::to(route('master-data.index'))
                -> with('message', 'Master Data berhasil diupdate');
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
            $_data = master_data::where('id', $id)
                -> delete();
            if($_data){
                logActivities::addToLog('Master Data', 'Delete Master Data', 'delete Master Data untuk '.master_data::getFieldValue($id, 'description'), '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Master Data berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Master Data tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = master_data::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    master_data::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Master Data', 'Update Status Master Data', 'Update status Master Data menjadi active untuk '.$_check_data->description, '0');
                }elseif($_check_data->status === '0'){
                    master_data::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Master Data', 'Update Status Master Data', 'Update status Master Data menjadi suspend untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Master Data berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Master Data sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }

}
