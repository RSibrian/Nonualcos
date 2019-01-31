<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activos;
use App\Empleado;
use App\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;

class Mantenimiento extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  //
  protected $table = 'mantenimientos';
  protected $fillable = [
    'id','fechaRecepcionTaller','reparacionesSolicitadas','personalSolicitaMantenimiento','reparacionesRealizadas','empresaEncargada','nombreEncargado','fechaRetornoTaller','costoMantenimiento','personalRecibeMantenimiento','idActivo',];

    public function activos()
    {
      return $this->belongsTo(Activos::class,'idActivo');
    }
    public function empleado1()
    {
      return $this->belongsTo(Empleado::class,'personalSolicitaMantenimiento');
    }
    public function empleado2()
    {
      return $this->belongsTo(Empleado::class,'personalRecibeMantenimiento');
    }
    public function proveedores()
    {
      return $this->belongsTo(Proveedor::class,'empresaEncargada');
    }

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //Activos
      if(Arr::has($data,'old_values.idActivo'))
      $data['old_values']['idActivo']=Activos::find($data['old_values']['idActivo'])->codigoInventario." - ".Activos::find($data['old_values']['idActivo'])->nombreActivo;

      if (Arr::has($data,'new_values.idActivo'))
      $data['new_values']['idActivo']=Activos::find($data['new_values']['idActivo'])->codigoInventario." - ".Activos::find($data['new_values']['idActivo'])->nombreActivo;

      //Empleado que Solicita
      if(Arr::has($data,'old_values.personalSolicitaMantenimiento'))
      $data['old_values']['personalSolicitaMantenimiento']=Empleado::find($data['old_values']['personalSolicitaMantenimiento'])->fullName;

      if (Arr::has($data,'new_values.personalSolicitaMantenimiento'))
      $data['new_values']['personalSolicitaMantenimiento']=Empleado::find($data['new_values']['personalSolicitaMantenimiento'])->fullName;

      //Empleado que Recibe
      if(Arr::has($data,'old_values.personalRecibeMantenimiento'))
      if(!empty($data['old_values']['personalRecibeMantenimiento']))$data['old_values']['personalRecibeMantenimiento']=Empleado::find($data['old_values']['personalRecibeMantenimiento'])->fullName;

      if (Arr::has($data,'new_values.personalRecibeMantenimiento'))
      if(!empty($data['new_values']['personalRecibeMantenimiento']))$data['new_values']['personalRecibeMantenimiento']=Empleado::find($data['new_values']['personalRecibeMantenimiento'])->fullName;

      //Proveedor
      if(Arr::has($data,'old_values.empresaEncargada'))
      $data['old_values']['empresaEncargada']=Proveedor::find($data['old_values']['empresaEncargada'])->nombreEmpresa;

      if (Arr::has($data,'new_values.empresaEncargada'))
      $data['new_values']['empresaEncargada']=Proveedor::find($data['new_values']['empresaEncargada'])->nombreEmpresa;

      //fechaRecepcionTaller
      if(Arr::has($data,'old_values.fechaRecepcionTaller'))
      $data['old_values']['fechaRecepcionTaller']=\Helper::fecha($data['old_values']['fechaRecepcionTaller']);

      if (Arr::has($data,'new_values.fechaRecepcionTaller'))
      $data['new_values']['fechaRecepcionTaller']=\Helper::fecha($data['new_values']['fechaRecepcionTaller']);

      //fechaRetornoTaller
      if(Arr::has($data,'old_values.fechaRetornoTaller'))
      if(!empty($data['old_values']['fechaRetornoTaller']))$data['old_values']['fechaRetornoTaller']=\Helper::fecha($data['old_values']['fechaRetornoTaller']);

      if (Arr::has($data,'new_values.fechaRetornoTaller'))
      if(!empty($data['new_values']['fechaRetornoTaller']))$data['new_values']['fechaRetornoTaller']=\Helper::fecha($data['new_values']['fechaRetornoTaller']);

      //costoMantenimiento
      if(Arr::has($data,'old_values.costoMantenimiento'))
      if(!empty($data['old_values']['costoMantenimiento']))$data['old_values']['costoMantenimiento']='$ '.\Helper::dinero($data['old_values']['costoMantenimiento']);

      if (Arr::has($data,'new_values.costoMantenimiento'))
      if(!empty($data['new_values']['costoMantenimiento']))$data['new_values']['costoMantenimiento']='$ '.\Helper::dinero($data['new_values']['costoMantenimiento']);

      return $data;
    }
  }
