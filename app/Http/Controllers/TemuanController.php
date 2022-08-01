<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Temuan;
use App\Exports\TemuanExport;
use App\Audit;
use App\User;
use App\Auditauditor;
use App\Sistemdetail;
use App\Tanggaltemuan;
use App\Temuansistem;
use App\Temuanfile;
use App\Filter;

use App\Akses;


class TemuanController extends Controller
{
    public function index(request $request){
        $menu='Temuan';
        $data=Temuan::orderBy('nomor','Desc')->get();
        
        if(Auth::user()->role_id==2 || Auth::user()->role_id==4){
            return view('Temuan.index',compact('menu','data'));
        }
        if(Auth::user()->role_id==3 || Auth::user()->role_id==5){
            return view('Temuan.index_auditee',compact('menu','data'));
        }else{
            return view('error');
        }
    }
    
    public function get_data(request $request)
    {
        error_reporting(0);
        if(Auth::user()->role_id==2){
                $data=Temuan::query();
                $data->whereIn('nomor',array_auditor());
                $data->whereYear('create',tahun());
                if(filter_kode()=="all"){

                }else{
                    $data->where('kode',filter_kode()); 
                }
                if(filter_status()=="all"){
                    $data->where('status','!=',5);
                }else{
                    $data->where('status',filter_status()); 
                }
                $data->orderBy('nomor_temuan','Asc')->get();

                return  Datatables::of($data)->addIndexColumn()
                        ->addColumn('action', function($data){
                            if($data->status==0){
                                return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Temuan/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                            }elseif($data->status==1){
                                return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Temuan/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span><br>
                                '.cek_status($data->status,$data->nomor_temuan).'';
                            }else{
                                return cek_status($data->status,$data->nomor_temuan);
                            }
                                
                            
                        })
                        ->addColumn('unit_kerja', function($data){
                            
                                return $data->audit->unit['name'];
                            
                        })
                        ->addColumn('textnya', function($data){
                            if($data->status==0){
                                return '<i>Proses</i>';
                            }else{
                                return $data->ketidaksuaian;
                            }
                            
                        })
                        ->addColumn('periode', function($data){
                                
                                return $data->periode['name'];
                            
                        })
                        ->addColumn('temuan', function($data){
                                
                                return '<b>No Temuan</b><br>'.$data->nomor_temuan.'<br><b>No Audit</b><br>'.$data->nomor.'<br><b>Tanggal</b><br>'.$data->tanggal;
                            
                        })
                        ->addColumn('sistem', function($data){
                                $dat="";
                                foreach(get_sistem_temuan($data->nomor_temuan) as $get){
                                    $dat.='-'.$get->sistem['name'].' '.$get->sistemdetail['name'].'</br>';
                                }
                                return $dat;
                            
                        })
                        ->addColumn('auditor', function($data){
                                $dat="";
                                foreach(get_audit_auditor($data->nomor) as $get){
                                    $dat.='-'.$get->user['name'].'</br>';
                                }
                                return $dat;
                            
                        })
                        
                        ->rawColumns(['action','sistem','auditor','unit_kerja','textnya','temuan'])
                        ->make(true);
        }
        if(Auth::user()->role_id==3){
                $data=Temuan::query();
                $data->whereIn('status',array(2,3,4,5));
                $data->whereIn('kode',array_auditee());
                $data->whereYear('create',tahun());
                $data->orderBy('nomor_temuan','Asc')->get();
            
                return  Datatables::of($data)->addIndexColumn()
                        ->addColumn('action', function($data){
                            if($data->status==0){
                                return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Temuan/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                            }elseif($data->status==1){
                                return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Temuan/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                                <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span><br>
                                '.cek_status_auditee($data->status,$data->nomor_temuan).'';
                            }else{
                                return cek_status_auditee($data->status,$data->nomor_temuan);
                            }
                                
                            
                        })
                        ->addColumn('unit_kerja', function($data){
                            
                                return $data->audit->unit['name'];
                            
                        })
                        ->addColumn('textnya', function($data){
                            if($data->status==0){
                                return '<i>Proses</i>';
                            }else{
                                return $data->ketidaksuaian;
                            }
                            
                        })
                        ->addColumn('periode', function($data){
                                
                                return $data->periode['name'];
                            
                        })
                        ->addColumn('temuan', function($data){
                                
                                return '<b>No Temuan</b><br>'.$data->nomor_temuan.'<br><b>No Audit</b><br>'.$data->nomor.'<br><b>Tanggal</b><br>'.$data->tanggal;
                            
                        })
                        ->addColumn('sistem', function($data){
                                $dat="";
                                foreach(get_sistem_temuan($data->nomor_temuan) as $get){
                                    $dat.='-'.$get->sistem['name'].' '.$get->sistemdetail['name'].'</br>';
                                }
                                return $dat;
                            
                        })
                        ->addColumn('auditor', function($data){
                                $dat="";
                                foreach(get_audit_auditor($data->nomor) as $get){
                                    $dat.='-'.$get->user['name'].'</br>';
                                }
                                return $dat;
                            
                        })
                        
                        ->rawColumns(['action','sistem','auditor','unit_kerja','textnya','temuan'])
                        ->make(true);
        }
        
    }
    
