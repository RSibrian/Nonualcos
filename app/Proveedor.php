<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;

class Proveedor extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    protected $table = 'proveedores';
  protected $fillable = [
      'nombreEmpresa','nombreEncargado', 'email','telefonoProve','tipoProveedor'
  ];

  /**
  * {@inheritdoc}
  */
  //fución para cambiar los datos guardados en la auditoría
  public function transformAudit(array $data): array
  {
    //Tipo de proveedor
    if(Arr::has($data,'old_values.tipoProveedor')){
      if($data['old_values']['tipoProveedor']==1)$data['old_values']['tipoProveedor']="Proveedor";
      if($data['old_values']['tipoProveedor']==2)$data['old_values']['tipoProveedor']="Mantenimiento";
      if($data['old_values']['tipoProveedor']==3)$data['old_values']['tipoProveedor']="Proveedor y Mantenimiento";
    }
    if(Arr::has($data,'new_values.tipoProveedor')){
      if($data['new_values']['tipoProveedor']==1)$data['new_values']['tipoProveedor']="Proveedor";
      if($data['new_values']['tipoProveedor']==2)$data['new_values']['tipoProveedor']="Mantenimiento";
      if($data['new_values']['tipoProveedor']==3)$data['new_values']['tipoProveedor']="Proveedor y Mantenimiento";
    }
    return $data;
  }

}
