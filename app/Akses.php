<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Akses extends Model
{
    protected $table = 'akses';
    public $timestamps = false;
    function unit(){
        return $this->belongsTo('App\Unit','kode','kode');
    }
    function user(){
        return $this->belongsTo('App\User','username','username');
    }
}
