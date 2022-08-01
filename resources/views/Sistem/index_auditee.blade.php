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
					
					responsive: false,
					ajax:"{{ url('Sistem/get_data')}}",
					columns: [
						{ data: 'id', render: function (data, type, row, meta) 
							{
								return '<input type="checkbox" name="id[]" value="'+data+'" >';
							} 
						},
                        { data: 'action' },
                        { data: 'act' },
						{ data: 'name' },
						{ data: 'deskripsi' },
						
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
    <h1 class="page-header">Data Sistem<small></small></h1>
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
                    <div class="btn-group" style="margin-bottom:2%">
                        <button class="btn btn-primary active text-white" onclick="tambah(0)"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <form class="form-horizontal form-bordered" id="mydata" action="{{url('/produk')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="idkey">
                        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="8%"></th>
                                    <th width="9%">Detail</th>
                                    <th width="20%">Sistem</th>
                                    <th >Deskripsi</th>
                                </tr>
                            </thead>
                            
                        </table>



                    </form>
                </div>
                <!-- end panel-body -->
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

        function tambah(id){
            location.assign("{{url('Sistem/form')}}?id="+id)
        }
        function ceklis(id){
            $('#idkey').val(id);
        }
        function ubah(){
            var id=$('#idkey').val();
            if(id==''){
                alert('Ceklis data yang akan diubah');
            }else{
                location.assign("{{url('Sistem/form')}}?id="+id)
            }
            
        }

        function hapus(id){
            
                $.ajax({
                    type: 'get',
                    url: "{{url('/Sistem/hapus')}}",
                    data: "id="+id,
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
