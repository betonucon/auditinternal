<?php

namespace App\Http\Controllers;
use Validator;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Pengguna;
use App\Penggunadetail;
use App\Akses;


class PenggunaController extends Controller
{
    public function index(request $request){
        $menu='master';
        $data=Pengguna::orderBy('id','Asc')->get();
        if(Auth::user()->role_id==1){
            return view('Pengguna.index',compact('menu','data'));
        }else{
            return view('error');
        }
        
    }
    
    public function get_data(request $request)
    {
        $data=Pengguna::orderBy('id','Asc')->get();
       
        return  Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    
                        return'<span class="btn btn-yellow btn-xs" onclick="location.assign(`'.url('Pengguna/form?id='.$data['id']).'`)"><i class="fas fa-pencil-alt fa-fw"></i></span>
                        <span class="btn btn-red btn-xs" onclick="hapus('.$data['id'].')"><i class="fas fa-window-close fa-fw"></i></span>';
                    
                })
                ->addColumn('act', function($data){
                    
                        return'<span class="btn btn-success btn-xs" onclick="location.assign(`'.url('Pengguna/detail?nik='.$data['username']).'`)"><i class="fas fa-archive fa-fw"></i> Detail</span>';
                    
                })
                ->addColumn('akun_admin', function($data){
                    if($data->admin==1){
                        return '<label class="label label-primary" onclick="detail(`'.$data->username.'`,1)"><i class="fas fa-cog"></i> Admin</label>';
                    }else{
                        return '';
                    }
                })
                ->addColumn('akun_auditor', function($data){
                    if($data->auditor==1){
                        return '<label class="label label-primary" onclick="detail(`'.$data->username.'`,2)"><i class="fas fa-cog"></i> Auditor</label>';
                    }else{
                        return '';
                    }
                })
                ->addColumn('akun_auditee', function($data){
                    if($data->auditee==1){
                        return '<label class="label label-primary" onclick="detail(`'.$data->username.'`,3)"><i class="fas fa-cog"></i> Auditee</label>';
                    }else{
                        return '';
                    }
                })
                ->addColumn('akun_lo', function($data){
                    if($data->lo==1){
                        return '<label class="label label-primary" onclick="detail(`'.$data->username.'`,4)"><i class="fas fa-cog"></i> Lo</label>';
                    }else{
                        return '';
                    }
                })
                ->addColumn('akun_agen', function($data){
                    if($data->agen==1){
                        return '<label class="label label-primary" onclick="detail(`'.$data->username.'`,5)"><i class="fas fa-cog"></i> Agen</label>';
                    }else{
                        return '';
                    }
                })
                ->rawColumns(['action','act','akun_admin','akun_auditor','akun_auditee','akun_lo','akun_agen'])
                ->make(true);
        
    }
    public function tampil_detail(request $request){
        error_reporting(0);
        $data=Akses::where('username',$request->username)->where('role_id',$request->role_id)->orderByRaw('id','Asc')->get();
        echo'

            <table class="table table-bordered">
                <tr>
                    
                    <th width="5%">No</th>
                    <th width="18%">Kode Unit</th>
                    <th >Nama Unit</th>
                    <th width="5%"></th>
                </tr>';
                foreach($data as $no=>$o){
                    
                    echo'
                        <tr>
                            
                            <td  style="text-align:center">'.($no+1).'</td>
                            <td><b>'.$o->kode.'</b></td>
                            <td>'.$o->unit['name'].'</td>
                            <td><span class="btn btn-red btn-xs" onclick="hapus('.$o->id.')"><i class="fas fa-window-close fa-fw"></i></span></td>
                        </tr>
                    ';
                   
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
        $data=Pengguna::where('id',$id)->first();
        if(Auth::user()->role_id==1){
            return view('Pengguna.form',compact('menu','data','id'));
        }else{
            return view('error');
        }
        
    }
    public function detail(request $request){
        error_reporting(0);
        $menu='master';
        $id=$request->nik;
        $role_id=$request->role_id;
        $data=Pengguna::where('username',$id)->first();
        if(Auth::user()->role_id==1){
            return view('Pengguna.detail',compact('menu','data','id','role_id'));
        }else{
            return view('error');
        }
        
    }
   

    public function hapus(request $request){
        $hapus=Pengguna::where('id',$request->id)->delete();
            
    }
    public function hapus_detail(request $request){
        
            $hapus=Akses::where('id',$request->id)->delete();
           
    }
    public function switch_akun(request $request){
        
        $hapus=Pengguna::where('username',Auth::user()['username'])->update([
            'role_id'=>$request->id
        ]);
           
    }

    public function simpan(request $request){
        error_reporting(0);
        

            $rules = [
                'id'=> 'required',
                'username'=> 'required',
                'email'=> 'required',
                'name'=> 'required',
                'role_id'=> 'required',
            ];

            $messages = [
                'id.required'=> 'Harap isi pendidikan',
                'username.required'=> 'Harap isi  nik',
                'email.required'=> 'Harap isi email',
                'name.required'=> 'Harap isi nama',
                'role_id.required'=> 'Harap isi role awal',
                
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
                    
                    $data           = New Pengguna;
                    $data->name     = $request->name;
                    $data->username     = $request->username;
                    $data->email     = $request->email;
                    $data->admin     = $request->admin;
                    $data->auditor     = $request->auditor;
                    $data->auditee     = $request->auditee;
                    $data->agen     = $request->agen;
                    $data->lo     = $request->lo;
                    $data->role_id     = $request->role_id;
                    $data->password     = Hash::make($request->username);
                    $data->save();
                    
                    echo'@ok@'.$data->id;
                   
                    
            }else{
                
                    $data           = Pengguna::find($request->id);
                    $data->name     = $request->name;
                    $data->email     = $request->email;
                    $data->admin     = $request->admin;
                    $data->auditor     = $request->auditor;
                    $data->auditee     = $request->auditee;
                    $data->agen     = $request->agen;
                    $data->lo     = $request->lo;
                    $data->role_id     = $request->role_id;
                    $data->save();

                    echo'@ok@'.$request->id;
                
            }
        }
    }
    public function simpan_detail(request $request){
        error_reporting(0);
        

            $rules = [
                'kode'=> 'required',
            ];

            $messages = [
                'kode.required'=> 'Harap pilih unit kerja',
                
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
             
                $cek=Akses::where('username',$request->username)->where('role_id',$request->role_id)->where('kode',$request->kode)->count(); 
                if($cek>0){
                    echo'<div style="padding:1%;color:#000;background:#e9e9de;text-transform:uppercase">Error<br> Unit kerja sudah didaftarkan';
                }else{
                    $data           = New Akses;
                    $data->username     = $request->username;
                    $data->kode     =  $request->kode;
                    $data->role_id     = $request->role_id;
                    $data->save();
                    if($data){
                        echo'@ok';
                    }
                    
                }
                   
            
        }
    }

   
}
