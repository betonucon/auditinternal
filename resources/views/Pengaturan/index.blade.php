@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Pengaturan<small></small></h1>
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
                    <div class="row" style="margin-bottom:1%">
                        <div class="col-md-12">
                            <table class="table table-invoice">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-bars"></i> Help</th>
                                    </tr>
                                </thead>
                            </table>
                            <div class="btn-group" style="margin-top:1%;margin-bottom:0.4%">
                                <span class="btn btn-sm btn-primary" onclick="tambah_help(0)"><i class="fas fa-plus"></i> Tambah</span>
                            </div>
                            <div id="tampil_help"></div>
                        </div>
                    </div>
                    
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <div class="row">
        <div class="modal fade" id="modal-help" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Help</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasihelp"></div>
                        <form class="form-horizontal form-bordered" id="mydatahelp" action="{{url('Pengaturan/help')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="id" id="id_help" >
                            <div id="form-help"></div>
                            
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-success" onclick="simpan_help()">Simpan</a>
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
        $('#tampil_help').load("{{url('Pengaturan/tampil_help')}}");
        
        

		function tambah_help(id){
            $.ajax({
                url: "{{url('Pengaturan/form_help')}}",
                type: 'GET',
                data: "id="+id,
                success: function(msg){
                    $('#modal-help').modal('show')
                    $('#id_help').val(id)
                    $('#form-help').html(msg)
                }
            });
        }
		function hapus_help(id){
            $.ajax({
                url: "{{url('Pengaturan/hapus_help')}}",
                type: 'GET',
                data: "id="+id,
                success: function(msg){
                   location.reload();
                }
            });
        }
		function simpan_help(){
            var form=document.getElementById('mydatahelp');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Pengaturan/help')}}",
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
                            location.reload();
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#notifikasihelp').html(msg);
                        }
                        
                        
                    }
                });

        } 
    </script>
@endpush
