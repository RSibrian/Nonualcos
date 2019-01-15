<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EntradasSalidas extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  protected $table = 'entradas_salidas';
  protected $fillable = ['fechaInicio','fechaFin','tiempoHora','costoTiempo','idEmpleado'  ];
}
