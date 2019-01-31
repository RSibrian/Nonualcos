<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ClasificacionesActivos extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table = 'clasificaciones_activos';
    protected $fillable = [
        'codigoTipo','nombreTipo'
    ];

    public function setNombreTipoAttribute($value)
    {
      $this->attributes['nombreTipo'] = \Helper::cadena($value);
    }


}
