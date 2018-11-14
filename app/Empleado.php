<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = 'empleados';
    protected $fillable = [
        'generoEmpleado','estadoCivilEmpleado','nombresEmpleado','apellidosEmpleado',
        'fechaNacimientoEmpleado','fechaIngreso','telefonoEmpleado','DUIEmpleado',
        'NITEmpleado','dirreccionEmpleado','observacionEmpleado','imagenEmpleado',
        'sistemaContratacion','salarioBruto','idCargo','idSeguro','numeroSeguro',
        'idAFP','numeroAFP'
    ];
    public function cargo()
    {
        return $this->belongsTo(Cargo::class,'idCargo');
    }
    public function seguro()
    {
        return $this->belongsTo(Aportaciones::class,'idSeguro');
    }
    public function AFP()
    {
        return $this->belongsTo(Aportaciones::class,'idAFP');
    }
    public function permisos()
    {
        return $this->hasMany(Permiso::class,'idEmpleado');
    }
    public function activosEmpleados()
    {
        return $this->hasMany(ActivosEmpleados::class,'idEmpleado');
    }

    public static function EmpleadosxUnidad($idUnidad){
      return DB::table('empleados')
      ->join('cargos', 'empleados.idCargo', '=', 'cargos.id')
      ->where('cargos.idUnidad','=',$idUnidad)
      ->select('empleados.id','empleados.nombresEmpleado',"empleados.apellidosEmpleado")
          // ->orderBy('sa_en_vehiculos.id','desc')
      ->get();
  }

}
