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
                    <h4 class="mt-0 mb-1">Manual Book</h4>
                    <p class="mb-2">Aplikasi Audit Internal (SMKS)</p>
                </div>
                <!-- END profile-header-info -->
            </div>
            
        </div>
        
    </div>
    <div class="row" style="background:#fff;margin:0px 0.1%">
        <div class="col-md-12">
            <div id="tampil-file"></div>
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
        $('#tampil-file').html('<embed src="{{url_plug()}}/img/manualbook.pdf" width="100%" height="500px"  type="application/pdf">');
        

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
