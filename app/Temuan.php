<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temuan extends Model
{
    protected $table = 'temuan';
    public $timestamps = false;
    function unit(){
        return $this->belongsTo('App\Unit','kode','kode');
    }
    function audit(){
        return $this->belongsTo('App\Audit','nomor','nomor');
    }
    function user(){
        return $this->belongsTo('App\User','username','username');
    }
    function statusnya(){
        return $this->belongsTo('App\Status','status','id');
    }
}
