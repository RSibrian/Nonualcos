<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;

class Cargo extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;

    protected $table = 'cargos';
    protected $fillable = [
        'idUnidad','nombreCargo'
    ];
    //convierte la primera letra de cada nombre en mayúscula y el resto en minúscula
    public function setNombreCargoAttribute($value)
    {
      $value=mb_convert_encoding(mb_convert_case($value, MB_CASE_TITLE), "UTF-8");
      $this->attributes['nombreCargo'] = ucwords(strtolower($value));
    }

    public function unidad()
    {
        return $this->belongsTo(Unidades::class,'idUnidad');
    }
    public function empleados()
    {
        return $this->hasMany(Empleado::class,'idCargo');
    }

    /**
    * {@inheritdoc}
    */
    //fución para transformar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      if (Arr::has($data,'old_values.idUnidad'))
        if(isset($data['old_values']['idUnidad']))
          $data['old_values']['idUnidad']=Unidades::find($this->getOriginal('idUnidad'))->nombreUnidad;
      if (Arr::has($data,'new_values.idUnidad'))
        $data['new_values']['idUnidad']=Unidades::find($this->getAttribute('idUnidad'))->nombreUnidad;

      return $data;
    }
}
