    <div>
        <canvas id="bar-chart" data-render="chart-js"></canvas>
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

    

    var barChartData = {
        labels: [
            @foreach(get_unit_dashboard() as $no=>$unit)
                '{{$unit->name}}',
            @endforeach
        ],
        datasets: [{
            label: 'Total',
            borderWidth: 2,
            borderColor: "blue",
            backgroundColor: "blue",
            data: [
                @foreach(get_unit_dashboard() as $no=>$unit)
                    {{total_temuan($unit->kode,$tahun,0)}},
                @endforeach
            ]
        }, {
            label: 'Close',
            borderWidth: 2,
            borderColor: "green",
            backgroundColor: "green",
            data: [
                @foreach(get_unit_dashboard() as $no=>$unit)
                    {{total_temuan($unit->kode,$tahun,6)}},
                @endforeach
            ]
        }, {
            label: 'Outstanting',
            borderWidth: 2,
            borderColor: "red",
            backgroundColor: "red",
            data: [
                @foreach(get_unit_dashboard() as $no=>$unit)
                    {{total_temuan($unit->kode,$tahun,7)}},
                @endforeach
            ]
        }]
    };

    

    var handleChartJs = function() {
       
        var ctx2 = document.getElementById('bar-chart').getContext('2d');
        var barChart = new Chart(ctx2, {
            type: 'bar',
            data: barChartData
        });

        
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