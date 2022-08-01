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
                @if($data->status>2 && $data->status!=4)
                    <hr>
                    <div class="row">
                        <div class="col-md-4" style="margin-bottom:0%;padding:1%">
                            <div class="panel panel-inverse">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Penyebab</h4>
                                    <div class="panel-heading-btn">
                                    @if($data->status==3)
                                        <a href="javascript:;" onclick="tambah_penyebab(`Penyebab`)" class="btn btn-xs btn-danger"><i class="fas fa-pencil-alt"></i> Isi Penyebab</a>
                                    @endif
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
                            <div class="panel panel-inverse">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Perbaikan</h4>
                                    <div class="panel-heading-btn">
                                    @if($data->status==3)
                                        <a href="javascript:;" class="btn btn-xs btn-danger" onclick="tambah_perbaikan(`Perbaikan`)"><i class="fas fa-pencil-alt"></i> Isi Perbaikan</a>
                                    @endif
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
                            <div class="panel panel-inverse">
                                <div class="panel-heading ui-sortable-handle">
                                    <h4 class="panel-title">Penyebab</h4>
                                    <div class="panel-heading-btn">
                                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body p-t-10" style="border: solid 1px #8c8c9f;">
                                    <div class="row row-space-10">
                                        <div class="col-md-12">
                                            <textarea class="form-control" rows="7">{{$data->tanggapan}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12" style="margin-top:3%;margin-bottom:0%;background: #e2e2fd; text-align: center;padding:1%">
                        @if($data->status==2)
                        <div class="btn-group" >
                            <span class="btn btn-sm btn-primary" onclick="verifikasi_publish()">Verifikasi Temuan</span>
                            
                        </div>
                        
                        @endif
                        @if($data->status==3)
                        <div class="btn-group" >
                            @if($data->penyebab!="" && $data->perbaikan!="")
                            <span class="btn btn-sm btn-primary" onclick="verifikasi_onprogres()">Kirim keauditor</span>
                            @else
                            <i><b>Isi penyebab dan perbaikan</b></i>
                            @endif
                        </div>
                        @endif
                        @if($data->status==4)
                            <i><b>Alasan</b></i><br>
                        "{{$data->alasan_penolakan}}" 
                        @endif
                        
                        @if($data->status==5)
                            <i><b>Proses review auditor</b></i>
                        @endif
                    </div>
                </div>
               
                
                
            </div>
        </div>
        
        <!-- end invoice-footer -->
    </div>
    <div class="row">
        
        <div class="modal fade" id="modal-penyebab" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="labelnyaa"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasipenyebab"></div>
                        <form class="form-horizontal form-bordered" id="mydatapenyebab"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <div class="form-group">
                                <label>Penyebab</label>
                                <textarea class="form-control" name="penyebab" rows="6" placeholder="ketik disini.....">{{$data->penyebab}}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="simpan_penyebab()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>  
        <div class="modal fade" id="modal-perbaikan" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="labelnyaa2"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasiperbaikan"></div>
                        <form class="form-horizontal form-bordered" id="mydataperbaikan"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <div class="form-group">
                                <label>Perbaikan</label>
                                <textarea class="form-control" name="perbaikan" rows="6" placeholder="ketik disini.....">{{$data->perbaikan}}</textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="simpan_perbaikan()">Simpan</a>
                    </div>
                </div>
            </div>
        </div>  
    
        
        <div class="modal fade" id="modal-publish" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Verifikasi Temuan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div id="notifikasiverifikasi"></div>
                        <form class="form-horizontal form-bordered" id="mydataverifikasi"  method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="nomor_temuan" value="{{$data->nomor_temuan}}">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label"><b>Status Verifikasi</b></label>
                                <div class="col-lg-5">
                                    <select name="status" onchange="pilih_status(this.value)" class="form-control">
                                        <option value="">Pilih </option>
                                        <option value="3">Setujui </option>
                                        <option value="4">Tolak </option>
                                    </select>
                                </div>
                               
                            </div>
                            <div class="form-group row" id="setujui">
                                <label class="col-lg-3 col-form-label"><b>Alasan Menolak</b></label>
                                <div class="col-lg-9">
                                    <textarea disabled rows="3" class="form-control"></textarea>
                                </div>
                               
                            </div>
                            <div class="form-group row" id="tolak">
                                <label class="col-lg-3 col-form-label"><b>Alasan Menolak</b></label>
                                <div class="col-lg-9">
                                    <textarea name="alasan_penolakan" placeholder="Ketik disini...." rows="3" class="form-control"></textarea>
                                </div>
                               
                            </div>
                        </form>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="publish()" >Verifikasi</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modal-onprogres" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Verifikasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="note note-warning note-with-right-icon m-b-15">
                            <div class="note-content text-right">
                                <h4><b>Verifikasi!</b></h4>
                                <p>
                                    Nomor Temuan #{{$data->nomor_temuan}} selesai dilakukan pengisian penyebab, yakin akan dikirim keauditor?
                                </p>
                            </div>
                            <div class="note-icon"><i class="fa fa-lightbulb"></i></div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="onprogres({{$data->nomor_temuan}})" >Verifikasi</a>
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

        $('#setujui').show();
        $('#tolak').hide();

        function tambah_penyebab(name){
            $('#labelnyaa').html(name);
            $('#modal-penyebab').modal('show');
        }
        function tambah_perbaikan(name){
            $('#labelnyaa2').html(name);
            $('#modal-perbaikan').modal('show');
        }
        function pilih_status(id){
            if(id==4){
                $('#setujui').hide();
                $('#tolak').show();
            }else{
                $('#setujui').show();
                $('#tolak').hide();
            }
        }


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
        
        function onprogres(nomor_temuan){
            $.ajax({
                url: "{{url('Temuan/onprogres')}}",
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
		function verifikasi_publish(){
            $('#modal-publish').modal('show');
        }
		function verifikasi_onprogres(){
            $('#modal-onprogres').modal('show');
        }
		function lihat_file(file){
            $('#modal-file').modal('show');

            $('#tampil-file').html('<embed src="{{url_plug()}}/file/'+file+'" width="100%" height="480"  type="application/pdf">');
                  
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
		function publish(){
            var form=document.getElementById('mydataverifikasi');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/open')}}",
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
							$('#notifikasiverifikasi').html(msg);
                        }
                        
                        
                    }
                });

        } 
		function simpan_penyebab(){
            var form=document.getElementById('mydatapenyebab');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/penyebab')}}",
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
							$('#notifikasipenyebab').html(msg);
                        }
                        
                        
                    }
                });

        } 
        function simpan_perbaikan(){
            var form=document.getElementById('mydataperbaikan');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/perbaikan')}}",
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
							$('#notifikasiperbaikan').html(msg);
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
