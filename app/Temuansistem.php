<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temuansistem extends Model
{
    protected $table = 'temuan_sistem';
    public $timestamps = false;
    function temuan(){
        return $this->belongsTo('App\Temuan','nomor_temuan','nomor_temuan');
    }
    function sistemdetail(){
        return $this->belongsTo('App\Sistemdetail','sistem_detail_id','id');
    }
    function sistem(){
        return $this->belongsTo('App\Sistem','sistem_id','id');
    }
}
