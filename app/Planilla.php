<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    //
    protected $table="planillas";
    protected $fillable = [
        'concepto','mes','anno','fechaPago'
    ];
}