    public function filternya(request $request){
        $data=User::where('username',Auth::user()->username)->update([
            'tahun'=>$request->tahun,
        ]);

        $cek=Filter::where('role_id',Auth::user()->role_id)->where('username',Auth::user()->username)->count();
        if($cek>0){
            $data=Filter::where('role_id',Auth::user()->role_id)->where('username',Auth::user()->username)->update([
                'kode'=>$request->kode,
                'status'=>$request->status,
            ]);
        }else{
            $data               =New Filter;
            $data->kode         = $request->kode;
            $data->status       = $request->status;
            $data->role_id      = Auth::user()->role_id;
            $data->username     = Auth::user()->username;
            $data->save();
        }
            
    }
    public function sistem(request $request){
        $get=Temuansistem::where('nomor_temuan',$request->nomor_temuan)->get();
        echo'
             <ul class="select2-selection__rendered">
        ';
            foreach($get as $no){
                echo'
                <li class="select2-selection__choice" title="'.$no->sistem['name'].' '.$no->sistemdetail['name'].'" data-select2-id="165">
                    <span class="select2-selection__choice__remove" role="presentation">×</span>'.$no->sistem['name'].' '.$no->sistemdetail['name'].'
                </li>';
                }
        echo'
                
            </ul>

        ';
    }
    public function file(request $request){
        $get=Temuanfile::where('nomor_temuan',$request->nomor_temuan)->get();
        echo'
            <table class="table table-striped">
                <tr>
                    <th width="5%">No</th>
                    <th >File</th>
                    <th width="5%">Act</th>
                </tr>
            
        ';
            foreach($get as $x=>$no){
                echo'
                    <tr>
                        <td>'.($x+1).'</td>
                        <td>'.$no->file.'</td>
                        <td><span class="btn btn-danger btn-xs" onclick="hapus_file('.$no->id.')">Hapus</span></td>
                    </tr>
                ';
            }
        echo'
                
            </table>

        ';
    }
    public function modal(request $request){
        $nomor=$request->nomor;
        $nomor_temuan=$request->nomor_temuan;
        return view('Temuan.modal',compact('nomor','nomor_temuan'));
    }
    public function modal_Temuanor(request $request){
        $aud=TemuanTemuanor::where('nomor',$request->nomor)->where('role_id',2)->get();
        $nomor=$request->nomor;
        return view('Temuan.modal_Temuanor',compact('aud','nomor'));
    }
    public function form(request $request){
        error_reporting(0);
        $menu='Temuan';
        $id=$request->id;
        $data=Temuan::where('id',$id)->first();
        return view('Temuan.form',compact('menu','data','id'));
    }
    public function detail(request $request){
        error_reporting(0);
        $menu='temuan';
        $id=$request->temuan;
       
        if(Auth::user()->role_id==2 || Auth::user()->role_id==4){
            $data=Temuan::where('nomor_temuan',$id)->whereIn('nomor',array_auditor())->first();
            if($data->nomor_temuan==""){
                return view('error');
            }else{
                return view('Temuan.detail',compact('menu','data','id'));
            }
            
        }
        if(Auth::user()->role_id==3 || Auth::user()->role_id==5){
            $data=Temuan::where('nomor_temuan',$id)->first();
            return view('Temuan.detail_auditee',compact('menu','data','id'));
        }
        
    }
    
