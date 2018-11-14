<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivosUnidades extends Model
{
  protected $table = 'activos_unidades';
  protected $fillable = [
      'fechaInicioUni','fechaFinalUni','estadoUni','observacionUni','idActivo','idUnidad','idEmpleado'
  ];
  public function activo()
  {
      return $this->belongsTo(Activos::class,'idActivo');
  }
  public function unidad()
  {
      return $this->belongsTo(Unidades::class,'idUnidad');
  }
  public function empleado()
  {
      return $this->belongsTo(Empleado::class,'idEmpleado');
  }
}
