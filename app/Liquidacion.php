<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Liquidacion extends Model
{
    //Clase liquidacion

    protected $table = 'liquidaciones';
    protected $fillable = [
        'fechaLiquidacion','numeroFacturaLiquidacion','montoFacturaLiquidacion'
    ];

    public function vale()
    {
        return $this->hasMany(Vale::class, 'idLiquidacion');
    }

    public static function Datatable($placa){
        return Vale::join('salidas', 'vales.idSalida', '=', 'salidas.id')
            ->where([
                ['idVehiculo', '=', $placa],
                ['estadoLiquidacionVal', '=', '0'],
                ['estadoRecibidoVal', '=', '1'],
                ['estadoEntregadoVal', '=', '1'],
            ])
            ->select('vales.*')
            ->get();
    }
     public static function VehiculohasLiquidacion($liquidacion)
     {
         $vales = $liquidacion->vale;
         foreach ($vales as $vale)
         {
             $placa = $vale->salida->vehiculo->id;
         }

         $query= Vale::join('salidas', 'vales.idSalida', '=', 'salidas.id')
             ->where([
                 ['idLiquidacion', '=', $liquidacion->id],
                 ['idVehiculo', '=', $placa],
                 ['estadoLiquidacionVal', '=', '1'],
                 ['estadoRecibidoVal', '=', '1'],
                 ['estadoEntregadoVal', '=', '1'],
             ])
             ->select('vales.*', 'idVehiculo')
             ->get();

         return $query;
     }

}
