<div class="row">
    @foreach(get_sistem() as $sis)
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
                                    <h4 class="widget-chat-header-title"><i class="fas fa-bars"></i> {{$sis->name}}</h4>
                                    <p class="widget-chat-header-desc"></p>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <canvas id="bar-chart{{$sis->id}}" data-render="chart-js"></canvas>
							</div>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
    @endforeach
</div>
<script src="{{url_plug()}}/assets/plugins/chart.js/dist/Chart.min.js"></script>
    <script src="{{url_plug()}}/assets/js/demo/chart-js.demo.js"></script>
    <script>
        /*
    Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
    Version: 4.6.0
    Author: Sean Ngu
    Website: http://www.seantheme.com/color-admin/admin/
    */

    Chart.defaults.global.defaultFontColor = COLOR_DARK;
    Chart.defaults.global.defaultFontFamily = FONT_FAMILY;
    Chart.defaults.global.defaultFontStyle = FONT_WEIGHT;

    var randomScalingFactor = function() { 
        return Math.round(Math.random()*100)
    };

    
    @foreach(get_sistem() as $sis)
        var barChartData{{$sis->id}} = {
            labels: [
                @foreach(get_klausul_all($sis->id) as $no=>$unit)
                    '{{$unit->name}}',
                @endforeach
            ],
            datasets: [{
                label: 'Total',
                borderWidth: 2,
                borderColor: "{{$sis->color}}",
                backgroundColor: "{{$sis->color}}",
                data: [
                    @foreach(get_klausul_all($sis->id) as $no=>$unit)
                        {{rekap_total_temuan_sistem_detail($unit->id)}},
                    @endforeach
                ]
            }]
        };

    
    @endforeach
    var handleChartJs = function() {
        @foreach(get_sistem() as $sis)
            var ctx2 = document.getElementById('bar-chart{{$sis->id}}').getContext('2d');
            var barChart = new Chart(ctx2, {
                type: 'bar',
                data: barChartData{{$sis->id}}
            });
        @endforeach
        
    };

    var ChartJs = function () {
        "use strict";
        return {
            //main function
            init: function () {
                handleChartJs();
            }
        };
    }();

    $(document).ready(function() {
        ChartJs.init();
    });
    </script>