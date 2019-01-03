<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
  protected $fillable = [
      'nombreEmpresa','nombreEncargado', 'email','telefonoProve','tipoProveedor'
  ];
}
