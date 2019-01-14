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
        'codigoTipo','nombreTipo','idTipoLey'
    ];
    public function tipoLeyes()
    {
        return $this->belongsTo(TipoLeyes::class,'idTipoLey');
    }


}
