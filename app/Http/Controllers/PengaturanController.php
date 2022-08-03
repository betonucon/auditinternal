<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Temuan;
use App\Audit;
use App\Auditauditor;
use App\Sistemdetail;
use App\Temuansistem;
use App\Help;

use App\Chat;


class PengaturanController extends Controller
{
    
    public function index(request $request){
        $menu='pengaturan';
        return view('Pengaturan.index',compact('menu'));
    }
    public function help(request $request){
        $menu='help';
        $data=Help::orderBy('id','Asc')->get();
        return view('Pengaturan.help',compact('menu','data'));
    }
    public function book(request $request){
        $menu='help';
        $data=Help::orderBy('id','Asc')->get();
        return view('Pengaturan.book',compact('menu','data'));
    }
    public function tampil_help(request $request){
        $data=Help::orderBy('id','Asc')->get();
        echo'
            <table class="table table-striped">
                <tr>
                    <th width="5%">No</th>
                    <th>Pemilik</th>
                    <th width="25%">No Telepon</th>
                    <th width="8%">Act</th>
                </tr>
      
        ';
            foreach($data as $no=>$o){
               echo'
                <tr>
                    <td>'.($no+1).'</td>
                    <td>'.$o->name.'</td>
                    <td>'.$o->nomor.'</td>
                    <td>
                        <span class="btn btn-xs btn-success" onclick="tambah_help(`'.$o->id.'`)"><i class="fas fa-pencil-alt"></i></span>
                        <span class="btn btn-xs btn-danger" onclick="hapus_help(`'.$o->id.'`)"><i class="fas fa-trash-alt"></i></span>
                    </td>
                </tr>
               ';
            }

        echo'</table>';
    }
    public function form_help(request $request){
        error_reporting(0);
        $data=Help::where('id',$request->id)->first();
        echo'
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">Pemilik</label>
                <div class="col-lg-10">
                    <input type="text" value="'.$data->name.'" name="name"  placeholder="Ketik disini....." class="form-control">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-2 col-form-label">No Telepon</label>
                <div class="col-lg-8">
                    <input type="text" value="'.$data->nomor.'" name="nomor" placeholder="Ketik disini....." class="form-control">
                </div>
            </div>
      
        ';

    }
    public function hapus_help(request $request){
        error_reporting(0);
        $data=Help::where('id',$request->id)->delete();
        

    }

    public function simpan_help(request $request){
        error_reporting(0);
        

            $rules = [
                'name'=> 'required',
                'nomor'=> 'required',
            ];

            $messages = [
                'name.required'=> 'Harap isi nama pemilik',
                'nomor.required'=> 'Harap isi nomor telepon',
            ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#fff;text-transform:uppercase;background:red">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            if($request->id==0){
                    
                    $data           = New Help;
                    $data->name     = $request->name;
                    $data->nomor     = $request->nomor;
                    $data->save();
                    
                    echo'@ok';
                   
                    
            }else{
                
                    $data           = Help::find($request->id);
                    $data->name     = $request->name;
                    $data->nomor     = $request->nomor;
                    $data->save();

                    echo'@ok@';
                
            }
        }
    }
    

    
}
