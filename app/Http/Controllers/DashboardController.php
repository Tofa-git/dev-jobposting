<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{

    protected $namaMenu = 'Dashboard';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	if(User::haveIndex($this->namaMenu)){
            $_data_statistik = '';
            $_data_statistik_pinjaman = '';
            $_result = view('home')
                -> with('pages', 'backend.dashboard.index')
                -> with('title', 'Dashboard')
                -> with('activeMenu', $this->namaMenu)
                -> with('data_statistik', $_data_statistik)
                -> with('data_statistik_pinjaman', $_data_statistik_pinjaman)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return view('error.403');
        }
    }
    
}
