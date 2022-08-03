@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Temuan #{{$data->nomor_temuan}}<small></small></h1>
    <div class="invoice">
        <!-- begin invoice-company -->
        <div class="invoice-company">
            <span class="pull-right hidden-print">
                <a href="javascript:;"  onclick="location.assign(`{{url('Temuan')}}`)" class="btn btn-sm btn-white m-b-10"><i class="fa fa-reply t-plus-1 text-danger fa-fw fa-lg"></i> Kembali</a>
                <a href="javascript:;"  onclick="chat(`{{$data->nomor_temuan}}`)" class="btn btn-sm btn-white m-b-10"><i class="fas fa-envelope t-plus-1 text-danger fa-fw fa-lg"></i> Feedback</a>
                <a href="javascript:;" class="btn btn-sm btn-white m-b-10"><i class="fa fa-file-pdf t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
                <a href="javascript:;" onclick="window.print()" class="btn btn-sm btn-white m-b-10"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
            {{$data->unit['name']}}
        </div>
        
        <div class="invoice-header">
            <div class="invoice-from">
                <small></small>
                <address class="m-t-5 m-b-5">
                    <strong class="text-inverse">Auditor</strong><br>
                    @foreach(get_audit_auditor($data->nomor) as $get)
                        &nbsp;-{{$get->user['name']}}<br>
                    @endforeach
                    
                </address>
            </div>
            <div class="invoice-to">
                <small></small>
                <address class="m-t-5 m-b-5">
                    <strong class="text-inverse">Lo</strong><br>
                    @foreach(get_lo($data->kode) as $get)
                       &nbsp;-{{$get->user['name']}}<br>
                    @endforeach
                </address>
            </div>
            <div class="invoice-date">
                <small>Temuan Perode {{bulan($data->bulan)}} {{$data->tahun}}</small>
                <div class="date text-inverse m-t-5">{{$data->tanggal}}</div>
                <div class="invoice-detail">
                    #{{$data->nomor_temuan}}<br>
                    PT.Krakatau Steel
                </div>
            </div>
        </div>
        <!-- end invoice-header -->
        <!-- begin invoice-content -->
        <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive" style="margin:1%">
                <table class="table table-invoice">
                    <thead>
                        <tr>
                            <th>KETIDAK SESUAIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="text-inverse">{!! $data->ketidaksuaian !!}</span><br>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="row" style="margin:1%">
                
                <div class="col-md-12 form-horizontal form-bordered">
                    <input type="hidden" name="id" value="{{$id}}">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b>Lingkup & Klausal</b></label>
                        <div class="col-lg-5">
                            Lingkup
                        </div>
                        <div class="col-lg-5">
                            Klausal
                        </div>
                    </div>
                    <div class="form-group row" style="background: #f5f5ff;">
                        <label class="col-lg-2 col-form-label"><b></b></label>
                        <div class="col-lg-5">
                            @foreach(get_sistem_audit($data->nomor) as $stm)
                                &nbsp;&nbsp;-{{$stm->sistem['name']}}<br>
                            @endforeach
                        </div>
                        <div class="col-lg-5">
                             @foreach(get_sistem_temuan($data->nomor_temuan) as $stm)
                                &nbsp;&nbsp;-{{$stm->sistem['name']}} {{$stm->sistemdetail['name']}}<br>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b>Create By</b></label>
                        <div class="col-lg-3">
                            <b>: {{$data->user['name']}}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b>Tanggal Audit</b></label>
                        <div class="col-lg-5">
                            <b>: {{$data->tanggal}}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b>Tanggal Target:</b></label>
                        <div class="col-lg-5">
                            <b>: {{$data->tanggal_sampai}}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b>Status</b></label>
                        <div class="col-lg-5">
                            <b>: {!! nama_status($data->status) !!}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b>File</b></label>
                        <div class="col-lg-10">
                            Lampiran
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label"><b></b></label>
                        <div class="col-lg-8">
                                 <table class="table table-striped">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="5%">No</th>
                                        <th >File</th>
                                    </tr>
                                    @foreach(get_temuan_file($data->nomor_temuan) as $x=>$file)
                                    <tr>
                                        <td>{{$x+1}}</td>
                                        <td><span class="btn btn-xs btn-warning" onclick="lihat_file(`{{$file->file}}`)"><i class="fas fa-file-pdf"></i></span></td>
                                        <td>{{$file->file}}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
                @if($data->status>=5)
                    <hr>
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom:0%;padding:1%">
                            <div class="panel panel-inverse">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Penyebab</h4>
                                    <div class="panel-heading-btn">
                                    </div>
                                </div>
                                <div class="panel-body p-t-10" style="border: solid 1px #8c8c9f;">
                                    <div class="row row-space-10">
                                        <div class="col-md-12">
                                        <textarea class="form-control" disabled rows="7">{{$data->penyebab}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom:0%;padding:1%">
                            <div class="panel panel-inverse" >
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Perbaikan</h4>
                                    <div class="panel-heading-btn">
                                        
                                    </div>
                                </div>
                                <div class="panel-body p-t-10" style="border: solid 1px #8c8c9f;">
                                    <div class="row row-space-10">
                                        <div class="col-md-12">
                                            <textarea class="form-control" disabled rows="7">{{$data->perbaikan}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="margin-bottom:0%;padding:1%">
                            <div class="panel panel-inverse" >
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Review</h4>
                                    <div class="panel-heading-btn">
                                   
                                    </div>
                                </div>
                                <div class="panel-body p-t-10" style="border: solid 1px #8c8c9f;">
                                    <div class="row row-space-10">
                                        <div class="col-md-12">
                                            <textarea class="form-control"  disabled rows="7">{{$data->review}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($data->status_revisi==0 || $data->status_revisi==1 || $data->status_revisi==2)

                        @else
                            <div class="col-md-12">
                                <table class="table table-invoice">
                                    <thead>
                                        <tr>
                                            <th>TINDAK LANJUT</th>
                                        </tr>
                                    </thead>
                                    
                                </table>
                                <div class="col-md-12 form-horizontal form-bordered" style="margin-bottom:2%">
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>Input Penyebab</b></label>
                                        <div class="col-lg-3">
                                            <b>: {{$data->tanggal_penyebab}}</b>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>Tanggal Audit</b></label>
                                        <div class="col-lg-5">
                                            <b>: {{$data->tanggal}}</b>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b>File Evidence</b></label>
                                        <div class="col-lg-10">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><b></b></label>
                                        <div class="col-lg-10">
                                            <div id="tampil-file-evidence" ></div>
                                        </div>
                                    </div>
                                    @if($data->status==6)
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label"><b>Tanggal Close</b></label>
                                            <div class="col-lg-5">
                                                <b>: {{$data->tanggal_close}}</b>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                
                                                  
                            </div>
                        @endif
                    </div>
                @endif
                
            </div>
        </div>
        
        <!-- end invoice-footer -->
    </div>
    <div class="row">
        
        <div class="modal fade" id="modal-isian" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="labelnyaa"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="tampil-file"></div>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-evidence" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Verifikasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-yellow fade show"><b>Verifikasi Evidence!</b><br>Harap pastikan bawah hasil evidence sesuai ketidaksesuaian.</div>
                        <div id="notifikasievidence"></div>
                        <form class="form-horizontal form-bordered" id="mydataverifikasievidence"  method="post" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"><b>Status Verifikasi</b></label>
                                <div class="col-lg-9">
                                    <select name="status" class="form-control">
                                        <option value="">Pilih </option>
                                        <option value="6">Close </option>
                                        <option value="5">Tolak </option>
                                    </select>
                                </div>
                               
                            </div>
                            
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="evidence()" >Verifikasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-review" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="labelnyaa"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasireview"></div>
                        <form class="form-horizontal form-bordered" id="mydatareview"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <div class="form-group">
                                <label class="col-lg-3 col-form-label"><b>Status Verifikasi</b></label>
                                
                                    <select name="status"  class="form-control">
                                        <option value="">Pilih </option>
                                        <option value="2">Setujui </option>
                                        <option value="0">Tolak </option>
                                    </select>
                               
                               
                            </div>
                            <div class="form-group">
                                <label>Review</label>
                                <textarea class="form-control" name="review" rows="6" placeholder="ketik disini.....">{{$data->review}}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="simpan_review()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>  
        
        <div class="modal fade" id="modal-publish" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Verifikasi Publish</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="note note-warning note-with-right-icon m-b-15">
                            <div class="note-content text-right">
                                <h4><b>Verifikasi!</b></h4>
                                <p>
                                    Nomor Temuan #{{$data->nomor_temuan}} yakin untuk dipublish?
                                </p>
                            </div>
                            <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="publish({{$data->nomor_temuan}})" >Verifikasi</a>
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
        $('#tampil-file-evidence').load("{{url('Temuan/tampil_file_evidence')}}?nomor_temuan={{$data->nomor_temuan}}");
        $('#tampil_sistem').load("{{url('Temuan/sistem')}}?nomor_temuan={{$data->nomor_temuan}}");
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
        function verifikasi_evidence(){
            $('#modal-evidence').modal('show');
        }
        function tambah_review(name){
            $('#labelnyaa').html(name);
            $('#modal-review').modal('show');
        }
		function tambah_isian(name){
            $('#labelnyaa').html(name);
            $('#modal-isian').modal('show');
        }
		function verifikasi_publish(){
            $('#modal-publish').modal('show');
        }
		function lihat_file(file){
            $('#modal-isian').modal('show');

            $('#tampil-file').html('<embed src="{{url_plug()}}/file/'+file+'" width="100%" height="480"  type="application/pdf">');
                  
        }
        function simpan_review(){
            var form=document.getElementById('mydatareview');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/review')}}",
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
							$('#notifikasireview').html(msg);
                        }
                        
                        
                    }
                });

        } 
        function evidence(){
            var form=document.getElementById('mydataverifikasievidence');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/evidence')}}",
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
							$('#notifikasievidence').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function publish(nomor_temuan){
            $.ajax({
                url: "{{url('Temuan/publish')}}",
                type: 'GET',
                data: "nomor_temuan="+nomor_temuan,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    location.assign("{{url('Temuan')}}");
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
