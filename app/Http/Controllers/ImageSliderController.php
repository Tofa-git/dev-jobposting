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
        //
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
