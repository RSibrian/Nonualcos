<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cargo extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

    protected $table = 'cargos';
    protected $fillable = [
        'idUnidad','nombreCargo'
    ];
    public function unidad()
    {
        return $this->belongsTo(Unidades::class,'idUnidad');
    }
    public function empleados()
    {
        return $this->hasMany(Empleado::class,'idCargo');
    }
}
