<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Renta extends Model
{
    //
    protected $table="rentas";
    protected $fillable = ['tramo',
        'desde','hasta','sobreExceso','cuotaFija',
        'semSesde','semHasta','semSobreExceso','semCuotaFija',
        'anuDesde','anuHasta','anuSobreExceso','anuCuotaFija',
        'porcentaje'];
}
