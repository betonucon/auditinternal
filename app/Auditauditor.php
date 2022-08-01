<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Auditauditor extends Model
{
    protected $table = 'audit_auditor';
    public $timestamps = false;
    function user(){
        return $this->belongsTo('App\User','username','username');
    }
    function audit(){
        return $this->belongsTo('App\Audit','nomor','nomor');
    }
}
