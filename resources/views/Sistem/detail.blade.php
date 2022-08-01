@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Detail Sistem<small></small></h1>
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
                    <form class="form-horizontal form-bordered" action="{{url('Sistem')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom:1%">
                        <div class="col-md-12">
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <h4 class="widget-chat-header-title">Sistem</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{$id}}">
                            
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Nama Sistem</label>
                                <div class="col-lg-5">
                                    <input type="text" disabled value="{{$data->name}}" name="name" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Deskripsi</label>
                                <div class="col-lg-9">
                                    <input type="text" disabled value="{{$data->deskripsi}}" name="deskripsi" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-12">
                            <div class="btn-group" style="margin-top:4%;margin-bottom:0%">
                                <span class="btn btn-sm btn-danger" onclick="location.assign(`{{url('Sistem')}}`)"><i class="fas fa-reply"></i> Kembali</span>
                                <span class="btn btn-sm btn-primary" onclick="tambah_klausul(`0`,1)"><i class="fas fa-save"></i> Tambah Klausul</span>
                                
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Klausul</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasierror"></div>
                        <form class="form-horizontal form-bordered" id="mydata" action="{{url('Sistem')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="sistem_id" value="{{$data->id}}">
                            <input type="hidden" name="note" id="note" >
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">No Klausul</label>
                                <div class="col-lg-1">
                                    <input type="text" name="labelname" id="name" readonly class="form-control">
                                </div>
                                <div class="col-lg-2">
                                    <input type="text" name="name" id="nama_klausul" placeholder="Ketik disini....." class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label">Nama Klausul</label>
                                <div class="col-lg-9">
                                    <input type="text" name="deskripsi" id="deskripsi" placeholder="Ketik disini....." class="form-control">
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

        $('#tampil_detail').load("{{url('Sistem/tampil_detail?sistem_id='.$id)}}");
        function tambah_klausul(name,note){
           
            $('#note').val(note);
            $('#notifikasierror').hide();
            $('#nama_klausul').val("");
            $('#deskripsi').val("");
            if(note==0){
                $('#name').val(0);
            }else{
                $('#name').val(name);
            }
            $('#modal-form').modal('show')
            
        }
        function hapus(id,note){
            
            $.ajax({
                type: 'get',
                url: "{{url('/Sistem/hapus_detail')}}",
                data: "id="+id+"&note="+note,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    document.getElementById("loadnya").style.width = "0px";
                    $('#tampil_detail').load("{{url('Sistem/tampil_detail?sistem_id='.$data->id)}}");
                    
                    
                }
            });

       }

		function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Sistemdetail')}}",
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
                            $('#tampil_detail').load("{{url('Sistem/tampil_detail?sistem_id='.$data->id)}}");
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
