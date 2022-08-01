<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Unit;

use App\Akses;


class UnitController extends Controller
{
    public function index(request $request){
        $menu='master';
        $data=Unit::orderBy('name','Asc')->get();
        if(Auth::user()->role_id==1){
            return view('Unit.index',compact('menu','data'));
        }else{
            return view('error');
        }
        
    }
    
    public function get_data(request $request)
    {
        $data=Unit::where('aktif',1)->orderBy('name','Asc')->get();
       
        return  Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    
                        return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Unit/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                    
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
        $data=Unit::where('id',$id)->first();
        if(Auth::user()->role_id==1){
            return view('Unit.form',compact('menu','data','id'));
        }else{
            return view('error');
        }
        
    }
    
    public function hapus(request $request){
        $hapus=Unit::where('id',$request->id)->update(['aktif'=>0]);
            
    }
    

    public function simpan(request $request){
        error_reporting(0);
        

            $rules = [
                'kode'=> 'required',
                'name'=> 'required',
            ];

            $messages = [
                'kode.required'=> 'Harap isi kode unit',
                'name.required'=> 'Harap isi  nama unit kerja',
                
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
                    
                    $data           = New Unit;
                    $data->name     = $request->name;
                    $data->kode     = $request->kode;
                    $data->aktif     = 1;
                    $data->save();
                    
                    echo'@ok';
                   
                    
            }else{
                
                    $data           = Unit::find($request->id);
                    $data->name     = $request->name;
                    $data->save();

                    echo'@ok@';
                
            }
        }
    }
    
}
