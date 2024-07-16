<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\widget;
use App\Models\landing_page;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class LandingPageController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Landing Page';

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
            $_data = widget::where('status', '<>', '2')
                -> orderBy('sequence')
                -> get();
            $_tampilan = landing_page::where('status', '<>', '2')
                -> with('widget')
                -> orderBy('sequence')
                -> get();
            $_result = view('home')
                -> with('pages', 'backend.landing page.index')
                -> with('title', $this->namaMenu)
                -> with('activeMenu', $this->namaMenu)
                -> with('data', $_data)
                -> with('tampilan', $_tampilan)
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
            $_seq = widget::where('status', '<>', '2')->count() + 1;
            $_result = view('backend.landing page.create')
                -> with('title', $this->namaMenu)
                -> with('seq', $_seq)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            $_hasil['content'] = $_result;
            $_hasil['title'] = 'Tambah Widget';
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
                    'sequence'  => 'required|numeric',
                    'nama'      => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                    'target'    => 'required|regex:/^[a-zA-Z0-9\s\.]+$/',
                ],
                [
                    'numeric' => 'Nilai sequence yang anda masukkan salah!',
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_result = view('backend.landing page.create')
                    -> withErrors($validator)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('landing-page.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah Widget')
                    -> with('modal', 'create');
            }
            widget::create([
                'sequence'      => $request->sequence,
                'description'   => $request->nama,
                'target'        => $request->target,
                'created_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Landing Page', 'Tambah Landing Page', $request->nama, '0');
            return Redirect::to(route('landing-page.index'))
                -> with('message', 'Widget berhasil ditambah');
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
            $_data = widget::where('id', $id)
                -> first();
            $_result = view('backend.landing page.edit')
                -> with('title', 'Edit Widget')
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
     * Store a newly created resource in storage.
     */
    public function update(Request $request, $id)
    {
        if(User::canUpdate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'sequence'  => 'required|numeric',
                    'nama'      => 'required|regex:/^[a-zA-Z0-9\s]+$/',
                    'target'    => 'required|regex:/^[a-zA-Z0-9\s\.]+$/',
                ],
                [
                    'numeric' => 'Nilai sequence yang anda masukkan salah!',
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!'
                ]
            );
            if ($validator->fails()){
                $_data = widget::find($id);
                $_result = view('backend.landing page.edit')
                    -> withErrors($validator)
                    -> with('data', $_data)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('landing-page.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah Widget')
                    -> with('modal', 'create');
            }
            widget::where('id', $id)
                -> update([
                    'sequence'      => $request->sequence,
                    'description'   => $request->nama,
                    'target'        => $request->target,
                    'updated_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Landing Page', 'Edit Landing Page', $request->nama, '0');
            return Redirect::to(route('landing-page.index'))
                -> with('message', 'Widget berhasil diupdate');
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = widget::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    widget::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    landing_page::create([
                        'sequence'      => $_check_data->sequence,
                        'judul'         => $_check_data->description,
                        'id_widget'     => $id,
                        'status'        => '3',
                        'created_by'    => \Auth::user()->id
                    ]);
                    logActivities::addToLog('Widget', 'Update Status Widget', 'Update status Widget menjadi active untuk '.$_check_data->description, '0');
                }elseif($_check_data->status === '0'){
                    widget::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    landing_page::where('id', $id)->delete();
                    logActivities::addToLog('Widget', 'Update Status Widget', 'Update status Widget menjadi suspend untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Widget berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Widget tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

    public function statusWidget($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = landing_page::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    landing_page::where('id', $id)
                        -> update([
                            'status' => '0'
                    ]);
                    logActivities::addToLog('Widget', 'Update Status Widget', 'Update status Widget menjadi active untuk '.$_check_data->judul, '0');
                }elseif($_check_data->status === '0'){
                    landing_page::where('id', $id)
                        -> update([
                            'status' => '1'
                    ]);
                    logActivities::addToLog('Widget', 'Update Status Widget', 'Update status Widget menjadi suspend untuk '.$_check_data->judul, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Widget berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Widget tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

    public function publish($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = landing_page::find($id);
            if($_check_data){
                if($_check_data->published_by === 0){
                    landing_page::where('id', $id)
                        -> update([
                            'published_by'  => \Auth::user()->id,
                            'published_at'  => now(),
                    ]);
                    logActivities::addToLog('Landing Page', 'Publikasi Landing Page', 'Publikasi Landing Page untuk '.$_check_data->judul, '0');
                }else{
                    landing_page::where('id', $id)
                        -> update([
                            'published_by'  => 0,
                            'published_at'  => null,
                    ]);
                    logActivities::addToLog('Landing Page', 'Publikasi Landing Page', 'Stop Publikasi Landing Page untuk '.$_check_data->judul, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status publihasi Landing Page berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Landing Page tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

}
