<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Sistem;
use App\Sistemdetail;

class SistemController extends Controller
{
    public function index(request $request){
        $menu='master';
        $data=Sistem::orderBy('id','Asc')->get();
        
        if(Auth::user()->role_id==1){
            return view('Sistem.index',compact('menu','data'));
        }else{
            return view('error');
        }
    }
    
    public function get_data(request $request)
    {
        $data=Sistem::orderBy('id','Asc')->get();
       
        return  Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    
                        return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Sistem/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                    
                })
                ->addColumn('act', function($data){
                    
                        return'<span class="btn btn-success btn-xs" onclick="location.assign(`'.url('Sistem/detail?id='.$data['id']).'`)"><i class="fas fa-archive fa-fw"></i> Detail</span>';
                    
                })
                ->rawColumns(['action','act'])
                ->make(true);
        
    }
    public function tampil_detail(request $request){
        $data=Sistemdetail::where('sistem_id',$request->sistem_id)->where('note',1)->orderByRaw('name','Asc')->get();
        echo'

            <table class="table table-bordered">
                <tr>
                    
                    <th width="5%"></th>
                    <th width="10%">No Klausul</th>
                    <th >Nama </th>
                    <th width="5%"></th>
                </tr>';
                foreach($data as $no=>$o){
                    
                    echo'
                        <tr>
                            
                            <td  style="text-align:center"><span onclick="tambah_klausul(`'.$o->name.'`,2)" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i></span></td>
                            <td><b>'.$o->name.'</b></td>
                            <td>'.$o->detail.'</td>
                            <td><span class="btn btn-red btn-xs" onclick="hapus('.$o->id.',`'.$o->name.'`)"><i class="fas fa-window-close fa-fw"></i></span></td>
                        </tr>
                    ';
                    $det=Sistemdetail::where('sistem_id',$request->sistem_id)->where('note',2)->where('name','LIKE',$o->name.'%')->orderBy('name','Asc')->get();
                    foreach($det as $nox=>$odet){
                    
                        echo'
                            <tr>
                                
                                <td  style="text-align:center"><span onclick="tambah_klausul(`'.$odet->name.'`,3)" class="btn btn-xs btn-primary"><i class="fas fa-plus"></i></span></td>
                                <td style="text-align:center">-'.$odet->name.'</td>
                                <td>'.$odet->detail.'</td>
                                <td><span class="btn btn-red btn-xs" onclick="hapus('.$odet->id.',`'.$odet->name.'`)"><i class="fas fa-window-close fa-fw"></i></span></td>
                            </tr>
                        ';
                        $detail=Sistemdetail::where('sistem_id',$request->sistem_id)->where('note',3)->where('name','LIKE',$odet->name.'%')->orderBy('name','Asc')->get();
                        foreach($detail as $nox=>$odetail){
                        
                            echo'
                                <tr>
                                    
                                    <td></td>
                                    <td style="text-align:right">-'.$odetail->name.'</td>
                                    <td>'.$odetail->detail.'</td>
                                    <td><span class="btn btn-red btn-xs" onclick="hapus('.$odetail->id.',`'.$odetail->name.'`)"><i class="fas fa-window-close fa-fw"></i></span></td>
                                </tr>
                            ';
                        }
                    }
                }
                echo'
            </table>

        ';
    }
    public function form(request $request){
        error_reporting(0);
        $menu='master';
        if($request->id==0){
            $id=0;
        }else{
            $id=$request->id;
        }
        $data=Sistem::where('id',$id)->first();
        if(Auth::user()->role_id==1){
            return view('Sistem.form',compact('menu','data','id'));
        }else{
            return view('error');
        }
        
    }
    public function detail(request $request){
        error_reporting(0);
        $menu='master';
        $id=$request->id;
        $data=Sistem::where('id',$id)->first();
        if(Auth::user()->role_id==1){
            return view('Sistem.detail',compact('menu','data','id'));
        }else{
            return view('error');
        }
        
    }
   

    public function hapus(request $request){
        $hapus=Sistem::where('id',$request->id)->delete();
            
    }
    public function hapus_detail(request $request){
        $data=Sistemdetail::where('id',$request->id)->first();
        if($data->note==1){
            $hapus=Sistemdetail::where('name','LIKE',$data->name.'%')->delete();
        }
        if($data->note==2){
            $hapus=Sistemdetail::where('name','LIKE',$data->name.'%')->delete();
        }
        if($data->note==3){
            $hapus=Sistemdetail::where('id',$request->id)->delete();
        }
        
            
    }

    
    public function simpan(request $request){
        error_reporting(0);
        

            $rules = [
                'id'=> 'required',
                'name'=> 'required',
                'deskripsi'=> 'required',
            ];

            $messages = [
                'id.required'=> 'Harap isi pendidikan',
                'name.required'=> 'Harap isi nama Sistem',
                'deskripsi.required'=> 'Harap isi detail sistem',
                
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
                    
                    $data           = New Sistem;
                    $data->id     = $request->id;
                    $data->name     = $request->name;
                    $data->deskripsi     = $request->deskripsi;
                    $data->save();
                    
                    echo'@ok';
                   
                    
            }else{
                
                    $data           = Sistem::find($request->id);
                    $data->name     = $request->name;
                    $data->deskripsi     = $request->deskripsi;
                    $data->save();

                    echo'@ok';
                
            }
        }
    }
    public function simpan_detail(request $request){
        error_reporting(0);
        

            $rules = [
                'sistem_id'=> 'required',
                'name'=> 'required',
                'deskripsi'=> 'required',
            ];

            $messages = [
                'sistem_id.required'=> 'Harap isi pendidikan',
                'name.required'=> 'Harap isi nama Kalusul',
                'deskripsi.required'=> 'Harap isi detail Kalusul',
                
            ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br>';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'-'.$request->labelname.'<br>';
                }
            }
            echo'</div>';
        }else{
                
                    if($request->note==1){
                        $labelname=$request->name;
                    }else{
                        $labelname=$request->labelname.'.'.$request->name;
                    }
                    $cek=Sistemdetail::where('sistem_id',$request->sistem_id)->where('name',$labelname)->count(); 
                    if($cek>0){
                        echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br> Nomor Klausul Sudah terdaftar';
                    }else{
                        $data           = New Sistemdetail;
                        $data->sistem_id     = $request->sistem_id;
                        $data->name     = $labelname;
                        $data->note     = $request->note;
                        $data->detail     = $request->deskripsi;
                        $data->save();
                        if($data){
                            echo'@ok';
                        }
                        
                    }
                   
            
        }
    }

   
}
