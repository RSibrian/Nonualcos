<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use OwenIt\Auditing\Contracts\Auditable;
use App\Empleado;
use App\Salidas;
use App\Liquidacion;

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

      /**
      * {@inheritdoc}
      */
      //fución para cambiar los datos guardados en la auditoría
      public function transformAudit(array $data): array
      {
        //fechaCreacion
        if(Arr::has($data,'old_values.fechaCreacion'))
        $data['old_values']['fechaCreacion']=\Helper::fecha($data['old_values']['fechaCreacion']);

        if (Arr::has($data,'new_values.fechaCreacion'))
        $data['new_values']['fechaCreacion']=\Helper::fecha($data['new_values']['fechaCreacion']);

        //costoUnitarioVale
        if(Arr::has($data,'old_values.costoUnitarioVale'))
        $data['old_values']['costoUnitarioVale']='$ '.\Helper::dinero($data['old_values']['costoUnitarioVale']);

        if (Arr::has($data,'new_values.costoUnitarioVale'))
        $data['new_values']['costoUnitarioVale']='$ '.\Helper::dinero($data['new_values']['costoUnitarioVale']);

        //Combustible
        if(Arr::has($data,'old_values.tipoCombustible'))
        $data['old_values']['tipoCombustible']==1?
        $data['old_values']['tipoCombustible']="Diesel": ($data['old_values']['tipoCombustible']==2?
        $data['old_values']['tipoCombustible']="Regular":
        $data['old_values']['tipoCombustible']="Especial");

        if (Arr::has($data,'new_values.tipoCombustible'))
        $data['new_values']['tipoCombustible']==1?
        $data['new_values']['tipoCombustible']="Diesel": ($data['new_values']['tipoCombustible']==2?
        $data['new_values']['tipoCombustible']="Regular":
        $data['new_values']['tipoCombustible']="Especial");

        //costoGalones
        if(Arr::has($data,'old_values.costoGalones'))
        $data['old_values']['costoGalones']='$ '.\Helper::dinero($data['old_values']['costoGalones']);

        if (Arr::has($data,'new_values.costoGalones'))
        $data['new_values']['costoGalones']='$ '.\Helper::dinero($data['new_values']['costoGalones']);

        //Aceite
        if(Arr::has($data,'old_values.aceite'))
        $data['old_values']['aceite']==0?
        $data['old_values']['aceite']="No":
        $data['old_values']['aceite']="Sí";

        if (Arr::has($data,'new_values.aceite'))
        $data['new_values']['aceite']==0?
        $data['new_values']['aceite']="No":
        $data['new_values']['aceite']="Sí";

        //costoAceite
        if(Arr::has($data,'old_values.costoAceite'))
        $data['old_values']['costoAceite']='$ '.\Helper::dinero($data['old_values']['costoAceite']);

        if (Arr::has($data,'new_values.costoAceite'))
        $data['new_values']['costoAceite']='$ '.\Helper::dinero($data['new_values']['costoAceite']);

        //grasa
        if(Arr::has($data,'old_values.grasa'))
        $data['old_values']['grasa']==0?
        $data['old_values']['grasa']="No":
        $data['old_values']['grasa']="Sí";

        if (Arr::has($data,'new_values.grasa'))
        $data['new_values']['grasa']==0?
        $data['new_values']['grasa']="No":
        $data['new_values']['grasa']="Sí";

        //costoGrasa
        if(Arr::has($data,'old_values.costoGrasa'))
        $data['old_values']['costoGrasa']='$ '.\Helper::dinero($data['old_values']['costoGrasa']);

        if (Arr::has($data,'new_values.costoGrasa'))
        $data['new_values']['costoGrasa']='$ '.\Helper::dinero($data['new_values']['costoGrasa']);

        //otro
        if(Arr::has($data,'old_values.otro'))
        if(empty($data['old_values']['otro']))
        $data['old_values']['otro']="No";

        if (Arr::has($data,'new_values.otro'))
        if(empty($data['new_values']['otro']))
        $data['new_values']['otro']="No";

        //estadoEntregadoVal
        if(Arr::has($data,'old_values.estadoEntregadoVal'))
        $data['old_values']['estadoEntregadoVal']==0?
        $data['old_values']['estadoEntregadoVal']="Pendiente":
        $data['old_values']['estadoEntregadoVal']="Entregado";

        if (Arr::has($data,'new_values.estadoEntregadoVal'))
        $data['new_values']['estadoEntregadoVal']==0?
        $data['new_values']['estadoEntregadoVal']="Pendiente":
        $data['new_values']['estadoEntregadoVal']="Entregado";

        //estadoLiquidacionVal
        if(Arr::has($data,'old_values.estadoLiquidacionVal'))
        $data['old_values']['estadoLiquidacionVal']==0?
        $data['old_values']['estadoLiquidacionVal']="Pendiente":
        $data['old_values']['estadoLiquidacionVal']="Liquidado";

        if (Arr::has($data,'new_values.estadoLiquidacionVal'))
        $data['new_values']['estadoLiquidacionVal']==0?
        $data['new_values']['estadoLiquidacionVal']="Pendiente":
        $data['new_values']['estadoLiquidacionVal']="Liquidado";

        //estadoRecibidoVal
        if(Arr::has($data,'old_values.estadoRecibidoVal'))
        $data['old_values']['estadoRecibidoVal']==0?
        $data['old_values']['estadoRecibidoVal']="Pendiente":
        $data['old_values']['estadoRecibidoVal']="Recibido";

        if (Arr::has($data,'new_values.estadoRecibidoVal'))
        $data['new_values']['estadoRecibidoVal']==0?
        $data['new_values']['estadoRecibidoVal']="Pendiente":
        $data['new_values']['estadoRecibidoVal']="Recibido";

        //costoOtro
        if(Arr::has($data,'old_values.costoOtro'))
        $data['old_values']['costoOtro']='$ '.\Helper::dinero($data['old_values']['costoOtro']);

        if (Arr::has($data,'new_values.costoOtro'))
        $data['new_values']['costoOtro']='$ '.\Helper::dinero($data['new_values']['costoOtro']);

        //empleadoAutorizaVal
        if(Arr::has($data,'old_values.empleadoAutorizaVal'))
        if(!empty($data['old_values']['empleadoAutorizaVal']))
        $data['old_values']['empleadoAutorizaVal']=Empleado::find($data['old_values']['empleadoAutorizaVal'])->fullName;

        if (Arr::has($data,'new_values.empleadoAutorizaVal'))
        if(!empty($data['new_values']['empleadoAutorizaVal']))
        $data['new_values']['empleadoAutorizaVal']=Empleado::find($data['new_values']['empleadoAutorizaVal'])->fullName;

        //empleadoRecibeVal
        if(Arr::has($data,'old_values.empleadoRecibeVal'))
        if(!empty($data['old_values']['empleadoRecibeVal']))
        $data['old_values']['empleadoRecibeVal']=Empleado::find($data['old_values']['empleadoRecibeVal'])->fullName;

        if (Arr::has($data,'new_values.empleadoRecibeVal'))
        if(!empty($data['new_values']['empleadoRecibeVal']))
        $data['new_values']['empleadoRecibeVal']=Empleado::find($data['new_values']['empleadoRecibeVal'])->fullName;

        //idSalida
        if(Arr::has($data,'old_values.idSalida'))
        if(!empty($data['old_values']['idSalida']))
        $data['old_values']['idSalida']=Salidas::find($data['old_values']['idSalida'])->mision;

        if (Arr::has($data,'new_values.idSalida'))
        if(!empty($data['new_values']['idSalida']))
        $data['new_values']['idSalida']=Salidas::find($data['new_values']['idSalida'])->mision;

        //idLiquidacion
        if(Arr::has($data,'old_values.idLiquidacion'))
        if(!empty($data['old_values']['idLiquidacion']))
        $data['old_values']['idLiquidacion']=Liquidacion::find($data['old_values']['idLiquidacion'])->numeroFacturaLiquidacion;

        if (Arr::has($data,'new_values.idLiquidacion'))
        if(!empty($data['new_values']['idLiquidacion']))
        $data['new_values']['idLiquidacion']=Liquidacion::find($data['new_values']['idLiquidacion'])->numeroFacturaLiquidacion;

        return $data;
      }

    public static function darIndex(){
        $esAdmin=self::EsAdmin(Auth::id());

        if ($esAdmin){
            $vales=Vale::select('*')
                ->where('estadoLiquidacionVal', '=', '0')
                ->get();
        }else{
           $usuario=User::find(Auth::id());
           $vales=Vale::select('vales.*')
               ->join('salidas', 'salidas.id', '=', 'vales.idSalida')
               ->join('empleados', 'empleados.id', '=', 'salidas.idEmpleado')
               ->where([
                   ['salidas.idEmpleado', '=', $usuario->idEmpleado]
               ])
               ->get();
        }

        return $vales;

    }

    public static function EmpleadosActivos(){
        $esAdmin=self::EsAdmin(Auth::id());

        if($esAdmin){
            $empleadosActivos=Empleado::where('estadoEmpleado', '=', '0')->get(['empleados.id']);
            $empladosEnSalida=Empleado::join('salidas', 'empleados.id', '=', 'salidas.idEmpleado')
                ->join('vales', 'salidas.id', '=', 'vales.id')
                ->where('vales.estadoRecibidoVal', '=', '0')
                ->get(['empleados.id']);

            $empleados=$empleadosActivos->merge($empladosEnSalida);
            $empleados=$empleados->toArray();

            $empleados=Empleado::select(DB::raw("CONCAT(nombresEmpleado,' ',apellidosEmpleado) AS name"),'id')
                ->whereNotIn('empleados.id',$empleados)->pluck('name','empleados.id');

        }else{
            $usuario=User::find(Auth::id());

            $empleadosSalida=Empleado::join('salidas', 'empleados.id', '=', 'salidas.idEmpleado')
                ->join('vales', 'salidas.id', '=', 'vales.id')
                ->where([
                    ['vales.estadoRecibidoVal', '=', '0'],
                    ['empleados.id', '=', $usuario->idEmpleado],
                ])
                ->get(['empleados.id']);

            $empleados=$empleadosSalida->toArray();

            $empleados=Empleado::select(DB::raw("CONCAT(nombresEmpleado,' ',apellidosEmpleado) AS name"),'empleados.id')
                ->whereNotIn('empleados.id',$empleados)
                ->where('empleados.id', '=', $usuario->idEmpleado)
                ->pluck('name','empleados.id');

        }

        return $empleados;

    }

    public static function verifica($autoriza, $vehiculos, $empleados){

        if ($autoriza->idEmpleado===null){
            Session::flash('autoriza','El usuario debe estar asignado a un empleado para poder crear un registro');;
        }

        if ($vehiculos->first()===null){
            Session::flash('vehiculos','No hay vehículos disponibles para registrar un vale');
        }

        if ($empleados->first()===null){
            Session::flash('empleados','No hay empleados disponibles para registrar un vale');
        }

    }

    public static function UsuariosAdmin(){

    $empleadosAdmin=Empleado::join('users', 'empleados.id', '=', 'users.idEmpleado')
        ->join('role_user', 'role_user.user_id', '=', 'users.id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where([
            ['estadoEmpleado', '=', '1'],
            ['slug', '=', 'admin']
        ])
        ->get(['empleados.id']);

    $empleados=$empleadosAdmin->toArray();

    $empleados=Empleado::select(DB::raw("CONCAT(nombresEmpleado,' ',apellidosEmpleado) AS name"),'id')
        ->whereIn('empleados.id',$empleados)->pluck('name','empleados.id');

    return $empleados;

}

    public static function EsAdmin($ide){

        $empleadosAdmin=Empleado::join('users', 'empleados.id', '=', 'users.idEmpleado')
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where([
                ['users.id', '=', $ide],
                ['estadoEmpleado', '=', '1'],
                ['slug', '=', 'admin']
            ])
            ->get(['empleados.id']);

        $empleados=$empleadosAdmin->isNotEmpty();


        return $empleados;

    }

    public static function PlascasDisponiblesModificar($vehiculoId){
          $placasDisponibles= Vehiculo::PlacasDisponibles();
          $miPlaca=Vehiculo::where('vehiculos.id', '=', $vehiculoId->id)->pluck('vehiculos.numeroPlaca', 'vehiculos.id');
          $placasDisponibles=$placasDisponibles->union($miPlaca);

          return $placasDisponibles;
    }

    public static function EmpleadosDisponiblesModificar($empleadoId){
        $empleadosActivos= self::EmpleadosActivos();
        $miEmpleado= Empleado::where('empleados.id', '=', $empleadoId->idEmpleado)
            ->get()->pluck('FullName', 'id');

        $empleadosActivos=$empleadosActivos->union($miEmpleado);

        return $empleadosActivos;
    }


}
