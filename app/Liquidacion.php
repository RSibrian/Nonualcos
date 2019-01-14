<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use OwenIt\Auditing\Contracts\Auditable;

class Liquidacion extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
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
            ->join('empleados', 'salidas.idEmpleado', '=', 'empleados.id')
            ->join('cargos', 'empleados.idCargo', '=', 'cargos.id')
            ->join('unidades', 'cargos.idUnidad', '=', 'unidades.id')
            ->where([
                ['idLiquidacion', '=', $liquidacion->id],
                ['idVehiculo', '=', $placa],
                ['estadoLiquidacionVal', '=', '1'],
                ['estadoRecibidoVal', '=', '1'],
                ['estadoEntregadoVal', '=', '1'],
            ])
            ->select('vales.id','vales.fechaCreacion', 'vales.numeroVale', 'vales.costoUnitarioVale','idVehiculo','nombreUnidad')
            ->get();

        return $query;
    }

    public static function Liquidaciones($fechaI,$fechaF)
    {

        $query= Vale::join('liquidaciones', 'vales.idLiquidacion', '=', 'liquidaciones.id')
            ->whereBetween('fechaLiquidacion', [$fechaI, $fechaF])
            ->select('liquidaciones.*')
            ->get();

        return $query;
    }

}
