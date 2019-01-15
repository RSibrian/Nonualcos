<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Descuento extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table="descuentos";
    protected $fillable = [
        'idEmpleado','banco_id','pago','observacionDescuento',
        'imagenInicio','estadoDescuento','numeroCuenta','tipoDescuento'
    ];
    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }
}
