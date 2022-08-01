@extends('layouts.app')

@section('content')
<div id="content" class="content">
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Form Stuff</a></li>
        <li class="breadcrumb-item active">Form Plugins</li>
    </ol>
    <h1 class="page-header">Form Plugins <small>header small text goes here...</small></h1>
    <div class="row">
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Bootstrap Date Time Picker</h4>
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
                    <form class="form-horizontal form-bordered">
                        
                        <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th width="1%"></th>
                                    <th width="1%" data-orderable="false"></th>
                                    <th class="text-nowrap">Rendering engine</th>
                                    <th class="text-nowrap">Browser</th>
                                    <th class="text-nowrap">Platform(s)</th>
                                    <th class="text-nowrap">Engine version</th>
                                    <th class="text-nowrap">CSS grade</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr class="gradeX">
                                    <td class="f-s-600 text-inverse">54</td>
                                    <td class="with-img"><img src="../assets/img/user/user-12.jpg" class="img-rounded height-30" /></td>
                                    <td>Misc</td>
                                    <td>Lynx</td>
                                    <td>Text only</td>
                                    <td>-</td>
                                    <td>X</td>
                                </tr>
                                <tr class="gradeC">
                                    <td class="f-s-600 text-inverse">55</td>
                                    <td class="with-img"><img src="../assets/img/user/user-13.jpg" class="img-rounded height-30" /></td>
                                    <td>Misc</td>
                                    <td>IE Mobile</td>
                                    <td>Windows Mobile 6</td>
                                    <td>-</td>
                                    <td>C</td>
                                </tr>
                                <tr class="gradeC">
                                    <td class="f-s-600 text-inverse">57</td>
                                    <td class="with-img"><img src="../assets/img/user/user-14.jpg" class="img-rounded height-30" /></td>
                                    <td>Misc</td>
                                    <td>PSP browser</td>
                                    <td>PSP</td>
                                    <td>-</td>
                                    <td>C</td>
                                </tr>
                                <tr class="gradeU">
                                    <td class="f-s-600 text-inverse">58</td>
                                    <td class="with-img"><img src="../assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
                                    <td>Other browsers</td>
                                    <td>All others</td>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>U</td>
                                </tr>
                            </tbody>
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
    </script>
@endpush
