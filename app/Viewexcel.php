<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Viewexcel extends Model
{
    protected $table = 'view_excel';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'nomor',
        'nomor_temuan',
    ];
}
