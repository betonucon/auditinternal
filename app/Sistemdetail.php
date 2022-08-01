<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sistemdetail extends Model
{
    protected $table = 'sistem_detail';
    public $timestamps = false;
    function sistem(){
        return $this->belongsTo('App\Sistem','sistem_id','id');
    }
}
