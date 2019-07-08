<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Indemnizacion extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  protected $table = 'indemnizaciones';
  protected $fillable = [
      'tipoInd','fechaFinalizacion','montoInd','idEmpleado','motivoInd'
      ];

      public function empleado()
      {
          return $this->belongsTo(Empleado::class,'idEmpleado');
      }
      /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //fecha
      if(Arr::has($data,'old_values.fechaFinalizacion'))
      $data['old_values']['fechaFinalizacion']=\Helper::fecha($data['old_values']['fechaFinalizacion']);

      if (Arr::has($data,'new_values.fechaFinalizacion'))
      $data['new_values']['fechaFinalizacion']=\Helper::fecha($data['new_values']['fechaFinalizacion']);

      //monto
      if(Arr::has($data,'old_values.montoInd'))
      $data['old_values']['montoInd']='$ '.\Helper::dinero($data['old_values']['montoInd']);

      if (Arr::has($data,'new_values.montoInd'))
      $data['new_values']['montoInd']='$ '.\Helper::dinero($data['new_values']['montoInd']);

      return $data;
    }

}
