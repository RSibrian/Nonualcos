<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
  //
  protected $table = 'cuentas_bancarias';
  protected $fillable = [
      'numeroCuenta','banco'
  ];
  public $timestamps = false;

}
