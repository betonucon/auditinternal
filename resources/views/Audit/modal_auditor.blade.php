        <table class="table table-bordered">
            <tr>
                <th width="5%">No</th>
                <th width="5%"></th>
                <th >Auditor</th>
            </tr>
            @foreach(get_auditor() as $nox=>$sistem)
            <tr>
                <td>{{$nox+1}}</td>
                <td><input type="checkbox" name="username[]" value="{{$sistem->username}}"></td>
                <td >{{$sistem->user['name']}}</td>
            </tr>
            @endforeach
        </table>