@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">{{$menu}}</li>
    </ol>
    <h1 class="page-header">Dashboard<small></small></h1>
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
                            <img src="{{url_plug()}}/img/ks.png" width="100%" alt="" /> 
                        </div>
                        <div class="col-md-8 form-horizontal form-bordered">
                            @foreach(get_status() as $s)
                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label"><span class="badge bg-{{$s->color}} f-s-11">{{$s->name}}</span></label>
                                    <div class="col-lg-10" style="padding: 0px !important;">
                                        {{$s->keterangan}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-md-2">
                            <h4 class="widget-chat-header-title">Periode {{tahun()}}</h4>
                        </div>
                        <div class="col-md-9">
                            <hr style="border-top: double 3px #938f8f;">
                        </div>
                        <div class="col-md-1">
                        <a class="btn btn-success btn-sm text-white"  data-click="theme-panel-expand" ><i class="fas fa-filter"></i> Filter</a>
                        </div>
                    </div>
                    <form class="form-horizontal form-bordered" id="mydata" action="{{url('Barangmasuk')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom:1%">
                        <div class="col-md-12" style="margin-top:2%">
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                            <div class="table-responsive">
								<div id="tampil_dashboard"></div>
							</div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
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
                        <div class="col-md-12" style="margin-top:2%">
                            <div class="widget-chat-header">
                                <div class="widget-chat-header-content">
                                    <h4 class="widget-chat-header-title"><i class="fas fa-bars"></i> Grafik</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                            <div class="table-responsive">
								<div id="tampil_dashboard_grafik"></div>
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
        <div id="tampil_dashboard_sistem"></div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
       
        $.ajax({
            url: "{{url('tampil_dashboard')}}",
            type: 'GET',
            data: "tahun={{$tahun}}",
            beforeSend: function() {
                $('#tampil_dashboard').load("{{url('tampil_loading')}}");
            },
            success: function(msg){
                $('#tampil_dashboard').html(msg);
            }
        });

        $('#tampil_dashboard_grafik').load("{{url('tampil_grafik')}}");
        $('#tampil_dashboard_sistem').load("{{url('tampil_dashboard_sistem')}}");
    </script>
@endpush
