<style>
    th{
        background:blue;
        color:#fff;
    }
</style>
<table border="2px">
    <thead>
        <tr>
            <th bgcolor="aqua">No</th>
            <th bgcolor="aqua" width="100px">Nomor Temuan</th>
            <th bgcolor="aqua" width="100px">Audit</th>
            <th bgcolor="aqua" width="250px">Area</th>
            <th bgcolor="aqua" width="400px">Ketidaksuaian</th>
            <th bgcolor="aqua" width="100px">Mulai</th>
            <th bgcolor="aqua" width="100px">Target</th>
            <th bgcolor="aqua" width="100px">Status</th>
            <th bgcolor="aqua" width="200px">Auditor</th>
            <th bgcolor="aqua" width="400px">Sistem</th>
            <th bgcolor="aqua" width="500px">Klausal</th>
        </tr>
    </thead>
    <tbody>
        @foreach(get_view() as $no=>$o)
        <tr>
            <td>{{$no+1}}</td>
            <td>{{$o->nomor_temuan}}</td>
            <td>{{$o->nomor}}</td>
            <td>{{$o->area}}</td>
            <td>{{$o->ketidaksuaian}}</td>
            <td>{{$o->mulai}}</td>
            <td>{{$o->target}}</td>
            <td>{{$o->statusnya}}</td>
            <td>
                @foreach(get_audit_auditor($o->nomor) as $get)
                    {{$get->user['name']}},
                @endforeach
            </td>
            <td>
                @foreach(get_audit_sistem($o->nomor) as $get)
                    {{$get->sistem['name']}},
                @endforeach
            </td>
            <td>
                @foreach(get_sistem_temuan($o->nomor_temuan) as $get)
                    {{$get->sistem['name']}} {{$get->sistemdetail['name']}},
                @endforeach
            </td>
        </tr>
        @endforeach
    </tbody>
</table>