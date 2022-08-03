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
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Nomor</label>
                                <div class="col-lg-2">
                                    <input type="text" value="{{$data->nomor}}" disabled placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Area / Unit Kerja</label>
                                <div class="col-lg-7">
                                    <select class="default-select2 form-control" id="kode" name="kode">
										<optgroup label="Pilih Unit Kerja">
                                            <option value=""> Pilih unit kerja</option>
                                            @foreach(get_unit() as $unit)
                                                <option value="{{$unit->kode}}" @if($data->kode==$unit->kode) selected @endif > - {{$unit->name}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Lingkup Audit</label>
                                <div class="col-lg-10">
                                    <div class="input-group date" >
                                        <div class="input-group-addon" onclick="tambah_sistem(`{{$data->nomor}}`)" style="border-radius:0px;background:green;color:#fff">
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
                                <label class="col-lg-2 col-form-label">Periode</label>
                                <div class="col-lg-7">
                                    <select class="default-select2 form-control"  name="periode_id">
                                        <option value=""> Pilih periode</option>
                                        @foreach(get_periode() as $periode)
                                            <option value="{{$periode->id}}" @if($data->periode_id==$periode->id) selected @endif > - {{$periode->name}}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Auditor</label>
                                <div class="col-lg-10">
                                    <div class="input-group date" >
                                        <div class="input-group-addon" onclick="tambah_auditor(`{{$data->nomor}}`)" style="border-radius:0px;background:green;color:#fff">
                                            <i class="fa fa-plus"></i>
                                        </div>
                                        <span  class="select2 select2-container select2-container--default select2-container--above" style="width:90%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false">
                                                    <div id="tampil_auditor"></div>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true">

                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-12">
                            <div class="btn-group" style="margin-top:4%;margin-bottom:3%">
                                <span class="btn btn-sm btn-danger" onclick="location.assign(`{{url('Periode')}}`)"><i class="fas fa-reply"></i> Kembali</span>
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
                            <input type="hidden" name="nomor" value="{{$data->nomor}}">
                            <div id="tampil-sistem"></div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-success" onclick="simpan_sistem()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-auditor" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Daftar Auditor</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasierrorauditor"></div>
                        <form class="form-horizontal form-bordered" id="mydataauditor" action="{{url('/')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nomor" value="{{$data->nomor}}">
                            <div id="tampil-auditor"></div>
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-success" onclick="simpan_auditor()">Simpan</a>
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
        $('#pilihtanggal1').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        $('#tampil_sistem').load("{{url('Audit/sistem')}}?nomor={{$data->nomor}}");
        $('#tampil_auditor').load("{{url('Audit/auditor')}}?nomor={{$data->nomor}}");
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
        

		function tambah_auditor(nomor){
            $.ajax({
                url: "{{url('Audit/modal_auditor')}}",
                type: 'GET',
                data: "nomor="+nomor,
                success: function(msg){
                    $('#modal-auditor').modal('show');
                    $('#tampil-auditor').html(msg)
                }
            });
            
        }
		function tambah_sistem(nomor){
            $.ajax({
                url: "{{url('Audit/modal')}}",
                type: 'GET',
                data: "nomor="+nomor,
                success: function(msg){
                    $('#modal-form').modal('show');
                    $('#tampil-sistem').html(msg)
                }
            });
            
        }
		function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Audit')}}",
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
                            location.assign("{{url('Audit')}}");
                               
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
                    url: "{{url('/Audit/simpan_sistem')}}",
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
                            $('#tampil_sistem').load("{{url('Audit/sistem')}}?nomor={{$data->nomor}}");
                            document.getElementById("loadnya").style.width = "0px";
                            $('#modal-form').modal('hide');   
                              
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#notifikasierror').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function simpan_auditor(){
            var form=document.getElementById('mydataauditor');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Audit/simpan_auditor')}}",
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
                            $('#tampil_auditor').load("{{url('Audit/auditor')}}?nomor={{$data->nomor}}");
                            document.getElementById("loadnya").style.width = "0px";
                            $('#modal-auditor').modal('hide');     
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#notifikasierrorauditor').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
