<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Unit;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menu='home';
        $tahun=tahun();
        return view('home',compact('menu','tahun'));
    }
    public function tampil_dashboard(request $request)
    {
        $tahun=tahun();
        return view('dashboard',compact('tahun'));
    }
    public function tampil_grafik(request $request)
    {
        $tahun=tahun();
        return view('dashboardgrafik',compact('tahun'));
    }
    public function tampil_dashboard_sistem(request $request)
    {
        $tahun=tahun();
        return view('dashboardsistem',compact('tahun'));
    }
    public function cari_tahun(request $request)
    {
        $data=User::where('username',Auth::user()->username)->update([
            'tahun'=>$request->tahun,
        ]);
    }
    public function tampil_loading(request $request)
    {
        echo'
          <div style="width:100%;background:#fff5f5;height:300px;text-align:center;vartical-align:middle"><img src="'.url_plug().'/img/loading.gif" style="margin-top: 10%;"  width="10%"></div>

        ';
    }
}
