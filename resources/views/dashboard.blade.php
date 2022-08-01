    <style>
        .tthh{
            font-size:12px;
            padding:4px !important; 
            text-align:center;
            font-family: 'Font Awesome 5 Free';
            background:blue;
            color:#fff;
        }
        .ttdd{
            font-size:12px;
            padding:4px !important; 
            text-align:center;
            font-family: 'Font Awesome 5 Free';
        }
    </style>
    <table class="table table-bordered m-b-0" style="width:130%">
        <thead>
            <tr>
                <th rowspan="2" class="tthh" width="3%">No</th>
                <th  rowspan="2" class="tthh">Area</th>
                <th class="tthh" colspan="4">Temuan</th>
                @foreach(get_sistem() as $sis)
                     <th class="tthh" colspan="3">{{$sis->name}}</th>
                @endforeach
                <th class="tthh" colspan="4">Total</th>
            </tr>
            <tr>
                <th class="tthh"  width="3%">T</th>
                <th class="tthh"  width="3%">C</th>
                <th class="tthh"  width="3%">O</th>
                <th class="tthh"  width="3%">%</th>
                @foreach(get_sistem() as $sis)
                    <th class="tthh"  width="3%">T</th>
                    <th class="tthh"  width="3%">C</th>
                    <th class="tthh"  width="3%">O</th>
                @endforeach
                <th class="tthh"  width="3%">T</th>
                <th class="tthh"  width="3%">C</th>
                <th class="tthh"  width="3%">O</th>
                <th class="tthh"  width="3%">%</th>
            </tr>
        </thead>
        <tbody>
            @foreach(get_unit_dashboard() as $no=>$unit)
                <tr>
                    <td class="ttdd">{{$no+1}}</td>
                    <td class="ttdd" style="text-align:left">{{$unit->name}}</td>
                    <td class="ttdd">{{total_temuan($unit->kode,$tahun,0)}}</td>
                    <td class="ttdd">{{total_temuan($unit->kode,$tahun,6)}}</td>
                    <td class="ttdd">{{total_temuan($unit->kode,$tahun,7)}}</td>
                    <td class="ttdd">{{persen_total_temuan($unit->kode,$tahun)}}</td>
                    @foreach(get_sistem() as $sis)
                    <td class="ttdd">{{total_temuan_sistem($unit->kode,$tahun,$sis->id,0)}}</td>
                    <td class="ttdd">{{total_temuan_sistem($unit->kode,$tahun,$sis->id,6)}}</td>
                    <td class="ttdd">{{total_temuan_sistem($unit->kode,$tahun,$sis->id,7)}}</td>
                    @endforeach
                    <td class="ttdd">{{total_all_temuan_sistem($unit->kode,$tahun,0)}}</td>
                    <td class="ttdd">{{total_all_temuan_sistem($unit->kode,$tahun,6)}}</td>
                    <td class="ttdd">{{total_all_temuan_sistem($unit->kode,$tahun,7)}}</td>
                    <td class="ttdd">{{persen_total_temuan_sistem($unit->kode,$tahun)}}</td>
                </tr>
            @endforeach
            <tr>
                <td class="ttdd"></td>
                <td class="ttdd" style="text-align:left"></td>
                <td class="ttdd">{{rekap_total_temuan($tahun,0)}}</td>
                <td class="ttdd">{{rekap_total_temuan($tahun,6)}}</td>
                <td class="ttdd">{{rekap_total_temuan($tahun,7)}}</td>
                <td class="ttdd">{{rekap_persen_total_temuan($tahun)}}</td>
                @foreach(get_sistem() as $sis)
                <td class="ttdd">{{rekap_total_temuan_sistem($tahun,$sis->id,0)}}</td>
                <td class="ttdd">{{rekap_total_temuan_sistem($tahun,$sis->id,6)}}</td>
                <td class="ttdd">{{rekap_total_temuan_sistem($tahun,$sis->id,7)}}</td>
                @endforeach
                <td class="ttdd">{{rekap_total_all_temuan_sistem($tahun,0)}}</td>
                <td class="ttdd">{{rekap_total_all_temuan_sistem($tahun,6)}}</td>
                <td class="ttdd">{{rekap_total_all_temuan_sistem($tahun,7)}}</td>
                <td class="ttdd">{{rekap_persen_total_temuan_sistem($tahun)}}</td>
            </tr>
        </tbody>
    </table>