<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use App\Banco;
use App\Empleado;

class Descuento extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table="descuentos";
    protected $fillable = [
        'idEmpleado','banco_id','pago','observacionDescuento',
        'imagenInicio','estadoDescuento','numeroCuenta','tipoDescuento'
    ];
    protected $auditExclude = [
          'imagenInicio','imagenFinal'
      ];
    public function banco()
    {
        return $this->belongsTo(Banco::class);
    }

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //idEmpleado
      if(Arr::has($data,'old_values.idEmpleado'))
      if(!empty($data['old_values']['idEmpleado']))
      $data['old_values']['idEmpleado']=Empleado::find($data['old_values']['idEmpleado'])->fullName;

      if (Arr::has($data,'new_values.idEmpleado'))
      if(!empty($data['new_values']['idEmpleado']))
      $data['new_values']['idEmpleado']=Empleado::find($data['new_values']['idEmpleado'])->fullName;

      //banco_id
      if(Arr::has($data,'old_values.banco_id'))
      if(!empty($data['old_values']['banco_id']))
      $data['old_values']['banco_id']=Banco::find($data['old_values']['banco_id'])->ban_nombre;

      if (Arr::has($data,'new_values.banco_id'))
      if(!empty($data['new_values']['banco_id']))
      $data['new_values']['banco_id']=Banco::find($data['new_values']['banco_id'])->ban_nombre;

      //tipoDescuento
      if(Arr::has($data,'old_values.tipoDescuento')){
        if($data['old_values']['tipoDescuento']==1)$data['old_values']['tipoDescuento']="Préstamo";
        if($data['old_values']['tipoDescuento']==2)$data['old_values']['tipoDescuento']="Cuota Alimentaria";
        if($data['old_values']['tipoDescuento']==3)$data['old_values']['tipoDescuento']="Otro";
      }

      if (Arr::has($data,'new_values.tipoDescuento')){
        if($data['new_values']['tipoDescuento']==1)$data['new_values']['tipoDescuento']="Préstamo";
        if($data['new_values']['tipoDescuento']==2)$data['new_values']['tipoDescuento']="Cuota Alimentaria";
        if($data['new_values']['tipoDescuento']==3)$data['new_values']['tipoDescuento']="Otro";
      }

      //estadoDescuento
      if(Arr::has($data,'old_values.estadoDescuento'))
      $data['old_values']['estadoDescuento']==1?
      $data['old_values']['estadoDescuento']="Activo":
      $data['old_values']['estadoDescuento']="Finalizado";

      if (Arr::has($data,'new_values.estadoDescuento'))
      $data['new_values']['estadoDescuento']==1?
      $data['new_values']['estadoDescuento']="Activo":
      $data['new_values']['estadoDescuento']="Finalizado";

      //pago
      if(Arr::has($data,'old_values.pago'))
      $data['old_values']['pago']='$ '.\Helper::dinero($data['old_values']['pago']);

      if (Arr::has($data,'new_values.pago'))
      $data['new_values']['pago']='$ '.\Helper::dinero($data['new_values']['pago']);

      return $data;
    }
}
