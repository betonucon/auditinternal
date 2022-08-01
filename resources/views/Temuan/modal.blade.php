        <table class="table table-bordered">
            <tr>
                <th width="5%">No</th>
                <th width="5%"></th>
                
                <th width="25%">Lingkup</th>
                <th width="10%">Nomor</th>
                
                <th >Sistem</th>
            </tr>
            @foreach(get_klausul($nomor) as $nox=>$sistem)
            <?php
                if($sistem->note==1){
                    $spasi="left";
                }
                if($sistem->note==2){
                    $spasi="center";
                }
                if($sistem->note==3){
                    $spasi="right";
                }
            ?>
            <tr>
                <td>{{$nox+1}}</td>
                <td><input type="checkbox" name="sistem_detail_id[]"@if(cek_sistem_temuan($nomor_temuan,$sistem->id)>0) checked @endif   value="{{$sistem->id}}"></td>
                <td >{{$sistem->sistem['name']}}</td>
                <td style="text-align:left;font-weight:bold">{{$sistem->name}}</td>
                
                <td >{{$sistem->detail}}</td>
            </tr>
            @endforeach
        </table>