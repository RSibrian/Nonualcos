<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    //
    protected $table="rentas";
    protected $fillable = ['tramo','desde','hasta','porcentaje','sobreExceso','cuota_fija'];
}
