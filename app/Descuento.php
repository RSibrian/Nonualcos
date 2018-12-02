<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
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
