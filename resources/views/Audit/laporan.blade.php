@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Laporan Rencana Audit dan Temuan<small></small></h1>
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
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <h4 class="widget-chat-header-title"><i class="fas fa-bars"></i> Laporan Audit #{{$data->nomor}}</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-md-8">
                            
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Nomor</b></label>
                                <div class="col-lg-3">
                                    <b>:</b> {{$data->nomor}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Are</b></label>
                                <div class="col-lg-5">
                                    <b>:</b> [{{$data->kode}}] {{$data->unit['name']}}
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Auditor</b></label>
                                <div class="col-lg-11">
                                    @foreach(get_audit_auditor($data->nomor) as $get)
                                        <span class="badge bg-green f-s-12">{{$get->user['name']}}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-1 col-form-label"><b>Sistem</b></label>
                                <div class="col-lg-11">
                                    @foreach(get_audit_sistem($data->nomor) as $get)
                                        <span class="badge bg-blue f-s-12">{{$get->sistem['name']}}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                            @foreach(get_status_all() as $s)
                            <div class="form-group row">
                                <label class="col-lg-5 col-form-label" style="color: {{$s->color}};"><b>Total {{$s->name}}</b></label>
                                <div class="col-lg-4">
                                    <b>:</b> {{cek_total_status($data->nomor,$s->id)}}
                                </div>
                            </div>
                            @endforeach
                            
                        </div>
                        <div class="col-md-12" style="margin-top:2%">
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <h4 class="widget-chat-header-title"><i class="fas fa-bars"></i> Temuan</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                            <div class="table-responsive">
								<table class="table table-bordered m-b-0">
									<thead>
										<tr>
											<th width="10%">Nomor</th>
                                            <th width="10%">Status</th>
											<th>Ketidaksesuaian</th>
											<th width="10%">Mulai</th>
											<th width="10%">Sampai</th>
											<th  width="20%">Kalusal</th>
										</tr>
									</thead>
									<tbody>
                                        @foreach(get_temuan($data->nomor) as $no=>$o)
										<tr>
											<td>{{$o->nomor_temuan}}</td>
											<td style="text-align:center;font-weight:bold"><font color="{{$o->statusnya['color']}}" >{{$o->statusnya['name']}}</font></td>
											<td>{{$o->ketidaksuaian}}</td>
											<td>{{$o->tanggal}}</td>
											<td>{{$o->tanggal_sampai}}</td>
											<td>
                                                @foreach(get_sistem_temuan($o->nomor_temuan) as $get)
                                                    - {{$get->sistem['name']}} {{$get->sistemdetail['name']}}<br> 
                                                @endforeach
                                            </td>
										</tr>
										@endforeach
									</tbody>
								</table>
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
        
    </div>
</div>
@endsection

@push('ajax')
    <script>
        
    </script>
@endpush
