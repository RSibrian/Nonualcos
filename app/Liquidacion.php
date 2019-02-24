<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;

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

        $query= Liquidacion::whereBetween('fechaLiquidacion', [$fechaI, $fechaF])
            ->select('liquidaciones.*')
            ->get();

        return $query;
    }

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //fechaLiquidacion
      if(Arr::has($data,'old_values.fechaLiquidacion'))
      $data['old_values']['fechaLiquidacion']=\Helper::fecha($data['old_values']['fechaLiquidacion']);

      if (Arr::has($data,'new_values.fechaLiquidacion'))
      $data['new_values']['fechaLiquidacion']=\Helper::fecha($data['new_values']['fechaLiquidacion']);

      //montoFacturaLiquidacion
      if(Arr::has($data,'old_values.montoFacturaLiquidacion'))
      $data['old_values']['montoFacturaLiquidacion']='$ '.\Helper::dinero($data['old_values']['montoFacturaLiquidacion']);

      if (Arr::has($data,'new_values.montoFacturaLiquidacion'))
      $data['new_values']['montoFacturaLiquidacion']='$ '.\Helper::dinero($data['new_values']['montoFacturaLiquidacion']);

      return $data;
    }

    public static function valesDisponibles(){
         return Vale::where('estadoRecibidoVal', '=', '1')->pluck('numeroVale', 'id');
    }

    public static function verifica($vehiculos, $vales){

        if ($vehiculos->first()===null){
            Session::flash('vehiculos','Debe registrar al menos un vehículo y luego crear un vale');
        }

        if ($vales->first()===null){
            Session::flash('vales','No hay vales para liquidar');
        }

    }

}
