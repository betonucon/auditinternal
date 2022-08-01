
<?php

function name(){
    return "Kedai PePE";
}
function telepon(){
    return "0254 233795";
}

function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function ubah_bulan($bul){
    if($bul>9){
        return $bul;
    }else{
        return '0'.$bul;
    }
}
function parsing_validator($url){
    $content=utf8_encode($url);
    $data = json_decode($content,true);
 
    return $data;
}
function alamat(){
    return "Rukan Mutiara Boulevard Palem Blok i2 No. 9Cengkareng, Jakarta Barat, DKI Jakarta";
}
function rekening(){
    return "163000000930300";
}
function phone(){
    return "62 21 5596 1456";
}
function whatsapp(){
    return "62 81 1800 9129";
}
function uang($uang){
    return number_format($uang,0);
}
function encoder($b) {
    $data=base64_encode(base64_encode($b));
    return $data;
 }
 function decoder($b) {
    $data=base64_decode(base64_decode($b));
    return $data;
 }
function hari_tagihan($tgl){
    $pinjam            = $tgl;
    $time        = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
    $data        = date("Y-m-d", $time);
    return $data;
}
function masa_diskon($id){
    $tglmulai=date('Y-m-d');
    $tgl=date('Y-m-d');
    if($tglmulai<=date('Y-m-d') && $tgl>=date('Y-m-d')){
        $tgl1 = new DateTime(date('Y-m-d'));
        $tgl2 = new DateTime($tgl);
        $jarak = $tgl2->diff($tgl1);

        $data=($jarak->d+1);
    }else{
        $data=0;
    }
    return $data;
}



function cek_aktif($id){
    if($id==1){
        return'Aktif';
    }else{
        return'Non Aktif';
    }
}

function diskon($harga,$diskon){
    $data=($harga*$diskon)/100;
    $diskon=($harga-$data);
    return $diskon;

}

function diskon_harga($id,$harga,$diskon){
    if( masa_diskon($id)>0){
        $data=($harga*$diskon)/100;
        $diskon=($harga-$data);
    }else{
        $diskon=$harga;
    }
    
    return $diskon;

}
function email(){
    return "Rukan Mutiara Boulevard Palem Blok i2 No. 9Cengkareng, Jakarta Barat, DKI Jakarta";
}
function url_plug(){
    $data=url('public');
    return $data;
}

function gambar(){
    $data=url('public/dist/produk/');
    return $data;
}
function umur($mulai){
    $lahir = new DateTime($mulai);
    $hari_ini = new DateTime();
        
    $diff = $hari_ini->diff($lahir);
    return $diff->y;
}
function lama($mulai,$sampai){
    $lahir = new DateTime($mulai);
    $hari_ini = new DateTime($sampai);
        
    $diff = $hari_ini->diff($lahir);
    return $diff->y;
}
function penomoran(){
    $cek=App\Audit::where('tahun',date('Y'))->where('bulan',date('m'))->count();
    if($cek>0){
        $mst=App\Audit::where('tahun',date('Y'))->where('bulan',date('m'))->orderBy('nomor','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor'], 2, 3);
        $urutan++;
        $nomor=date('y').sprintf("%03s", $urutan);
    }else{
        $nomor=date('y').sprintf("%03s", 1);
    }
    return $nomor;
}
function penomoran_temuan($nomor){
    $cek=App\Temuan::where('nomor',$nomor)->count();
    if($cek>0){
        $mst=App\Temuan::where('nomor',$nomor)->orderBy('nomor_temuan','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor_temuan'], 5, 4);
        $urutan++;
        $nomor=$nomor.sprintf("%04s", $urutan);
    }else{
        $nomor=$nomor.sprintf("%04s", 1);
    }
    return $nomor;
}
function link_artikel($nama){
    $patr='/\s+/';
    $link=preg_replace($patr,'_',$nama);
    return $link;
}

