<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use App\Empleado;

class Permiso extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table="permisos";
    protected $fillable = [
        'idEmpleado','fechaPermisoInicio','fechaPermisoFinal','tipoPermiso',
        'casoPermiso','motivoPermiso','permisoPdf','perm_opcion'
    ];
    protected $auditExclude = [
          'permisoPdf',
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

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //idEmpleado
      if(Arr::has($data,'old_values.idEmpleado'))
      if(!empty($data['old_values']['idEmpleado']))
      $data['old_values']['idEmpleado']=Empleado::find($data['old_values']['idEmpleado'])->fullName;

      if (Arr::has($data,'new_values.idEmpleado'))
      if(!empty($data['new_values']['idEmpleado']))
      $data['new_values']['idEmpleado']=Empleado::find($data['new_values']['idEmpleado'])->fullName;

      //fechaPermisoInicio
      if(Arr::has($data,'old_values.fechaPermisoInicio'))
      $data['old_values']['fechaPermisoInicio']=\Helper::fecha($data['old_values']['fechaPermisoInicio']);

      if (Arr::has($data,'new_values.fechaPermisoInicio'))
      $data['new_values']['fechaPermisoInicio']=\Helper::fecha($data['new_values']['fechaPermisoInicio']);

      //fechaPermisoInicio
      if(Arr::has($data,'old_values.fechaPermisoFinal'))
      $data['old_values']['fechaPermisoFinal']=\Helper::fecha($data['old_values']['fechaPermisoFinal']);

      if (Arr::has($data,'new_values.fechaPermisoFinal'))
      $data['new_values']['fechaPermisoFinal']=\Helper::fecha($data['new_values']['fechaPermisoFinal']);

      //tipoPermiso
      if(Arr::has($data,'old_values.tipoPermiso')){
        if($data['old_values']['tipoPermiso']==1)$data['old_values']['tipoPermiso']="Permiso con goce de Sueldo";
        if($data['old_values']['tipoPermiso']==2)$data['old_values']['tipoPermiso']="Permiso sin goce de Sueldo";
        if($data['old_values']['tipoPermiso']==3)$data['old_values']['tipoPermiso']="Permiso de Salud";
        if($data['old_values']['tipoPermiso']==4)$data['old_values']['tipoPermiso']="Incapacidad (Inicial)";
        if($data['old_values']['tipoPermiso']==5)$data['old_values']['tipoPermiso']="Incapacidad (Prórroga)";
      }

      if (Arr::has($data,'new_values.tipoPermiso')){
        if($data['new_values']['tipoPermiso']==1)$data['new_values']['tipoPermiso']="Permiso con goce de Sueldo";
        if($data['new_values']['tipoPermiso']==2)$data['new_values']['tipoPermiso']="Permiso sin goce de Sueldo";
        if($data['new_values']['tipoPermiso']==3)$data['new_values']['tipoPermiso']="Permiso de Salud";
        if($data['new_values']['tipoPermiso']==4)$data['new_values']['tipoPermiso']="Incapacidad (Inicial)";
        if($data['new_values']['tipoPermiso']==5)$data['new_values']['tipoPermiso']="Incapacidad (Prórroga)";
      }

      //casoPermiso
      if(Arr::has($data,'old_values.casoPermiso')){
        if($data['old_values']['casoPermiso']=="Enfermadad")$data['old_values']['casoPermiso']="Enfermedad";
        if($data['old_values']['casoPermiso']=="Particular")$data['old_values']['casoPermiso']="Particular";
        //if($data['old_values']['casoPermiso']==3)$data['old_values']['casoPermiso']="Gravedad de Pariente en Duelo";
        if($data['old_values']['casoPermiso']==4)$data['old_values']['casoPermiso']="Enfermedad Común";
        if($data['old_values']['casoPermiso']==5)$data['old_values']['casoPermiso']="Enfermedad Profesional";
        if($data['old_values']['casoPermiso']==6)$data['old_values']['casoPermiso']="Accidente Común";
        if($data['old_values']['casoPermiso']==7)$data['old_values']['casoPermiso']="Accidente de Trabajo";
        if($data['old_values']['casoPermiso']==8)$data['old_values']['casoPermiso']="Maternidad";
        if($data['old_values']['casoPermiso']==9)$data['old_values']['casoPermiso']="Paternidad";

      }

      if (Arr::has($data,'new_values.casoPermiso')){
        if($data['new_values']['casoPermiso']=="Enfermadad")$data['new_values']['casoPermiso']="Enfermedad";
        if($data['new_values']['casoPermiso']=="Particular")$data['new_values']['casoPermiso']="Particular";
        //if($data['new_values']['casoPermiso']==3)$data['new_values']['casoPermiso']="Gravedad de Pariente en Duelo";
        if($data['new_values']['casoPermiso']==4)$data['new_values']['casoPermiso']="Enfermedad Común";
        if($data['new_values']['casoPermiso']==5)$data['new_values']['casoPermiso']="Enfermedad Profesional";
        if($data['new_values']['casoPermiso']==6)$data['new_values']['casoPermiso']="Accidente Común";
        if($data['new_values']['casoPermiso']==7)$data['new_values']['casoPermiso']="Accidente de Trabajo";
        if($data['new_values']['casoPermiso']==8)$data['new_values']['casoPermiso']="Maternidad";
        if($data['new_values']['casoPermiso']==9)$data['new_values']['casoPermiso']="Paternidad";
      }

      return $data;
    }
}
