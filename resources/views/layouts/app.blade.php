
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Krakatau Steel</title>
    <link rel="icon" href="{{url_plug()}}/img/fav.png" type="image/x-icon">
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/@danielfarrell/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    <!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="{{url_plug()}}/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->
    @stack('style')
	<style>
		.form-horizontal.form-bordered .form-group>div {
			padding: 0.5% !important;
		}
		.form-horizontal.form-bordered .form-group .col-form-label {
    		padding: 0px !important;
		}
		.loadnya {
			height: 100%;
			width: 0;
			position: fixed;
			z-index: 1070;
			top: 0;
			left: 0;
			background-color: rgb(41 50 80 / 79%);
			overflow-x: hidden;
			transition: transform .9s;
		}
		.loadnya-content {
			position: relative;
			top: 25%;
			width: 100%;
			text-align: center;
			margin-top: 30px;
			color:#fff;
			font-size:50px;
		}
    </style>
</head>
<body>
	<!-- begin #page-loader -->
	<div id="loadnya" class="loadnya">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="loadnya-content">
			<i class="fas fa-spinner fa-pulse"></i>
        </div>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="index.html" class="navbar-brand"><img src="{{url_plug()}}/img/ks.png"></a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header --><!-- begin header-nav -->
			<ul class="navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14" aria-expanded="false">
						<i class="fa fa-bell"></i>
						<span class="label">5</span>
					</a>
					<div class="dropdown-menu media-list dropdown-menu-right" style="">
						<div class="dropdown-header">NOTIFICATIONS (5)</div>
						<a href="javascript:;" class="dropdown-item media">
							<div class="media-body">
								<h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
								<div class="text-muted f-s-10">3 minutes ago</div>
							</div>
						</a>
						
						<div class="dropdown-footer text-center">
							<a href="javascript:;">View more</a>
						</div>
					</div>
				</li>
				<li class="dropdown navbar-user">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="{{url_plug()}}/assets/img/akun.png" alt="" /> 
						<span class="d-none d-md-inline">{{Auth::user()->name}}</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						
						@if(Auth::user()->admin==1)
							<a href="javascript:;" onclick="switch_akun(1)" class="dropdown-item"> Switch Admin</a>
						@endif
						@if(Auth::user()->auditor==1)
							<a href="javascript:;" onclick="switch_akun(2)" class="dropdown-item"> Switch Auditor</a>
						@endif
						@if(Auth::user()->auditee==1)
							<a href="javascript:;" onclick="switch_akun(3)" class="dropdown-item"> Switch Auditee</a>
						@endif
						@if(Auth::user()->lo==1)
							<a href="javascript:;" onclick="switch_akun(4)" class="dropdown-item"> Switch Lo</a>
						@endif
						@if(Auth::user()->lo==5)
							<a href="javascript:;" onclick="switch_akun(5)" class="dropdown-item"> Switch Agen</a>
						@endif
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
							{{ __('Logout') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</li>
			</ul>
			<!-- end header-nav -->
		</div>
		<!-- end #header -->
		
		<!-- begin #sidebar -->
		@include('layouts.side')
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		
		<!-- begin #content -->
		@yield('content')
		<!-- end #content -->
		
		<!-- begin theme-panel -->
		<div class="theme-panel theme-panel-lg" id="kolom-filter">
			<a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
			<div class="theme-panel-content">
				
					<div class="form-group">
						<label>Tahun</label>
						<select nama="tahun" id="tahun_cari" class="form-control">
							@for($xg=2022;$xg<2040;$xg++)
								<option value="{{$xg}}" @if(Auth::user()->tahun==$xg) selected @endif >{{$xg}}</option>
							@endfor
						</select><br>
						<span class="btn btn-primary" onclick="cari_tahun()"><i class="fas fa-search"></i> Terapkan</span>
					</div>
				
				
			</div>
		</div>
		<!-- end theme-panel -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>

	<div class="modal fade" id="modal-alert" aria-hidden="true" style="display: none;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Alert Error</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger m-b-0">
						<div id="notifikasi"></div>
					</div>
				</div>
				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="modal-chat" aria-hidden="true" style="display: none;">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Chat</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<div class="modal-body">
					<form class="form-horizontal form-bordered" onkeypress="return event.keyCode != 13;" id="mydatachat"  method="post" enctype="multipart/form-data">
						@csrf
						<label id="nom"></label>
						<input type="hidden" name="nomor_temuan" id="no_temuan">
						<div class="tabel-responsive " id="divElem" style="overflow-x:scroll;height:400px;border:solid 3px #ccccdb;">
							<div  id="tampil-chat">sss</div>

						</div>
						<div class="form-group row">
							<div class="input-group m-b-10">
								<input type="text" name="text" id="isi_chat" placeholder="ketik disini....." class="form-control">
								<div class="input-group-append"><span class="input-group-text" style="background:green;color:#fff" onclick="kirim_pesan()"><i class="fa fa-sand"></i> Kirim</span></div>
							</div>
						</div>
						
						
					</form>
				</div>
				
			</div>
		</div>
	</div>
	<!-- end page container -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="{{url_plug()}}/assets/js/app.min.js"></script>
	<script src="{{url_plug()}}/assets/js/theme/default.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="{{url_plug()}}/assets/plugins/jquery-migrate/dist/jquery-migrate.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/moment/min/moment.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
	<script src="{{url_plug()}}/assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/jquery.maskedinput/src/jquery.maskedinput.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/pwstrength-bootstrap/dist/pwstrength-bootstrap.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/@danielfarrell/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/tag-it/js/tag-it.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="{{url_plug()}}/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-show-password/dist/bootstrap-show-password.js"></script>
	<script src="{{url_plug()}}/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="{{url_plug()}}/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="{{url_plug()}}/assets/plugins/clipboard/dist/clipboard.min.js"></script>
	<script src="{{url_plug()}}/assets/js/demo/form-plugins.demo.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
    <script src="{{url_plug()}}/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="{{url_plug()}}/assets/plugins/datatables.net-fixedheader/js/dataTables.fixedheader.min.js"></script>
	<script src="{{url_plug()}}/assets/plugins/datatables.net-fixedheader-bs4/js/fixedheader.bootstrap4.min.js"></script>
	@stack('ajax')
	
    <script>
		
			
		
        function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
		function switch_akun(id){
			$.ajax({
                type: 'get',
                url: "{{url('/Pengguna/switch_akun')}}",
                data: "id="+id,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
                    location.assign("{{url('/')}}");
                    
                }
            });
			
		}
		function cari_tahun(){
			var tahun=$('#tahun_cari').val();
			$.ajax({
                type: 'get',
                url: "{{url('/cari_tahun')}}",
                data: "tahun="+tahun,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
					document.getElementById("kolom-filter").style.right = "-260px";
                    location.reload();
                    
                }
            });
			
		}
		function cari_temuan(){
			var tahun=$('#tahun_cari').val();
			$.ajax({
                type: 'get',
                url: "{{url('/cari_tahun')}}",
                data: "tahun="+tahun,
                beforeSend: function() {
                    document.getElementById("loadnya").style.width = "100%";
                },
                success: function(msg){
					document.getElementById("kolom-filter").style.right = "-260px";
                    location.reload();
                    
                }
            });
			
		}
		function chat(nomor){
			$('#nom').html('NOMOR TEMUAN : #'+nomor);
			$("#divElem").animate({ scrollTop: 1000000000 }, "slow");
			$('#tampil-chat').load("{{url('Chat')}}?nomor_temuan="+nomor);
			$('#no_temuan').val(nomor);
			$('#modal-chat').modal('show');
			

		}
		function kirim_pesan(){
            var form=document.getElementById('mydatachat');
            
                $.ajax({
                    type: 'POST',
                    url: "{{url('/Chat')}}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            $('#tampil-chat').load("{{url('Chat')}}?nomor_temuan="+bat[2]);
                            $('#isi_chat').val("");  
							$("#divElem").animate({ scrollTop: 1000000000 }, "slow");
                        }else{
                            
                        }
                        
                        
                    }
                });

        } 
    </script>
</body>
</html>