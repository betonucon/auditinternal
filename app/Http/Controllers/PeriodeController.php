<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Periode;

use App\Akses;


class PeriodeController extends Controller
{
    public function index(request $request){
        $menu='master';
        $data=Periode::orderBy('name','Asc')->get();
        return view('Periode.index',compact('menu','data'));
    }
    
    public function get_data(request $request)
    {
        $data=Periode::where('aktif',1)->orderBy('name','Asc')->get();
       
        return  Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    
                        return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Periode/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                    
                })
                ->addColumn('bulannya', function($data){
                    return bulan($data->bulan);
                })
                
                ->rawColumns(['action'])
                ->make(true);
        
    }
    
    public function form(request $request){
        error_reporting(0);
        $menu='master';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $data=Periode::where('id',$id)->first();
        return view('Periode.form',compact('menu','data','id'));
    }
    
    public function hapus(request $request){
        $hapus=Periode::where('id',$request->id)->update([
            'aktif'=>0
        ]);
            
    }
    

    public function simpan(request $request){
        error_reporting(0);
        

            $rules = [
                'name'=> 'required',
                'mulai'=> 'required',
                'sampai'=> 'required',
                'bulan'=> 'required',
                'tahun'=> 'required',
            ];

            $messages = [
                'name.required'=> 'Harap isi periode',
                'mulai.required'=> 'Harap isi tanggal mulai',
                'sampai.required'=> 'Harap isi tanggal sampai',
                'bulan.required'=> 'Harap isi bulan',
                'tahun.required'=> 'Harap isi  tahun',
                
            ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            if($request->id==0){
                    
                    $data           = New Periode;
                    $data->name     = $request->name;
                    $data->mulai     = $request->mulai;
                    $data->sampai     = $request->sampai;
                    $data->bulan     = $request->bulan;
                    $data->tahun     = $request->tahun;
                    $data->aktif     = 1;
                    $data->save();
                    
                    echo'@ok';
                   
                    
            }else{
                
                    $data           = Periode::find($request->id);
                    $data->name     = $request->name;
                    $data->mulai     = $request->mulai;
                    $data->sampai     = $request->sampai;
                    $data->bulan     = $request->bulan;
                    $data->tahun     = $request->tahun;
                    $data->save();

                    echo'@ok@';
                
            }
        }
    }
    
}
