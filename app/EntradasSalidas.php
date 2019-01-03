<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntradasSalidas extends Model
{
  protected $table = 'entradas_salidas';
  protected $fillable = ['fechaInicio','fechaFin','tiempoHora','costoTiempo','idEmpleado'  ];
}
