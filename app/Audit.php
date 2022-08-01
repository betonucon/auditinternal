<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $table = 'audit';
    public $timestamps = false;
    function unit(){
        return $this->belongsTo('App\Unit','kode','kode');
    }
    function periode(){
        return $this->belongsTo('App\Periode','periode_id','id');
    }
}
