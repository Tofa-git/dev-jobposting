<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\app_properties;
use App\Models\master_data_detail;
use App\Models\image_slider;
use App\Models\posting_berita;
use App\Models\halaman_website;
use App\Models\informasi_penting;
use App\Models\data_file;
use Redirect;
use App\Traits\apiResponser;

class frontendController extends Controller
{

    use ApiResponser;

	public function index(Request $request)
	{
		if(app_properties::haveFrontend()){
            $_active = 'home';
            $_image_slider = image_slider::whereRaw('status="0" And published_by > 0')
                -> orderByRaw('sequence')
                -> get();
            $_berita = [];
            $_info = app_properties::first();
			$_result = view('welcome')
    	        -> with('pages', 'frontend.home')
                -> with('active', $_active)
                -> with('info', $_info)
                -> with('image_slider', $_image_slider)
                -> with('berita', $_berita)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
    	}else{
            return Redirect::to(route('dashboard.index'));
        }
	}

    public function maintenance()
    {
        return view('maintenance');
    }

    public function halaman(Request $request, $halaman)
    {
        if(app_properties::haveFrontend()){
            $_active = $halaman;
            $_key = ucwords(str_replace('-', ' ', $_active));
            $_data = halaman_website::with('layout')
                -> whereRaw('url="/'.$halaman.'" And published_by > 0')
                -> first();
            if($_data){
                $_layout = strtolower(@$_data->layout->description);
                $_info = app_properties::first();
                $_result = view('welcome')
                    -> with('pages', 'frontend.halaman')
                    -> with('title', $_data->title)
                    -> with('content', $_data)
                    -> with('active', $_active)
                    -> with('info', $_info)
                    -> render();
                $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
                return $_result;
            }else{
                abort('404');
            }
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function beritaDetail(Request $request, $berita)
    {
        if(app_properties::haveFrontend()){
            $_active = 'Berita dan Informasi';
            $_data = posting_berita::with('kategoriBerita')
                -> whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> first();
            posting_berita::whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> update([
                    'dibaca' => $_data->dibaca + 1
            ]);
            $_berita = posting_berita::with('kategoriBerita')
                -> whereRaw('status="0" And published_by > 0 And id_kategori=7')
                -> orderByRaw('published_at Desc')
                -> limit(4)
                -> get();
            $_info = app_properties::first();
            $_result = view('welcome')
                -> with('pages', 'frontend.berita detail')
                -> with('data', $_data)
                -> with('title', $_data->title)
                -> with('berita', $_berita)
                -> with('info', $_info)
                -> with('active', $_active)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function siaranPers(Request $request, $berita)
    {
        if(app_properties::haveFrontend()){
            $_active = 'Berita dan Informasi';
            $_data = posting_berita::with('kategoriBerita')
                -> whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> first();
            posting_berita::whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> update([
                    'dibaca' => $_data->dibaca + 1
            ]);
            $_berita = posting_berita::with('kategoriBerita')
                -> whereRaw('status="0" And published_by > 0 And id_kategori=13')
                -> orderByRaw('published_at Desc')
                -> limit(4)
                -> get();
            $_info = app_properties::first();
            $_result = view('welcome')
                -> with('pages', 'frontend.siaran pers')
                -> with('data', $_data)
                -> with('title', $_data->title)
                -> with('berita', $_berita)
                -> with('info', $_info)
                -> with('active', $_active)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function beritaPengumuman(Request $request, $berita)
    {
        if(app_properties::haveFrontend()){
            $_active = 'Berita dan Informasi';
            $_data = posting_berita::with('kategoriBerita')
                -> whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> first();
            posting_berita::whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> update([
                    'dibaca' => $_data->dibaca + 1
            ]);
            $_berita = posting_berita::with('kategoriBerita')
                -> whereRaw('status="0" And published_by > 0 And id_kategori=14')
                -> orderByRaw('published_at Desc')
                -> limit(4)
                -> get();
            $_kabar_perempuan = posting_berita::with('kategoriBerita')
                -> whereRaw('status="0" And published_by > 0 And id_kategori=7')
                -> orderByRaw('published_at Desc')
                -> limit(4)
                -> get();
            $_info = app_properties::first();
            $_result = view('welcome')
                -> with('pages', 'frontend.berita dan pengumuman')
                -> with('data', $_data)
                -> with('title', $_data->title)
                -> with('berita', $_berita)
                -> with('kabar_perempuan', $_kabar_perempuan)
                -> with('info', $_info)
                -> with('active', $_active)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function kampanyeTahunan(Request $request, $berita)
    {
        if(app_properties::haveFrontend()){
            $_active = 'Kampanye Tahunan';
            $_data = posting_berita::with('kategoriBerita')
                -> whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> first();
            posting_berita::whereRaw('status = "0" And published_by > 0 And slug="'.$berita.'"')
                -> update([
                    'dibaca' => $_data->dibaca + 1
            ]);
            $_berita = posting_berita::with('kategoriBerita')
                -> whereRaw('status="0" And published_by > 0 And id_kategori=15')
                -> orderByRaw('published_at Desc')
                -> limit(4)
                -> get();
            $_kabar_perempuan = posting_berita::with('kategoriBerita')
                -> whereRaw('status="0" And published_by > 0 And id_kategori=7')
                -> orderByRaw('published_at Desc')
                -> limit(4)
                -> get();
            $_info = app_properties::first();
            $_result = view('welcome')
                -> with('pages', 'frontend.kampanye tahunan')
                -> with('data', $_data)
                -> with('title', $_data->title)
                -> with('berita', $_berita)
                -> with('kabar_perempuan', $_kabar_perempuan)
                -> with('info', $_info)
                -> with('active', $_active)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function content(Request $request, $content)
    {
        if(app_properties::haveFrontend()){
            $_active = $content;
            $_info = app_properties::first();
            if(!is_null($content)){
                $_tema_pencapaian = master_data_detail::where('status', '0')
                    -> where('refid', 7)
                    -> get();
                $_kategori_pencapaian = master_data_detail::where('status', '0')
                    -> where('refid', 8)
                    -> get();
                $_data_capaian = capaian::where('status', '0')
                    -> where('published_by', '>', 0)
                    -> with('photoUtama')
                    -> get();
                $_result = view('capaian')
                    -> with('pages', 'frontend.'.$content)
                    -> with('title', env('APP_NAME'))
                    -> with('data_pencapaian', $_data_capaian)
                    -> with('tema_pencapaian', $_tema_pencapaian)
                    -> with('kategori_pencapaian', $_kategori_pencapaian)
                    -> with('info', $_info)
                    -> with('active', $_active)
                    -> render();
            }else{

            }
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function productDetail($content, $id)
    {
        if(app_properties::haveFrontend()){
            $_active = $content;
            $_info = app_properties::first();
            $_data = data_produk::whereRaw('id='.$id)
                -> first();
            $_result = view('welcome')
                -> with('pages', 'frontend.'.'product-detail')
                -> with('title', env('APP_NAME'))
                -> with('data', $_data)
                -> with('info', $_info)
                -> with('active', $_active)
                -> render();
            $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
            return $_result;
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function downloadProfile()
    {
        if(app_properties::haveFrontend()){
            return Response()->download(public_path('storage'.DIRECTORY_SEPARATOR.'download'.DIRECTORY_SEPARATOR.'Profile Salsa And Family.pdf'));
        }else{
            return Redirect::to(route('dashboard.index'));
        }
    }

    public function loadContent($id)
    {
        $_data = capaian::where('id', $id)
            -> with('photoUtama')
            -> first();
        $_result = view('frontend.database-capaian-detail')
            -> with('title', @$_data->title)
            -> with('data', $_data)
            -> render();
        $_result = str_replace('    ', '', preg_replace(array('/\r/', '/\n/', '/\t/'), '', $_result));
        $_hasil['content'] = $_result;
        $_hasil['title'] = @$_data->title;
        return $this->success($_hasil);
    }

    public function fileLinkUrl(Request $request)
    {
        return data_file::getPublicImage(@$request->ref);
    }
    
}