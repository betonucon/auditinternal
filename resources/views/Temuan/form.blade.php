@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Form Rencana Audit<small></small></h1>
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
                    <form class="form-horizontal form-bordered" id="mydata" action="{{url('Barangmasuk')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom:1%">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{$id}}">
                            <input type="hidden" name="nomor" value="{{$data->nomor}}">
                            <input type="hidden" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <input type="hidden" name="kode" value="{{$data->audit['kode']}}">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Nomor Temuan & Periode</label>
                                <div class="col-lg-2">
                                    <input type="text" value="{{$data->nomor_temuan}}" disabled placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Audit</label>
                                <div class="col-lg-1">
                                    <input type="text" value="{{$data->nomor}}" disabled placeholder="Ketik disini....." class="form-control">
                                </div>
                                <div class="col-lg-5">
                                <input type="text" value="{{$data->audit['kode']}} {{$data->audit->unit['name']}}" disabled placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Tanggal Mulai & Sampai</label>
                                <div class="col-lg-2">
                                    <div class="input-group date" id="pilihtanggal">
                                        <input type="text" name="tanggal" value="{{$data->tanggal}}" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="input-group date" id="pilihtanggal2">
                                        <input type="text" name="tanggal_sampai" value="{{$data->tanggal_sampai}}" class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Klausal</label>
                                <div class="col-lg-10">
                                    <div class="input-group date" >
                                        <div class="input-group-addon" onclick="tambah_sistem(`{{$data->nomor_temuan}}`,`{{$data->nomor}}`)" style="border-radius:0px;background:green;color:#fff">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <span  class="select2 select2-container select2-container--default select2-container--above" style="width:90%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false">
                                                    <div id="tampil_sistem"></div>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true">

                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Ketidaksuaian</label>
                                <div class="col-lg-10">
                                    <textarea class="form-control" name="ketidaksuaian" rows="3" placeholder="ketik disini......">{{$data->ketidaksuaian}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">File</label>
                                <div class="col-lg-10">
                                <span class="btn btn-success btn-sm" onclick="tambah_file(`{{$data->nomor_temuan}}`)">Tambah File</span>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label"></label>
                                <div class="col-lg-6 ">
                                    
                                    <div id="tampil-file"></div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div class="col-md-12">
                            <div class="btn-group" style="margin-top:4%;margin-bottom:3%">
                                <span class="btn btn-sm btn-danger" onclick="location.assign(`{{url('Temuan')}}`)"><i class="fas fa-reply"></i> Kembali</span>
                                <span class="btn btn-sm btn-primary" onclick="simpan_data()"><i class="fas fa-save"></i> Simpan</span>
                                
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Daftar Sistem</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasierror"></div>
                        <form class="form-horizontal form-bordered" id="mydatasistem" action="{{url('Pengguna')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <input type="hidden" name="nomor" value="{{$data->nomor}}">
                            <div class="tabel-responsive" style="overflow-x:scroll;height:400px;">
                                <div id="tampil-sistem"></div>

                            </div>
                            
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-success" onclick="simpan_sistem()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-file" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah file</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasierrorfile"></div>
                        <form class="form-horizontal form-bordered" id="mydatafile" action="{{url('/')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <input type="hidden" name="nomor" value="{{$data->nomor}}">
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">File</label>
                                <div class="col-lg-4">
                                    <input type="file" id="filenya" name="file" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Keterangan <br><i>(Opsional)</i></label>
                                <div class="col-lg-9">
                                    <input type="text" name="keterangan" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-success" onclick="simpan_file()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $('#pilihtanggal').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        $('#pilihtanggal2').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        $('#pilihtanggal1').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        $('#tampil_sistem').load("{{url('Temuan/sistem')}}?nomor_temuan={{$data->nomor_temuan}}");
        $('#tampil-file').load("{{url('Temuan/file')}}?nomor_temuan={{$data->nomor_temuan}}");
        window.onload=function(){
            $('#pilihtanggal').on('changeDate', function(e) {
                var dob = e.format();
                
                $.ajax({
                    url: "{{url('Periode/umur')}}",
                    type: 'GET',
                    data: "mulai="+dob,
                    success: function(msg){
                        $('#umur').val(msg)
                    }
                });
            });
        }
        

		function tambah_file(nomor){
            $('#filenya').val('');
            $('#modal-file').modal('show');
                  
        }
		function tambah_sistem(nomor_temuan,nomor){
            $.ajax({
                url: "{{url('Temuan/modal')}}",
                type: 'GET',
                data: "nomor_temuan="+nomor_temuan+"&nomor="+nomor,
                success: function(msg){
                    $('#modal-form').modal('show');
                    $('#tampil-sistem').html(msg)
                }
            });
            
        }
		function hapus_file(id){
            $.ajax({
                url: "{{url('Temuan/hapus_file')}}",
                type: 'GET',
                data: "id="+id,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    document.getElementById("loadnya").style.width = "0px";
                    $('#tampil-file').load("{{url('Temuan/file')}}?nomor_temuan={{$data->nomor_temuan}}");
                }
            });
            
        }
		function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan')}}",
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
                            location.assign("{{url('Temuan')}}");
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function simpan_sistem(){
            var form=document.getElementById('mydatasistem');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/simpan_sistem')}}",
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
                            $('#tampil_sistem').load("{{url('Temuan/sistem')}}?nomor_temuan={{$data->nomor_temuan}}");
                            document.getElementById("loadnya").style.width = "0px";
                            $('#modal-form').modal('hide');   
                              
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#notifikasierror').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function simpan_file(){
            var form=document.getElementById('mydatafile');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/simpan_file')}}",
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
                            $('#modal-file').modal('hide');   
                            $('#tampil-file').load("{{url('Temuan/file')}}?nomor_temuan={{$data->nomor_temuan}}");  
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#notifikasierrorfile').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
