<?php

namespace App\Http\Controllers;

use App\Models\master_data_detail;
use Illuminate\Http\Request;
use App\Models\master_data;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class MasterDataDetailController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Master Data Detail';

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
                    'total'     => 'nullable|numeric',
                    'q'         => 'nullable|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                    'refid'     => 'nullable|numeric',
                ],
                [
                    'total.numeric' => 'Jumlah baris harus bertipe numeric!',
                    'total.gt' => 'Jumlah baris harus lebih besar dari 0!',
                    'q.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!',
                    'refid.numeric' => 'Referensi yang anda masukkan salah!'
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
            $_refid = 0;
            if(isset($request->refid)){
                $_refid = (int)$request->refid;
            }
            if($_refid > 0){
                $_where.=' And refid='.$_refid;
            }
            $_referensi = master_data::withTrashed(false)
                -> get();
            $_data = master_data_detail::whereRaw($_where)
                -> with('masterData')
                -> withTrashed(false)
                -> orderByRaw('refid, sequence')
                -> paginate($_total)
                -> appends(request()->query());
            $_result = view('home')
                -> with('pages', 'backend.master data detail.index')
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
    public function create(Request $request)
    {
        if(User::canCreate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'refid'   => 'nullable|numeric',
                ],
                [
                    'type.numeric' => 'Referensi yang anda masukkan salah!'
                ]
            );
            $_refid = 0;
            if(isset($request->refid)){
                $_refid = (int)$request->refid;
            }
            $_referensi = master_data::where('status', '0')
                -> get();
            $_result = view('backend.master data detail.create')
                -> with('title', $this->namaMenu)
                -> with('referensi', $_referensi)
                -> with('refid', $_refid)
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
                    'refid'         => 'required|numeric|gt:0',
                    'shortname'     => 'nullable|max:32|regex:/^[a-zA-Z0-9\s\-\,\(\)\/]+$/',
                    'description'   => 'required|max:255|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'refid.required' => 'Referensi belum dipilih!',
                    'refid.numeric' => 'Referensi yang anda pilih salah!',
                    'refid.gt' => 'Referensi yang anda pilih salah!',
                    'shortname.regex' => 'Shortname yang anda masukkan mengandung karakter yang dilarang!',
                    'description.required' => 'Deskripsi master data detail tidak boleh kosong!',
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!',
                ]
            );
            if ($validator->fails()){
                $_referensi = master_data::where('status', '0')
                    -> get();
                $_refid = 0;
                if(isset($request->refid)){
                    $_refid = (int)$request->refid;
                }
                $_result = view('backend.master data detail.create')
                    -> withErrors($validator)
                    -> with('referensi', $_referensi)
                    -> with('refid', $_refid)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('master-data-detail.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah '.$this->namaMenu)
                    -> with('modal', 'create');
            }
            $_sequence = master_data_detail::where('refid', $request->refid)
                -> where('status', '<>', '2')
                -> count();
            master_data_detail::create([
                'refid'         => $request->refid,
                'sequence'      => $_sequence + 1,
                'shortname'     => $request->shortname,
                'description'   => $request->description,
                'created_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Master Data Detail', 'Tambah Master Data Detail', $request->description, '0');
            return Redirect::to(route('master-data-detail.index', ['refid'=>$request->refid]))
                -> with('message', 'Master Data Detail berhasil ditambah');
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
            $_data = master_data_detail::where('id', $id)
                -> first();
            $_referensi = master_data::withTrashed(false)
                -> get();
            $_result = view('backend.master data detail.edit')
                -> with('title', $this->namaMenu)
                -> with('referensi', $_referensi)
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
                    'refid'         => 'required|numeric|gt:0',
                    'sequence'      => 'required|numeric|gt:0',
                    'shortname'     => 'nullable|max:32|regex:/^[a-zA-Z0-9\s\-\,\(\)\/]+$/',
                    'description'   => 'required|max:255|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'refid.required' => 'Referensi belum dipilih!',
                    'refid.numeric' => 'Referensi yang anda pilih salah!',
                    'refid.gt' => 'Referensi yang anda pilih salah!',
                    'sequence.required' => 'Nomor Urut tidak boleh kosong!',
                    'sequence.numeric' => 'Tipe data salah! Hanya angka yang diperbolehkan',
                    'sequence.gt' => 'Nomor urut harus lebih besar dari 0!',
                    'shortname.regex' => 'Shortname yang anda masukkan mengandung karakter yang dilarang!',
                    'description.required' => 'Deskripsi master data detail tidak boleh kosong!',
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!',
                ]
            );
            if ($validator->fails()){
                $_referensi = master_data::withTrashed(false)
                    -> get();
                $_refid = 0;
                if(isset($request->refid)){
                    $_refid = (int)$request->refid;
                }
                $_data = master_data_detail::where('id', $id)
                    -> first();
                $_result = view('backend.master data detail.edit')
                    -> withErrors($validator)
                    -> with('data', $_data)
                    -> with('referensi', $_referensi)
                    -> with('refid', $_refid)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('master-data-detail.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Edit '.$this->namaMenu)
                    -> with('modal', 'create');
            }
            master_data_detail::where('id', $id)
                -> update([
                    'refid'         => $request->refid,
                    'sequence'      => $request->sequence,
                    'shortname'     => $request->shortname,
                    'description'   => $request->description,
            ]);
            logActivities::addToLog('Master Data Detail', 'Update Master Data Detail', $request->description, '0');
            return Redirect::to(route('master-data-detail.index', ['refid'=>$request->refid]))
                -> with('message', 'Master Data Detail berhasil diupdate');
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
            $_data = master_data_detail::where('id', $id)
                -> delete();
            if($_data){
                logActivities::addToLog('Master Data Detail', 'Delete Master Data Detail', 'delete Master Data Detail untuk '.master_data_detail::getFieldValue($id, 'description'), '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Master Data Detail berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Master Data Detail tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = master_data_detail::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    master_data_detail::whereRaw('id='.$id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Master Data Detail', 'Update Status Master Data Detail', 'Update status Master Data Detail menjadi active untuk '.$_check_data->description, '0');
                }elseif($_check_data->status === '0'){
                    master_data_detail::whereRaw('id='.$id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Master Data Detail', 'Update Status Master Data Detail', 'Update status Master Data Detail menjadi suspend untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Master Data Detail berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Master Data Detail sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }
    
}
