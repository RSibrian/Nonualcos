<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Vehiculo extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
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
