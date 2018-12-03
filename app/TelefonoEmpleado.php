<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Empleado;

class TelefonoEmpleado extends Model
{
  protected $table = 'telefono_empleados';
  protected $fillable = [
      'telefonoEmpleado','tipoTelefono','idEmpleado',
  ];

  public function empleado()
  {
      return $this->belongsTo(Empleado::class,'idEmpleado');
  }
}
