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
use App\Temuanfile;

use App\Chat;


class ChatController extends Controller
{
    
    public function index(request $request){
        $data=Chat::where('nomor_temuan',$request->nomor_temuan)->orderBy('id','Asc')->get();
        foreach($data as $o){
            if($o->role_id==2){$color="primary";}else{$color="warning ";}
            echo'<div class="alert alert-'.$color.' fade show" style="margin: 3px 10px"><b>'.$o->user['name'].' ('.$o->role['name'].')</b>&nbsp;&nbsp;&nbsp; '.$o->waktu.'<br>'.$o->text.'</div>';
        }
    }

    public function simpan(request $request){
        error_reporting(0);
        if($request->text==""){

        }else{
            $data           = New Chat;
            $data->nomor_temuan = $request->nomor_temuan;
            $data->text = $request->text;
            $data->username = Auth::user()->username;
            $data->role_id = Auth::user()->role_id;
            $data->waktu  = date('Y-m-d H:i:s');
            $data->save();
        }

        echo'@ok@'.$request->nomor_temuan;
        // $rules = [
        //     'file'=> 'required|mimes:pdf',
        // ];

        // $messages = [
        //     'file.required'=> 'File harus PDF',
            
        // ];
       
        // $validator = Validator::make($request->all(), $rules, $messages);
        // $val=$validator->Errors();


        // if ($validator->fails()) {
        //     echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">';
        //     foreach(parsing_validator($val) as $value){
        //         foreach($value as $isi){
        //             echo'-&nbsp;'.$isi.'<br>';
        //         }
        //     }
        //     echo'</div>';
        // }else{
            
        // }
    }

    
}
