<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\frontend_menu;
use App\Models\master_data_detail;
use App\Models\halaman_website;
use App\Models\User;
use App\Helpers\logActivities;
use App\Helpers\general;
use App\Traits\apiResponser;
use Validator;
use Redirect;

class WebsiteMenuController extends Controller
{

    use ApiResponser;

    protected $namaMenu = 'Website Menu';

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
            $_where = 'status <> "2" And refid = 0';
            if(isset($request->q)){
                $_where.=' And description Like "%'.$request->q.'%"';
            }
            $_referensi = master_data_detail::where('status', '0')
                -> where('refid', 2)
                -> withTrashed(false)
                -> orderBy('sequence')
                -> get();
            $_data = frontend_menu::getMenu(0);
            $_result = view('home')
                -> with('pages', 'backend.website menu.index')
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
            $_parent = frontend_menu::where('status', '<>', '2')
                -> withTrashed(false)
                -> get();
            $_halaman = halaman_website::where('status', '0')
                -> with('layout')
                -> withTrashed(false)
                -> get();
            $_result = view('backend.website menu.create')
                -> with('title', $this->namaMenu)
                -> with('parent', $_parent)
                -> with('halaman', $_halaman)
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
                    'refid'         => 'required|numeric',
                    'sequence'      => 'required|numeric',
                    'icon'          => 'nullable|regex:/^[a-zA-Z0-9\_]+$/',
                    'target_url'    => 'required|regex:/^[a-zA-Z0-9\-\/\#]+$/',
                    'target_slug'   => 'nullable|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'caption'       => 'required|regex:/^[a-zA-Z0-9\s\,]+$/',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Nilai :attribute yang anda masukkan salah!',
                ]
            );
            if ($validator->fails()){
                $_parent = frontend_menu::where('status', '<>', '2')
                    -> withTrashed(false)
                    -> get();
                $_halaman = halaman_website::where('status', '0')
                    -> with('layout')
                    -> withTrashed(false)
                    -> get();
                $_result = view('backend.website menu.create')
                    -> withErrors($validator)
                    -> with('parent', $_parent)
                    -> with('halaman', $_halaman)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('website-menu.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Tambah '.$this->namaMenu)
                    -> with('modal', 'create');
            }
            frontend_menu::create([
                'refid'         => $request->refid,
                'menu_type'     => 5,
                'sequence'      => $request->sequence,
                'icon'          => $request->icon,
                'caption'       => $request->caption,
                'target_url'    => $request->target_url,
                'target_slug'   => $request->target_slug,
                'created_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Website Menu', 'Tambah Website Menu', $request->caption, '0');
            return Redirect::to(route('website-menu.index'))
                -> with('message', 'Website Menu berhasil ditambah');
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
            $_parent = frontend_menu::where('status', '<>', '2')
                -> withTrashed(false)
                -> get();
            $_halaman = halaman_website::where('status', '0')
                -> with('layout')
                -> withTrashed(false)
                -> get();
            $_data = frontend_menu::find($id);
            $_result = view('backend.website menu.edit')
                -> with('title', 'Edit '.$this->namaMenu)
                -> with('data', $_data)
                -> with('parent', $_parent)
                -> with('halaman', $_halaman)
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
        if(User::canCreate($this->namaMenu)){
            $validator = Validator::make($request->all(),
                [
                    'refid'         => 'required|numeric',
                    'sequence'      => 'required|numeric',
                    'icon'          => 'nullable|regex:/^[a-zA-Z0-9\_]+$/',
                    'target_url'    => 'required|regex:/^[a-zA-Z0-9\-\/\#]+$/',
                    'target_slug'   => 'nullable|regex:/^[a-zA-Z0-9\-\/]+$/',
                    'caption'       => 'required|regex:/^[a-zA-Z0-9\s\,]+$/',
                ],
                [
                    'required' => ':attribute tidak boleh kosong!',
                    'regex' => 'Nilai :attribute yang anda masukkan mengandung karakter yang dilarang!',
                    'numeric' => 'Nilai :attribute yang anda masukkan salah!',
                ]
            );
            if ($validator->fails()){
                $_parent = frontend_menu::where('status', '<>', '2')
                    -> withTrashed(false)
                    -> get();
                $_halaman = halaman_website::where('status', '0')
                    -> with('layout')
                    -> withTrashed(false)
                    -> get();
                $_data = frontend_menu::find($id);
                $_result = view('backend.website menu.edit')
                    -> withErrors($validator)
                    -> with('data', $_data)
                    -> with('parent', $_parent)
                    -> with('halaman', $_halaman)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return Redirect::to(route('website-menu.index'))
                    -> withErrors($validator)
                    -> withInput()
                    -> with('content', $_result)
                    -> with('title', 'Edit '.$this->namaMenu)
                    -> with('modal', 'edit');
            }
            frontend_menu::where('id', $id)
                -> update([
                    'refid'         => $request->refid,
                    'sequence'      => $request->sequence,
                    'icon'          => $request->icon,
                    'caption'       => $request->caption,
                    'target_url'    => $request->target_url,
                    'target_slug'   => $request->target_slug,
                    'updated_by'    => \Auth::user()->id,
            ]);
            logActivities::addToLog('Website Menu', 'Update Website Menu', $request->caption, '0');
            return Redirect::to(route('website-menu.index'))
                -> with('message', 'Website Menu berhasil diupdate');
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
            $_check = frontend_menu::find($id);
            if($_check){
                $_data = frontend_menu::where('id', $id)
                    -> delete();
                logActivities::addToLog('Website Menu', 'Delete Website Menu', 'delete Website Menu untuk '.$_check->caption, '0');
                return Redirect::to(url()->previous())
                    -> with('message', 'Website Menu berhasil dihapus');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Website Menu tidak ditemukan');
            }
        }else{
            return view('error.403');
        }
    }

    public function status($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = frontend_menu::find($id);
            if($_check_data){
                if($_check_data->status === '3' || $_check_data->status === '1'){
                    frontend_menu::where('id', $id)
                        -> update([
                            'status'        => '0',
                            'updated_by'    => \Auth::user()->id,
                    ]);
                    logActivities::addToLog('Website Menu', 'Update Status Website Menu', 'Update status Website Menu menjadi active untuk '.$_check_data->caption, '0');
                }elseif($_check_data->status === '0'){
                    frontend_menu::where('id', $id)
                        -> update([
                            'status'        => '1',
                            'updated_by'    => \Auth::user()->id,
                    ]);
                    logActivities::addToLog('Website Menu', 'Update Status Website Menu', 'Update status Website Menu menjadi suspend untuk '.$_check_data->caption, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status Website Menu berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Website Menu tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }

    public function publish($id)
    {
        if(User::canSuspend($this->namaMenu)){
            $_check_data = frontend_menu::find($id);
            if($_check_data){
                if($_check_data->published_by === 0){
                    frontend_menu::where('id', $id)
                        -> update([
                            'published_by'  => \Auth::user()->id,
                            'published_at'  => now(),
                    ]);
                    logActivities::addToLog('Website Menu', 'Publikasi Website Menu', 'Publikasi Website Menu untuk '.$_check_data->title, '0');
                }else{
                    frontend_menu::where('id', $id)
                        -> update([
                            'published_by'  => 0,
                            'published_at'  => null,
                    ]);
                    logActivities::addToLog('Website Menu', 'Publikasi Website Menu', 'Stop Publikasi Website Menu untuk '.$_check_data->description, '0');
                }
                return Redirect::to(url()->previous())
                    -> with('message', 'Status publihasi Website Menu berhasil diupdate');
            }else{
                return Redirect::to(url()->previous())
                    -> with('error', 'Proses gagal! Website Menu tidak ditemukan');                
            }
        }else{
            return view('error.403');
        }
    }
}