function get_role(){
    $data=App\Role::get();
    return $data;
}
function get_unit(){
    $data=App\Unit::where('aktif',1)->get();
    return $data;
}
function get_sistem(){
    $data=App\Sistem::where('aktif',1)->get();
    return $data;
}
function get_auditor(){
    $data=App\Akses::select('username')->where('role_id',2)->groupBy('username')->get();
    return $data;
}
function get_audit_temuan(){
    $data=App\Auditauditor::where('username',Auth::user()->username)->where('role_id',Auth::user()->role_id)->get();
    return $data;
}
function get_periode(){
    $data=App\Periode::where('aktif',1)->get();
    return $data;
}
function get_unit_dashboard(){
    $data=App\Unit::whereIn('unit_id',array(1,3))->get();
    return $data;
}
function get_status(){
    $data=App\Status::whereIn('id',array(3,5,7,6))->get();
    return $data;
}
function get_status_all(){
    $data=App\Status::whereIn('id',array(1,2,3,4,5,7,6))->get();
    return $data;
}
function nama_status($id){
    $data=App\Status::where('id',$id)->first();
    $name='<font color="'.$data->color.'">'.$data->name.'</font>';
    return $name;
}
function status($id){
    $data=App\Status::where('id',$id)->first();
    return $data['name'];
}
function cek_status($sts,$nomor){
    $mst=App\Status::where('id',$sts)->first();
    if($sts==0){
        $data='';
    }
    if($sts==1){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white" style="margin-top:2px">'.status(1).'</span>';
    }
    if($sts==2){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(2).'</span>';
    }
    if($sts==3){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(3).'</span>';
    }
    if($sts==4){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(4).'</span>';
    }
    if($sts==5){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(5).'</span>';
    }
    if($sts==6){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(6).'</span>';
    }
    if($sts==7){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(7).'</span>';
    }
    return $data;
}
function cek_status_auditee($sts,$nomor){
    $mst=App\Status::where('id',$sts)->first();
    if($sts==0){
        $data='';
    }
    if($sts==1){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white" style="margin-top:2px">'.status(1).'</span>';
    }
    if($sts==2){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">Pesetujuan</span>';
    }
    if($sts==3){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(3).'</span>';
    }
    if($sts==4){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(4).'</span>';
    }
    if($sts==5){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(5).'</span>';
    }
    if($sts==6){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(6).'</span>';
    }
    if($sts==7){
        $data='<span  onclick="location.assign(`'.url('Temuan/detail/').'?temuan='.$nomor.'`)" class="btn btn-xs btn-'.$mst->color.' text-white">'.status(7).'</span>';
    }
    return $data;
}
function cek_sistem($nomor,$sistem_id){
    $data=App\Auditsistem::where('nomor',$nomor)->where('kat',1)->where('sistem_id',$sistem_id)->count();
    return $data;
}
function cek_sistem_temuan($nomor,$sistem_id){
    $data=App\Temuansistem::where('nomor_temuan',$nomor)->where('sistem_detail_id',$sistem_id)->count();
    return $data;
}
function tahun(){
    $data=App\User::where('username',Auth::user()->username)->first();
    return $data->tahun;
}
function count_sistem($nomor){
    $data=App\Auditsistem::where('nomor',$nomor)->count();
    return $data;
}
function get_unit_auditor(){
    $data=App\Auditauditor::select('nomor')->groupBy('nomor')->get();
    return $data;
}
function filter_kode(){
    $cek=App\Filter::where('username',Auth::user()->username)->where('role_id',Auth::user()->role_id)->count();
    if($cek>0){
        $data=App\Filter::where('username',Auth::user()->username)->where('role_id',Auth::user()->role_id)->first();
        return $data['kode'];
    }else{
        return 'all';
    }
    
}
function filter_status(){
    $cek=App\Filter::where('username',Auth::user()->username)->where('role_id',Auth::user()->role_id)->count();
    if($cek>0){
        $data=App\Filter::where('username',Auth::user()->username)->where('role_id',Auth::user()->role_id)->first();
        return $data['status'];
    }else{
        return 'all';
    }
    
}
function total_temuan($kode,$tahun,$act){
    if($act==0){
        $data=App\Temuan::where('kode',$kode)->whereYear('create',$tahun)->count();
    }
    if($act==6){
        $data=App\Temuan::where('kode',$kode)->whereYear('create',$tahun)->where('status',6)->count();
    }
    if($act==7){
        $data=App\Temuan::where('kode',$kode)->whereYear('create',$tahun)->where('status',7)->count();
    }
    
    return $data;
}
function rekap_total_temuan($tahun,$act){
    if($act==0){
        $data=App\Temuan::whereYear('create',$tahun)->count();
    }
    if($act==6){
        $data=App\Temuan::whereYear('create',$tahun)->where('status',6)->count();
    }
    if($act==7){
        $data=App\Temuan::whereYear('create',$tahun)->where('status',7)->count();
    }
    
    return $data;
}
function persen_total_temuan($kode,$tahun){
    
    $total=App\Temuan::where('kode',$kode)->whereYear('create',$tahun)->count();
    if($total>0){
        $pembagi=100/$total;
        $aktif=App\Temuan::where('kode',$kode)->whereYear('create',$tahun)->where('status',6)->count();
        $hasil=$aktif*$pembagi;
        $data=round($hasil);
    }else{
        $data=0;
    }
        
    
    
    return $data;
}
function rekap_persen_total_temuan($tahun){
    
    $total=App\Temuan::whereYear('create',$tahun)->count();
    if($total>0){
        $pembagi=100/$total;
        $aktif=App\Temuan::whereYear('create',$tahun)->where('status',6)->count();
        $hasil=$aktif*$pembagi;
        $data=round($hasil);
    }else{
        $data=0;
    }
        
    
    
    return $data;
}
function total_temuan_sistem($kode,$tahun,$sistem_id,$act){
    if($act==0){
        $data=App\Viewtemuansistem::where('kode',$kode)->where('sistem_id',$sistem_id)->whereYear('create',$tahun)->count();
    }
    if($act==6){
        $data=App\Viewtemuansistem::where('kode',$kode)->where('sistem_id',$sistem_id)->whereYear('create',$tahun)->where('status',6)->count();
    }
    if($act==7){
        $data=App\Viewtemuansistem::where('kode',$kode)->where('sistem_id',$sistem_id)->whereYear('create',$tahun)->where('status',7)->count();
    }
    
    return $data;
}
function rekap_total_temuan_sistem($tahun,$sistem_id,$act){
    if($act==0){
        $data=App\Viewtemuansistem::where('sistem_id',$sistem_id)->whereYear('create',$tahun)->count();
    }
    if($act==6){
        $data=App\Viewtemuansistem::where('sistem_id',$sistem_id)->whereYear('create',$tahun)->where('status',6)->count();
    }
    if($act==7){
        $data=App\Viewtemuansistem::where('sistem_id',$sistem_id)->whereYear('create',$tahun)->where('status',7)->count();
    }
    
    return $data;
}
function total_all_temuan_sistem($kode,$tahun,$act){
    if($act==0){
        $data=App\Viewtemuansistem::where('kode',$kode)->whereYear('create',$tahun)->count();
    }
    if($act==6){
        $data=App\Viewtemuansistem::where('kode',$kode)->whereYear('create',$tahun)->where('status',6)->count();
    }
    if($act==7){
        $data=App\Viewtemuansistem::where('kode',$kode)->whereYear('create',$tahun)->where('status',7)->count();
    }
    
    return $data;
}
function rekap_total_all_temuan_sistem($tahun,$act){
    if($act==0){
        $data=App\Viewtemuansistem::whereYear('create',$tahun)->count();
    }
    if($act==6){
        $data=App\Viewtemuansistem::whereYear('create',$tahun)->where('status',6)->count();
    }
    if($act==7){
        $data=App\Viewtemuansistem::whereYear('create',$tahun)->where('status',7)->count();
    }
    
    return $data;
}
function persen_total_temuan_sistem($kode,$tahun){
    
    $total=App\Viewtemuansistem::where('kode',$kode)->whereYear('create',$tahun)->count();
    if($total>0){
        $pembagi=100/$total;
        $aktif=App\Viewtemuansistem::where('kode',$kode)->whereYear('create',$tahun)->where('status',6)->count();
        $hasil=$aktif*$pembagi;
        $data=round($hasil);
    }else{
        $data=0;
    }
    
    return $data;
}
function rekap_persen_total_temuan_sistem($tahun){
    
    $total=App\Viewtemuansistem::whereYear('create',$tahun)->count();
    if($total>0){
        $pembagi=100/$total;
        $aktif=App\Viewtemuansistem::whereYear('create',$tahun)->where('status',6)->count();
        $hasil=$aktif*$pembagi;
        $data=round($hasil);
    }else{
        $data=0;
    }
    
    return $data;
}

