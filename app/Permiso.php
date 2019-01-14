<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
class Permiso extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table="permisos";
    protected $fillable = [
        'idEmpleado','fechaPermisoInicio','fechaPermisoFinal','tipoPermiso',
        'casoPermiso','motivoPermiso','permisoPdf','perm_opcion'
    ];
    public function diaPermiso()
    {
        return $this->hasMany(DiaPermiso::class);
    }
    public static function diaPermisoDB($persona_id,$fecha){
        return DB::table('permisos')
            ->join('dia_permisos', 'dia_permisos.permiso_id', '=', 'permisos.id')
            ->where('permisos.idEmpleado','=',$persona_id )
            ->where('dia_permisos.dip_fecha','<',$fecha)
            ->select('permisos.*', 'dia_permisos.*')
            ->orderBy('dia_permisos.dip_fecha','asc')
            ->get();
    }
}
