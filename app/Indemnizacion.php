<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Indemnizacion extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  protected $table = 'indemnizaciones';
  protected $fillable = [
      'tipoInd','fechaFinalizacion','montoInd','idEmpleado','motivoInd'
      ];

      public function empleado()
      {
          return $this->belongsTo(Empleado::class,'idEmpleado');
      }
      
}
