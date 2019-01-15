<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use OwenIt\Auditing\Contracts\Auditable;

class Vale extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //Modelo para vale de combustible

    //variables
    protected  $table='vales';

    protected $fillable=[
      'fechaCreacion', 'numeroVale', 'costoUnitarioVale', 'gasolinera',
      'tipoCombustible', 'galones', 'costoGalones', 'aceite', 'costoAceite', 'grasa', 'costoGrasa',
        'otro', 'costoOtro', 'empleadoAutorizaVal', 'empleadoRecibeVal',
      'estadoEntregadoVal', 'estadoLiquidacionVal', 'estadoRecibidoVal', 'idSalida', 'idLiquidacion'
    ];

    public function salida()
    {
        return $this->belongsTo(Salidas::class, 'idSalida');
    }

    public function liquidacion()
    {
         return $this->belongsTo(Liquidacion::class,'idLiquidacion');
    }


}
