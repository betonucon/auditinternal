<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditsistem extends Model
{
    protected $table = 'audit_sistem';
    public $timestamps = false;
    function sistem(){
        return $this->belongsTo('App\Sistem','sistem_id','id');
    }
}
