@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Form Unit Kerja<small></small></h1>
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
                            
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Kode Unit</label>
                                <div class="col-lg-3">
                                    <input type="text" value="{{$data->kode}}" name="kode" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Nama Unit Kerja</label>
                                <div class="col-lg-7">
                                    <input type="text" value="{{$data->name}}" name="name" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            @if($id>0)
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Auditee</label>
                                <div class="col-lg-10">
                                    <div class="input-group date" >
                                        <span  class="select2 select2-container select2-container--default select2-container--above" style="width:90%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false">
                                                    <ul class="select2-selection__rendered">
        
                                                        @foreach(get_auditee($data->kode) as $no)
                
                                                            <li class="select2-selection__choice" title="[{{$no->username}}] {{$no->user['name']}}" data-select2-id="165">
                                                                <span class="select2-selection__choice__remove" role="presentation">×</span>[{{$no->username}}] {{$no->user['name']}}
                                                            </li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true">

                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Agen</label>
                                <div class="col-lg-10">
                                    <div class="input-group date" >
                                        <span  class="select2 select2-container select2-container--default select2-container--above" style="width:90%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false">
                                                    <ul class="select2-selection__rendered">
        
                                                        @foreach(get_agen($data->kode) as $no)
                
                                                            <li class="select2-selection__choice" title="[{{$no->username}}] {{$no->user['name']}}" data-select2-id="165">
                                                                <span class="select2-selection__choice__remove" role="presentation">×</span>[{{$no->username}}] {{$no->user['name']}}
                                                            </li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true">

                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Lo</label>
                                <div class="col-lg-10">
                                    <div class="input-group date" >
                                        <span  class="select2 select2-container select2-container--default select2-container--above" style="width:90%;">
                                            <span class="selection">
                                                <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-disabled="false">
                                                    <ul class="select2-selection__rendered">
        
                                                        @foreach(get_lo($data->kode) as $no)
                
                                                            <li class="select2-selection__choice" title="[{{$no->username}}] {{$no->user['name']}}" data-select2-id="165">
                                                                <span class="select2-selection__choice__remove" role="presentation">×</span>[{{$no->username}}] {{$no->user['name']}}
                                                            </li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                </span>
                                            </span>
                                            <span class="dropdown-wrapper" aria-hidden="true">

                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                           @endif
                        </div>
                        
                        <div class="col-md-12">
                            <div class="btn-group" style="margin-top:4%;margin-bottom:3%">
                                <span class="btn btn-sm btn-danger" onclick="location.assign(`{{url('Unit')}}`)"><i class="fas fa-reply"></i> Kembali</span>
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
</div>
@endsection

@push('ajax')
    <script>
        $('#pilihtanggal').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});

        window.onload=function(){
            $('#pilihtanggal').on('changeDate', function(e) {
                var dob = e.format();
                
                $.ajax({
                    url: "{{url('Unit/umur')}}",
                    type: 'GET',
                    data: "mulai="+dob,
                    success: function(msg){
                        $('#umur').val(msg)
                    }
                });
            });
        }
        

		function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Unit')}}",
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
                            location.assign("{{url('Unit')}}");
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#modal-alert').modal('show');
							$('#notifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
