<?php

namespace App\Http\Controllers;

use App\Models\data_file;
use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use Validator;
use Redirect;
use App\Traits\apiResponser;

class DataFileController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'File Management';

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
            $_data = data_file::whereRaw($_where)
                -> orderBy('deleted_at')
                -> orderBy('created_at')
                -> withTrashed(false)
                -> paginate($_total)
                -> appends(request()->query());
            $_extension = data_file::select('extension')
                -> groupBy('extension')
                -> get();
            $_result = view('home')
                -> with('pages', 'backend.file management.index')
                -> with('title', 'File Management')
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('extension', $_extension)
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
            $_result = view('backend.file management.create')
                -> with('title', $this->namaMenu)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Upload File';
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
                    'file_name'     => 'required|mimes:bmp,jpeg,jpg,png,pdf,docx,xlsx,pptx|max:2048',
                    'description'   => 'required|regex:/^[a-zA-Z0-9\s\-\,\(\)]+$/',
                ],
                [
                    'mimes' => 'Type file yang anda upload tidak diizinkan!',
                    'max' => 'Maksimal ukuran file yang izinkan 2MB!',
                    'required' => ':attribute tidak boleh kosong!',
                    'description.regex' => 'Deskripsi yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_result = view('backend.file management.create')
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('file-management.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Upload File')
                    -> with('modal', 'create');
            }
            $_upload_file = general::storeFile($request->file_name, null, $request->description, \Auth::user()->id);
            logActivities::addToLog('Upload File', 'Upload File ', $request->description, '0');
            return Redirect::to(route('file-management.index'))
                -> with('message', 'Data File berhasil diupload');
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
            $_data = data_file::where('id', $id)
                -> with('user')
                -> first();
            $_result = view('backend.file management.edit')
                -> with('title', 'File Properties')
                -> with('data', $_data)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Update File Information';
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
                $_data = data_file::where('id', $id)
                    -> first();
                $_result = view('backend.file management.edit')
                    -> with('title', $this->namaMenu)
                    -> with('data', $_data)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('file-management.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Update File Information')
                    -> with('modal', 'edit');
            }
            data_file::where('id', $id)
                -> update([
                'description'   => $request->description,
            ]);
            logActivities::addToLog('File Information', 'Update file information', $request->description, '0');
            return Redirect::to(route('file-management.index'))
                -> with('message', 'File description berhasil diupdate');
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
            $_check_data = data_file::find($id);
            if($_check_data){
                $_data = data_file::where('id', $id)
                    -> delete();
                logActivities::addToLog('File Management', 'Delete File', 'Delete File untuk '.$_check_data->description, '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'File berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'File tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = data_file::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    data_file::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('File Management', 'Update Status File', 'Update status File menjadi active untuk '.$_check_data->description, '0');
                }elseif($_check_data->status === '0'){
                    data_file::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('File Management', 'Update Status File', 'Update status File menjadi suspend untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status File berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! File sudah dihapus');                
            }
        }else{
            return view('error.403');
        }
    }

}
