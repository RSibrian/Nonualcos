<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClasificacionesActivos extends Model
{
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