function count_sistem_temuan($nomor){
    $data=App\Temuansistem::where('nomor_temuan',$nomor)->count();
    return $data;
}
function get_sistem_audit($nomor){
    $data=App\Auditsistem::where('nomor',$nomor)->get();
    return $data;
}
function get_view(){
    $data=App\Viewexcel::get();
    return $data;
}
function get_sistem_temuan($nomor){
    $data=App\Temuansistem::where('nomor_temuan',$nomor)->get();
    return $data;
}
function count_sistem_temuan_file($nomor){
    $data=App\Temuanfile::where('nomor_temuan',$nomor)->count();
    return $data;
}

function array_sistem($nomor){
    
    $data  = array_column(
        App\Auditsistem::where('nomor',$nomor)->orderBy('id','Asc')
        ->get()
        ->toArray(),'sistem_id'
     );
    return $data;
}
function array_auditor(){
    
    $data  = array_column(
        App\Auditauditor::where('username',Auth::user()->username)->orderBy('id','Asc')
        ->get()
        ->toArray(),'nomor'
     );
    return $data;
}
function array_auditee(){
    
    $data  = array_column(
        App\Akses::where('username',Auth::user()->username)->where('role_id',3)->orderBy('id','Asc')
        ->get()
        ->toArray(),'kode'
     );
    return $data;
}
function get_klausul($nomor){
    $data=App\Sistemdetail::whereIn('sistem_id',array_sistem($nomor))->orderByRaw('sistem_id','Asc')->get();
    return $data;
}
function get_audit_sistem($nomor){
    $data=App\Auditsistem::where('nomor',$nomor)->get();
    return $data;
}
function get_temuan($nomor){
    $data=App\Temuan::where('nomor',$nomor)->get();
    return $data;
}
function cek_total_status($nomor,$status){
    $data=App\Temuan::where('nomor',$nomor)->where('status',$status)->count();
    return $data;
}
function get_auditee($kode){
    $data=App\Akses::where('kode',$kode)->where('role_id',3)->get();
    return $data;
}
function get_agen($kode){
    $data=App\Akses::where('kode',$kode)->where('role_id',5)->get();
    return $data;
}

function get_temuan_file($nomor){
    $get=App\Temuanfile::where('nomor_temuan',$nomor)->orderBy('nomor_temuan','Asc')->get();
    return $get;
}
function get_lo($kode){
    $data=App\Akses::where('kode',$kode)->where('role_id',4)->get();
    return $data;
}
function get_audit_auditor($nomor){
    $data=App\Auditauditor::where('nomor',$nomor)->get();
    return $data;
}
function count_auditor($nomor){
    $data=App\Auditauditor::where('nomor',$nomor)->count();
    return $data;
}
function nama_role($id){
    $data=App\Role::where('id',$id)->first();
    return $data['name'];
}

?>