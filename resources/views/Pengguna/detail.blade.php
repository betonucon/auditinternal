@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Akses Unit Kerja Role {{nama_role($role_id)}}<small></small></h1>
    <div class="row">
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">&nbsp;</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <form class="form-horizontal form-bordered" action="{{url('Pengguna')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom:1%">
                        <div class="col-md-12">
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <h4 class="widget-chat-header-title"><i class="fas fa-bars"></i> Pengguna</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{$id}}">
                            
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Nik</b></label>
                                <div class="col-lg-3">
                                    <b>:</b> {{$data->username}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Nama</b></label>
                                <div class="col-lg-5">
                                    <b>:</b> {{$data->name}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Email</b></label>
                                <div class="col-lg-5">
                                    <b>:</b> {{$data->email}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Role Akses</b></label>
                                <div class="col-lg-11">
                                    <b>:</b> @if($data->admin==1) Admin @endif
                                    @if($data->auditor==1) / Auditor @endif
                                    @if($data->auditee==1) / Auditee @endif
                                    @if($data->lo==1) / Lo @endif
                                    @if($data->agen==1) / Agen @endif
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="col-md-12" style="margin-top:3%;margin-bottom:0%">
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <h4 class="widget-chat-header-title"><i class="fas fa-bars"></i> Unit Kerja Role {{nama_role($role_id)}}</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                            <div class="btn-group" style="margin-top:1%;margin-bottom:0%">
                                <span class="btn btn-sm btn-danger" onclick="location.assign(`{{url('Pengguna')}}`)"><i class="fas fa-reply"></i> Kembali</span>
                                <span class="btn btn-sm btn-primary" onclick="tambah_klausul()"><i class="fas fa-save"></i> Tambah Unit Kerja</span>
                                
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-top:2%">
                            <div id="tampil_detail"></div>
                            
                        </div>
                        
                        
                    </div>
                        
                        
                        
                    </div>
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <div class="row">
        <div class="modal fade" id="modal-form" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Unit Kerja</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasierror"></div>
                        <form class="form-horizontal form-bordered" id="mydata" action="{{url('Pengguna')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="username" value="{{$data->username}}">
                            <input type="hidden" name="role_id" value="{{$role_id}}" >
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Unit Kerja</label>
                                <div class="col-lg-9">
                                    <select class="default-select2 form-control" id="kode" name="kode">
										<optgroup label="Pilih Unit Kerja">
                                            <option value=""> Pilih unit kerja</option>
                                            @foreach(get_unit() as $unit)
                                                <option value="{{$unit->kode}}"> - {{$unit->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-success" onclick="simpan_data()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $('#sampai').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        $('#mulai').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});

        $('#tampil_detail').load("{{url('Pengguna/tampil_detail')}}?username={{$data->username}}&role_id={{$role_id}}");
        function tambah_klausul(){
           $('#kode').val("")
           $('#notifikasierror').hide();
           $('#modal-form').modal('show')
            
        }
        function hapus(id){
            
            $.ajax({
                type: 'get',
                url: "{{url('/Pengguna/hapus_detail')}}",
                data: "id="+id,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    document.getElementById("loadnya").style.width = "0px";
                    $('#tampil_detail').load("{{url('Pengguna/tampil_detail')}}?username={{$data->username}}&role_id={{$role_id}}");
                    
                    
                }
            });

       }

       function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Penggunadetail')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            document.getElementById("loadnya").style.width = "0px";
                            $('#modal-form').modal('hide');
                            $('#tampil_detail').load("{{url('Pengguna/tampil_detail')}}?username={{$data->username}}&role_id={{$role_id}}");
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            $('#notifikasierror').show();
							$('#notifikasierror').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
