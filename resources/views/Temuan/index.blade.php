@extends('layouts.app')
@push('style')
	<style>
		.ttdr{
			text-transform:uppercase;
			font-family: sans-serif;
		}
		.bold{
			font-weight:bold;
		}
        .table-td-valign-middle td, .table-th-valign-middle th, .table-valign-middle td, .table-valign-middle th {
            vertical-align: top !important;
        }
	</style>
@endpush
@push('ajax')
<script>
		/*
		Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
		Version: 4.6.0
		Author: Sean Ngu
		Website: http://www.seantheme.com/color-admin/admin/
		*/

		var handleDataTableFixedHeader = function() {
			"use strict";
			
			if ($('#data-table-fixed-header').length !== 0) {
				var table=$('#data-table-fixed-header').DataTable({
					fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
					ordering:false,
					responsive: false,
					ajax:"{{ url('Temuan/get_data')}}",
					columns: [
						{ data: 'DT_RowIndex', render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        } },
                        { data: 'action' },
                        { data: 'temuan' },
                        { data: 'unit_kerja' },
                        { data: 'textnya' },
						{ data: 'auditor' },
						{ data: 'sistem' },
						
					],
					
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
				});
				
				
			}
		};

		var TableManageFixedHeader = function () {
			"use strict";
			return {
				//main function
				init: function () {
					handleDataTableFixedHeader();
				}
			};
		}();

		$(document).ready(function() {
			TableManageFixedHeader.init();
		});


		
	</script>
@endpush
@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Data Temuan {{tahun()}}<small></small></h1>
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
                    <div class="row">
                        <div class="col-md-4">
                        <div style="width:100%;background:#e3e3e9;padding:5px;margin-bottom:1%;margin-top:1%">
                        <div class="btn-group btn-group-justified">
                            <a class="btn btn-success btn-sm text-white" onclick="tambah(0)"><i class="fas fa-plus"></i> Buat Baru</a>
                            <a class="btn btn-success btn-sm text-white"  data-toggle="modal" data-target="#modal-cari-temuan" ><i class="fas fa-filter"></i> Filter</a>
                            <a class="btn btn-success btn-sm  text-white" onclick="location.assign(`{{url('Temuan/export_excel')}}`)"><i class="fas fa-file-excel"></i> Export To Excel</a>
                        </div>
                    </div>
                        </div>
                        <div class="col-md-8">
                            <form class="form-horizontal form-bordered">
                                @foreach(get_status() as $s)
                                    <div class="form-group row">
                                        <label class="col-lg-2 col-form-label"><span class="badge bg-{{$s->color}} f-s-11">{{$s->name}}</span></label>
                                        <div class="col-lg-10" style="padding: 0px !important;">
                                            {{$s->keterangan}}
                                        </div>
                                    </div>
                                @endforeach
                            </form>
                        </div>
                    </div>
                   
                    <form class="form-horizontal form-bordered" action="{{url('/produk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idkey">
                        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="8%"></th>
                                    <th  width="10%">Temuan</th>
                                    <th  width="15%">Area</th>
                                    <th  width="20%">Ketidaksuaian</th>
                                    <th class="text-nowrap">Auditor</th>
                                    <th class="text-nowrap">Klausul/Kriteria/Elemen</th>
                                </tr>
                            </thead>
                            
                        </table>



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
                        <form class="form-horizontal form-bordered" id="mydata" action="{{url('Pengguna')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="0">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Audit</label>
                                <div class="col-lg-9">
                                    <select class="default-select2 form-control" id="nomor" name="nomor">
										
                                            <option value=""> Pilih Audit</option>
                                            @foreach(get_audit_temuan() as $unit)
                                                <option value="{{$unit->nomor}}"> - [{{$unit->nomor}}] {{$unit->audit->unit['name']}} Periode : {{$unit->audit->periode['name']}}</option>
                                            @endforeach
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Tanggal Mulai & Sampai</label>
                                <div class="col-lg-3">
                                    <div class="input-group date" id="pilihtanggal">
                                        <input type="text" name="tanggal"  class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group date" id="pilihtanggal1">
                                        <input type="text" name="tanggal_sampai"  class="form-control">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
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

        <div class="modal fade" id="modal-cari-temuan" aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Parameter</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal form-bordered" onkeypress="return event.keyCode != 13;" id="mydatafilter"  method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Tahun</label>
                                <div class="col-lg-4">
                                    <select name="tahun"  class="form-control">
                                        @for($xg=2022;$xg<2040;$xg++)
                                            <option value="{{$xg}}" @if(Auth::user()->tahun==$xg) selected @endif >{{$xg}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Unit Kerja</label>
                                <div class="col-lg-9">
                                    <select name="kode"  class="form-control">
                                        <option value="all"  @if(filter_kode()=='all') selected @endif >Semua Unit</option>
                                        @foreach(get_unit_auditor() as $kd)
                                            <option value="{{$kd->audit['kode']}}" @if(filter_kode()==$kd->audit['kode']) selected @endif >{{$kd->audit->unit['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label">Status Temuan</label>
                                <div class="col-lg-9">
                                    <select name="status"  class="form-control">
                                        <option value="all"   @if(filter_status()=='all') selected @endif >Semua Status</option>
                                        @foreach(get_status_all() as $kd)
                                            <option value="{{$kd->id}}"  @if(filter_status()==$kd->id) selected @endif >{{$kd->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                        <a href="javascript:;" class="btn btn-blue" onclick="terapkan()" >Terapkan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $('#data-table-default').DataTable({
			responsive: true
		});
        $('#pilihtanggal').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        $('#pilihtanggal1').datepicker({
			format:"yyyy-mm-dd",
			autoclose :true,
		});
        function tambah(id){
            $('#modal-form').modal('show');
        }
        function detail(username,role_id){
            location.assign("{{url('Temuan/detail')}}?nik="+username+"&role_id="+role_id)
        }
        function ceklis(id){
            $('#idkey').val(id);
        }
        function ubah(){
            var id=$('#idkey').val();
            if(id==''){
                alert('Ceklis data yang akan diubah');
            }else{
                location.assign("{{url('Temuan/form')}}?id="+id)
            }
            
        }

        function hapus(id){
            
                $.ajax({
                    type: 'get',
                    url: "{{url('/Temuan/hapus')}}",
                    data: "id="+id,
                    beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
                    success: function(msg){
                        
                            location.reload();
                        
                        
                    }
                });

        } 

        function simpan_data(){
            var form=document.getElementById('mydata');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/create')}}",
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
                            location.assign("{{url('Temuan/form')}}?id="+bat[2]);
                               
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
							$('#notifikasierror').html(msg);
                        }
                        
                        
                    }
                });

        } 
        function terapkan(){
            var form=document.getElementById('mydatafilter');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Temuan/filter')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
						document.getElementById("loadnya").style.width = "100%";
					},
                    success: function(msg){
                        location.reload();
                        
                    }
                });

        } 
    </script>
@endpush
