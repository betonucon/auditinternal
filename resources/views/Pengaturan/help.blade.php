@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <div class="profile">
        <div class="profile-header">
            <div class="profile-header-cover"></div>
            <div class="profile-header-content" style="padding: 1%;">
                <!-- <div class="profile-header-img">
                    <img src="{{url_plug()}}/assets/img/user/user-13.jpg" alt="">
                </div> -->
                <div class="profile-header-info">
                    <h4 class="mt-0 mb-1">Call Center (Auditor & Lo)</h4>
                    <p class="mb-2">Aplikasi Audit Internal (SMKS)</p>
                </div>
                <!-- END profile-header-info -->
            </div>
            
        </div>
        
    </div>
    <div class="row" style="background:#fff;margin:0px 0.1%">
        <div class="col-md-8"  style="padding:2%">
            <label><b><i class="fas fa-bars"></i> CALL CENTER</b></label>
            <div class="widget-list widget-list-rounded m-b-30" data-id="widget">
                @foreach($data as $o)
                <div class="widget-list-item">
                    <div class="widget-list-media">
                        <img src="{{url_plug()}}/img/call.png" alt="" class="rounded">
                    </div>
                    <div class="widget-list-content">
                        <h4 class="widget-list-title">{{$o->name}}</h4>
                        <p class="widget-list-desc">{{$o->nomor}}</p>
                    </div>
                    
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4" style="padding:2%">
            <div class="widget-map widget-map-rounded m-b-30" data-id="widget">
                <label><b><i class="fas fa-bars"></i> LOKASI</b></label>
                <div class="widget-map-body">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.8868457332323!2d106.03215731201438!3d-6.010271983762023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4190286dc6a351%3A0x47470dc5881075de!2sPT.%20Krakatau%20Steel%20Persero%20Tbk!5e0!3m2!1sid!2sid!4v1659434814458!5m2!1sid!2sid" width="100%" height="300px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