    public function hapus(request $request){
        $first=Temuan::where('id',$request->id)->first();
        $hapus=Temuan::where('id',$request->id)->update(['status'=>5]);
        $hapus2=Temuansistem::where('nomor_temuan',$first->nomor_temuan)->update(['status'=>5]);
            
    }
    public function publish(request $request){
        if(Auth::user()->role_id==2){
            $data=Temuan::where('nomor_temuan',$request->nomor_temuan)->first();
            $save           = New Tanggaltemuan;
            $save->nomor_temuan         = $request->nomor_temuan;
            $save->mulai         = $data->tanggal;
            $save->sampai         = $data->tanggal_sampai;
            $save->username         = Auth::user()->username;
            $save->status         = 1;
            $save->save();
            if($save){
                $hapus2=Temuan::where('nomor_temuan',$request->nomor_temuan)->update([
                    'status'=>2
                ]);
            }
        }
            
    }
    public function onprogres(request $request){
        if(Auth::user()->role_id==3 || Auth::user()->role_id==5){
            $data=Temuan::where('nomor_temuan',$request->nomor_temuan)->update([
                'status'=>5
            ]);
            
        }
            
    }
    public function hapus_file(request $request){
        $first=Temuanfile::where('id',$request->id)->delete();
            
    }
    
    public function simpan_sistem(request $request){
        error_reporting(0);
        $cek=count($request->sistem_detail_id);
        if($cek>0){
            $cekdata=Temuansistem::where('nomor_temuan',$request->nomor_temuan)->count();
            if($cekdata>0){
                $hapus=Temuansistem::where('nomor_temuan',$request->nomor_temuan)->delete();
                if($hapus){
                    for($x=0;$x<$cek;$x++){
                        $detail=Sistemdetail::where('id',$request->sistem_detail_id[$x])->first();
                        $save               = New Temuansistem;
                        $save->nomor        = $request->nomor;
                        $save->nomor_temuan        = $request->nomor_temuan;
                        $save->sistem_id        = $detail->sistem_id;
                        $save->sistem_detail_id        = $request->sistem_detail_id[$x];
                        $save->status = 1;
                        $save->save();
                    }
                }
            }else{
                for($x=0;$x<$cek;$x++){
                    $detail=Sistemdetail::where('id',$request->sistem_detail_id[$x])->first();
                    $save               = New Temuansistem;
                    $save->nomor        = $request->nomor;
                    $save->nomor_temuan        = $request->nomor_temuan;
                    $save->sistem_id        = $detail->sistem_id;
                    $save->sistem_detail_id        = $request->sistem_detail_id[$x];
                    $save->status = 1;
                    $save->save();
                }
            }
             echo'@ok';   
        }else{
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br>Pilih Sistem</div>';
        }
    }
    public function simpan_file(request $request){
        error_reporting(0);
        $rules = [
            'file'=> 'required|mimes:pdf',
        ];

        $messages = [
            'file.required'=> 'File harus PDF',
            
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            $image = $request->file('file');
            $imageFileName =$request->nomor_temuan.'-'.date('ymdhis').'.'. $image->getClientOriginalExtension();
            $filePath =$imageFileName;
            $file = \Storage::disk('public_uploads');
            if($file->put($filePath, file_get_contents($image))){
                $save               = New Temuanfile;
                $save->nomor_temuan        = $request->nomor_temuan;
                $save->keterangan        = $request->keterangan;
                $save->file        = $filePath;
                $save->save();

                echo'@ok';   
            }
        }
    }

