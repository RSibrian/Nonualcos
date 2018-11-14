<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activos;
use Carbon\Carbon;

class Mantenimiento extends Model
{
    //
    protected $table = 'mantenimientos';
    protected $fillable = [
        'id','fechaRecepcionTaller','reparacionesRealizadas','empresaEncargada','fechaEntregaMantenimiento','costoMantenimiento','personalRecibeMantenimiento','idActivo',];
    protected $dates=['fechaRecepcionTaller','fechaEntregaMantenimiento'];

        public function Activos()
        {
            return $this->belongsTo(Activos::class,'idActivo');
        }
}
