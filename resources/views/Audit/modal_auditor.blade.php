        <table class="table table-bordered">
            <tr>
                <th width="5%">No</th>
                <th width="5%"></th>
                <th >Auditor</th>
            </tr>
            @foreach(get_auditor() as $nox=>$sistem)
            <tr>
                <td>{{$nox+1}}</td>
                <td><input type="checkbox" name="username[]" @if(cek_auditor($nomor,$sistem->username)>0) checked @endif value="{{$sistem->username}}"></td>
                <td >{{$sistem->name}}</td>
            </tr>
            @endforeach
        </table>