    public function open(request $request){
        error_reporting(0);
        $rules = [
            'status'=> 'required',
        ];

        $messages = [
            'status.required'=> 'Pilih Status',
            
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            if($request->status==3){
                $save=Temuan::where('nomor_temuan',$request->nomor_temuan)->update([
                    'status'=>$request->status,
                    'tanggal_open'=>date('Y-m-d'),
                ]);
                
                echo'@ok'; 
            }else{
                if($request->alasan_penolakan==""){
                    echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase"> Isi alasan penolakan</div>';
                }else{
                    $save=Temuan::where('nomor_temuan',$request->nomor_temuan)->update([
                        'status'=>$request->status,
                        'alasan_penolakan'=>$request->alasan_penolakan,
                        'tanggal_drop'=>date('Y-m-d'),
                    ]);
                    
                    echo'@ok'; 
                }
            }
                  
            
        }
    }
    public function penyebab(request $request){
        error_reporting(0);
        $rules = [
            'penyebab'=> 'required',
        ];

        $messages = [
            'penyebab.required'=> 'Isi penyebab',
            
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            
                $save=Temuan::where('nomor_temuan',$request->nomor_temuan)->update([
                    'penyebab'=>$request->penyebab,
                ]);
                
                echo'@ok'; 
            
        }
    }
    public function perbaikan(request $request){
        error_reporting(0);
        $rules = [
            'perbaikan'=> 'required',
        ];

        $messages = [
            'perbaikan.required'=> 'Isi perbaikan',
            
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            
                $save=Temuan::where('nomor_temuan',$request->nomor_temuan)->update([
                    'perbaikan'=>$request->perbaikan,
                ]);
                
                echo'@ok'; 
            
        }
    }

    public function create(request $request){
        error_reporting(0);
        

        $rules = [
            'nomor'=> 'required',
            'tanggal'=> 'required',
            'tanggal_sampai'=> 'required',
        ];

        $messages = [
            'nomor.required'=> 'Pilih audit',
            'tanggal.required'=> 'Harap isi  tanggal mulai',
            'tanggal_sampai.required'=> 'Harap isi  tanggal sampai',
            
        ];
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">';
            foreach(parsing_validator($val) as $value){
                foreach($value as $isi){
                    echo'-&nbsp;'.$isi.'<br>';
                }
            }
            echo'</div>';
        }else{
            
                $audit=Audit::where('nomor',$request->nomor)->first();
                $data           = New Temuan;
                $data->nomor  = $request->nomor;
                $data->nomor_temuan  = penomoran_temuan($request->nomor);
                $data->tanggal  = $request->tanggal;
                $data->tanggal_sampai  = $request->tanggal_sampai;
                $data->kode     = $audit->kode;
                $data->username     = Auth::user()['username'];
                $data->create     = date('Y-m-d');
                $data->bulan     = date('m');
                $data->tahun     = date('Y');
                $data->status     = 0;
                $data->save();

                echo'@ok@'.$data->id;
                
        }
    }
    public function simpan(request $request){
        error_reporting(0);
        

        $rules = [
            'ketidaksuaian'=> 'required',
            'tanggal'=> 'required',
        ];

        $messages = [
            'ketidaksuaian.required'=> 'Harap isi ketidaksuaian',
            'tanggal.required'=> 'Harap isi  tanggal',
            
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
            
                if(count_sistem_temuan($request->nomor_temuan)>0 && count_sistem_temuan_file($request->nomor_temuan)>0){
                    $data           = Temuan::find($request->id);
                    $data->tanggal  = $request->tanggal;
                    $data->tanggal_sampai  = $request->tanggal_sampai;
                    $data->kode     = $request->kode;
                    $data->ketidaksuaian     = $request->ketidaksuaian;
                    $data->status     = 1;
                    $data->save();

                    echo'@ok@';
                }else{
                    echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br>Tambahkan Klausul dan upload file temuan </div>';
                }
                
            
        }
    }

    public function export_excel(request $request)
	{
        ob_end_clean(); // this
        ob_start(); // and this
		return Excel::download(new TemuanExport, 'Temuan'.date('Ymd').'.xlsx');
        
	}
    
}
