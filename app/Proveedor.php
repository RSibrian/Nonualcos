<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Proveedor extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    protected $table = 'proveedores';
  protected $fillable = [
      'nombreEmpresa','nombreEncargado', 'email','telefonoProve','tipoProveedor'
  ];
}
