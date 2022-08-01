        <table class="table table-bordered">
            <tr>
                <th width="5%">No</th>
                <th width="5%"></th>
                <th >Sistem</th>
            </tr>
            @foreach(get_sistem() as $nox=>$sistem)
            <tr>
                <td>{{$nox+1}}</td>
                <td><input type="checkbox" name="sistem_id[]" @if(cek_sistem($nomor,$sistem->id)>0) checked @endif value="{{$sistem->id}}"></td>
                <td >{{$sistem->name}}</td>
            </tr>
            @endforeach
        </table>