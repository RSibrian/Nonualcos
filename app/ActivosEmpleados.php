<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivosEmpleados extends Model
{
  protected $table = 'activos_empleados';
  protected $fillable = [
      'fechaInicioEmp','fechaFinalEmp','estadoEmp','idActivo','idEmpleado'
  ];
}
