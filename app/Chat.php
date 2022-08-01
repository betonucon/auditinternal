<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = 'chat';
    public $timestamps = false;
    function user(){
        return $this->belongsTo('App\User','username','username');
    }
    function role(){
        return $this->belongsTo('App\Role','role_id','id');
    }
}
