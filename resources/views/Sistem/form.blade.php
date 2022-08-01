@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Form Sistem<small></small></h1>
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
                                <label class="col-lg-2 col-form-label">Nama Sistem</label>
                                <div class="col-lg-5">
                                    <input type="text" value="{{$data->name}}" name="name" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Deskripsi</label>
                                <div class="col-lg-9">
                                    <input type="text" value="{{$data->deskripsi}}" name="deskripsi" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-12">
                            <div class="btn-group" style="margin-top:4%;margin-bottom:3%">
                                <span class="btn btn-sm btn-danger" onclick="location.assign(`{{url('Sistem')}}`)"><i class="fas fa-reply"></i> Kembali</span>
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
                    url: "{{url('Sistem/umur')}}",
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
                    url: "{{url('/Sistem')}}",
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
                            location.assign("{{url('Sistem')}}");
                               
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
