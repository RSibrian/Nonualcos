<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
  protected $table = 'vehiculos';
  protected $fillable = [
      'numeroPlaca','idActivo'
  ];
  public function activo()
  {
      return $this->belongsTo(Activos::class,'idActivo');
  }

  public function salidas()
  {
      return $this->hasMany(Salidas::class, 'idVehiculo');
  }
}
