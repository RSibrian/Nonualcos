<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Unidades extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table = 'unidades';
    protected $fillable = [
        'codigoUnidad','nombreUnidad'
    ];
    //convierte la primera letra de cada nombre en mayúscula y el resto en minúscula
    public function setNombreUnidadAttribute($value)
    {
      //para caracteres tildados
      $value=mb_convert_encoding(mb_convert_case($value, MB_CASE_TITLE), "UTF-8");
      $this->attributes['nombreUnidad'] = ucwords(strtolower($value));
    }
    public function cargos()
    {
        return $this->hasMany(Cargo::class,'idUnidad');
    }
    public function activosUnidades()
    {
        return $this->hasMany(ActivosUnidades::class,'idUnidad');
    }
}
