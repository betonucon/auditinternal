<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Audit;
use App\Auditauditor;
use App\Auditsistem;

use App\Akses;


class AuditController extends Controller
{
    public function index(request $request){
        
        $menu='audit';
        $data=Audit::orderBy('nomor','Desc')->get();
        if(Auth::user()->role_id==1){
            return view('Audit.index',compact('menu','data'));
        }else{
            return view('error');
        }
        
        
    }
    
    public function get_data(request $request)
    {
        error_reporting(0);
        $data=Audit::query();
        $data->where('status','!=',5);
        $data->whereYear('create',tahun());
        $data->orderBy('nomor','Asc')->get();
       
        return  Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    
                        return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Audit/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                    
                })
                ->addColumn('cetak', function($data){
                    
                        return'<span class="btn btn-success btn-xs" onclick="location.assign(`'.url('Audit/laporan?id='.$data['id']).'`)"><i class="fas fa-clone fa-fw"></i></span>';
                    
                })
                ->addColumn('unit_kerja', function($data){
                    
                        return'<b>'.$data['kode'].'</b> '.$data->unit['name'];
                    
                })
                
                ->addColumn('periode', function($data){
                        
                        return $data->periode['name'];
                    
                })
                ->addColumn('sistem', function($data){
                        $dat="";
                        foreach(get_audit_sistem($data->nomor) as $get){
                            $dat.='<span class="badge bg-blue f-s-12">'.$get->sistem['name'].'</span>';
                        }
                        return $dat;
                    
                })
                ->addColumn('auditor', function($data){
                        $dat="";
                        foreach(get_audit_auditor($data->nomor) as $get){
                            $dat.='<span class="badge bg-green f-s-12">'.$get->user['name'].'</span>';
                        }
                        return $dat;
                    
                })
                
                ->rawColumns(['action','sistem','auditor','unit_kerja','statusnya','cetak'])
                ->make(true);
        
    }
    
    public function sistem(request $request){
        $get=Auditsistem::where('nomor',$request->nomor)->where('kat',1)->get();
        echo'
             <ul class="select2-selection__rendered">
        ';
            foreach($get as $no){
                echo'
                <li class="select2-selection__choice" title="'.$no->sistem['name'].'" data-select2-id="165">
                    <span class="select2-selection__choice__remove" role="presentation">×</span>'.$no->sistem['name'].'
                </li>';
                }
        echo'
                
            </ul>

        ';
    }
    public function auditor(request $request){
        $get=Auditauditor::where('nomor',$request->nomor)->where('role_id',2)->get();
        echo'
             <ul class="select2-selection__rendered">
        ';
            foreach($get as $no){
                echo'
                <li class="select2-selection__choice" title="['.$no->username.'] '.$no->user['name'].'" data-select2-id="165">
                    <span class="select2-selection__choice__remove" role="presentation">×</span>['.$no->username.'] '.$no->user['name'].'
                </li>';
                }
        echo'
                
            </ul>

        ';
    }
    public function laporan(request $request){
        $data=Audit::where('id',$request->id)->first();
        $menu='audit';
        return view('Audit.laporan',compact('data','menu'));
    }
    public function modal(request $request){
        $aud=Auditsistem::where('nomor',$request->nomor)->where('kat',1)->get();
        $nomor=$request->nomor;
        return view('Audit.modal',compact('aud','nomor'));
    }
    public function modal_auditor(request $request){
        $aud=Auditauditor::where('nomor',$request->nomor)->where('role_id',2)->get();
        $nomor=$request->nomor;
        return view('Audit.modal_auditor',compact('aud','nomor'));
    }
    public function form(request $request){
        error_reporting(0);
        $menu='audit';
        if($request->id==0){
            $cek=Audit::where('username',Auth::user()->username)->where('status',0)->count();
            if($cek>0){
                $aud=Audit::where('username',Auth::user()->username)->where('status',0)->orderBy('id','Desc')->firstOrfail();
                $id=$aud['id'];
            }else{
                $save      = New Audit;
                $save->nomor = penomoran();
                $save->status = 0;
                $save->tahun = date('Y');
                $save->bulan = date('m');
                $save->username = Auth::user()->username;
                $save->save();
                $id=$save->id;
            }
        }else{
            $id=$request->id;
        }
        $data=Audit::where('id',$id)->first();
        if(Auth::user()->role_id==1){
            return view('Audit.form',compact('menu','data','id'));
        }else{
            return view('error');
        }
       
        
    }
    
    public function hapus(request $request){
        $first=Audit::where('id',$request->id)->first();
        $hapus=Audit::where('id',$request->id)->update(['status'=>5]);
        $hapus2=Auditsistem::where('nomor',$first->nomor)->update(['status'=>5]);
            
    }
    
    public function simpan_sistem(request $request){
        error_reporting(0);
        $cek=count($request->sistem_id);
        if($cek>0){
            $cekdata=Auditsistem::where('nomor',$request->nomor)->count();
            if($cekdata>0){
                $hapus=Auditsistem::where('nomor',$request->nomor)->delete();
                if($hapus){
                    for($x=0;$x<$cek;$x++){
                        $save               = New Auditsistem;
                        $save->nomor        = $request->nomor;
                        $save->sistem_id        = $request->sistem_id[$x];
                        $save->kat        = 1;
                        $save->status = 1;
                        $save->save();
                    }
                }
            }else{
                for($x=0;$x<$cek;$x++){
                    $save               = New Auditsistem;
                    $save->nomor        = $request->nomor;
                    $save->sistem_id        = $request->sistem_id[$x];
                    $save->kat        = 1;
                    $save->status = 1;
                    $save->save();
                }
            }
             echo'@ok';   
        }else{
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br>Pilih Sistem</div>';
        }
    }
    public function simpan_auditor(request $request){
        error_reporting(0);
        
        $cek=count($request->username);
        if($cek>0){
            $cekdata=Auditauditor::where('nomor',$request->nomor)->count();
            if($cekdata>0){
                $hapus=Auditauditor::where('nomor',$request->nomor)->delete();
                if($hapus){
                    for($x=0;$x<$cek;$x++){
                        $save               = New Auditauditor;
                        $save->nomor        = $request->nomor;
                        $save->username        = $request->username[$x];
                        $save->role_id        = 2;
                        $save->save();
                    }
                }
            }else{
                for($x=0;$x<$cek;$x++){
                    $save               = New Auditauditor;
                    $save->nomor        = $request->nomor;
                    $save->username        = $request->username[$x];
                    $save->role_id        = 2;
                    $save->save();
                }
            }
             echo'@ok';   
        }else{
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br>Pilih Auditor</div>';
        }
    }

    public function simpan(request $request){
        error_reporting(0);
        

            $rules = [
                'kode'=> 'required',
                'periode_id'=> 'required',
            ];

            $messages = [
                'kode.required'=> 'Harap isi unit kerja',
                'periode_id.required'=> 'Harap isi  periode',
                
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
            if(count_sistem($request->nomor)==0 || count_auditor($request->nomor)==0){
                echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br>Pilih Auditor dan Sistem </div>';
            }else{
                
                    $data           = Audit::find($request->id);
                    $data->kode     = $request->kode;
                    $data->periode_id     = $request->periode_id;
                    $data->create     = date('Y-m-d H:i:s');
                    $data->status     = 1;
                    $data->save();

                    echo'@ok@';
                
            }
        }
    }
    
}
