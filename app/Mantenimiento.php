<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Activos;
use App\Empleado;
use App\Proveedor;
use Carbon\Carbon;
use OwenIt\Auditing\Contracts\Audit;
use OwenIt\Auditing\Contracts\Auditable;

class Mantenimiento extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  //
  protected $table = 'mantenimientos';
  protected $fillable = [
    'id','fechaRecepcionTaller','reparacionesSolicitadas','personalSolicitaMantenimiento','reparacionesRealizadas','empresaEncargada','nombreEncargado','fechaRetornoTaller','costoMantenimiento','personalRecibeMantenimiento','idActivo',];
    protected $dates=['fechaRecepcionTaller','fechaRetornoTaller'];

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
  }
