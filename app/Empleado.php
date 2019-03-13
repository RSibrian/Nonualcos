<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Carbon\Carbon;
use Illuminate\Support\Arr;
//use Illuminate\Database\Eloquent\SoftDeletes;


class Empleado extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
  //use SoftDeletes;

    protected $table = 'empleados';
    protected $fillable = [
        'generoEmpleado','estadoCivilEmpleado','nombresEmpleado','apellidosEmpleado',
        'fechaNacimientoEmpleado','fechaIngreso','DUIEmpleado',
        'NITEmpleado','dirreccionEmpleado','observacionEmpleado','imagenEmpleado',
        'sistemaContratacion','salarioBruto','idCargo','idSeguro','numeroSeguro',
        'idAFP','numeroAFP'
    ];
    //protected $dates=['deleted_at'];


    //convierte la primera letra de cada nombre en mayúscula y el resto en minúscula
    public function setNombresEmpleadoAttribute($value)
    {
      $this->attributes['nombresEmpleado'] = \Helper::cadena($value);

    }
    //convierte la primera letra de cada nombre en mayúscula y el resto en minúscula
    public function setApellidosEmpleadoAttribute($value)
    {
      $this->attributes['apellidosEmpleado'] = \Helper::cadena($value);
    }

    public function getFullNameAttribute() {
      return $this->nombresEmpleado. ' ' .$this->apellidosEmpleado;
    }

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
    public function descuentos()
    {
        return $this->hasMany(Descuento::class,'idEmpleado');
    }
    public function telefonosEmpleado()
    {
        return $this->hasMany(TelefonoEmpleado::class,'idEmpleado');
    }
    public function ajusteRentas()
    {
        return $this->hasMany(AjusteRenta::class,'idEmpleado');
    }

    public static function EmpleadosxUnidad($idUnidad){
      return DB::table('empleados')
      ->join('cargos', 'empleados.idCargo', '=', 'cargos.id')
      ->where('cargos.idUnidad','=',$idUnidad)
      ->select('empleados.id','empleados.nombresEmpleado',"empleados.apellidosEmpleado")
          // ->orderBy('sa_en_vehiculos.id','desc')
      ->get();
  }
  public static function EmpleadosxUnidadActivos($idUnidad){
    return DB::table('empleados')
    ->join('cargos', 'empleados.idCargo', '=', 'cargos.id')
    ->where('cargos.idUnidad','=',$idUnidad)
    ->where('estadoEmpleado','=',true)
    ->select('empleados.id','empleados.nombresEmpleado',"empleados.apellidosEmpleado")
        // ->orderBy('sa_en_vehiculos.id','desc')
    ->get();
}
    public function entradasSalidas()
    {
        return $this->hasMany(EntradasSalidas::class,'idEmpleado');
    }


    /**
  * {@inheritdoc}
  */
  //fución para cambiar los datos guardados en la auditoría
  public function transformAudit(array $data): array
  {
    //fecha de nacimiento en formato d/m/Y
    if(Arr::has($data,'old_values.fechaNacimientoEmpleado'))
    $data['old_values']['fechaNacimientoEmpleado']=\Helper::fecha($data['old_values']['fechaNacimientoEmpleado']);

    if (Arr::has($data,'new_values.fechaNacimientoEmpleado'))
    $data['new_values']['fechaNacimientoEmpleado']=\Helper::fecha($this->fechaNacimientoEmpleado);

    //fecha de Contratación en formato d/m/Y
    if (Arr::has($data,'old_values.fechaIngreso'))
    $data['old_values']['fechaIngreso']=\Helper::fecha($data['old_values']['fechaIngreso']);

    if (Arr::has($data,'new_values.fechaIngreso'))
    $data['new_values']['fechaIngreso']=\Helper::fecha($this->fechaIngreso);

    //si hay valor de idAFP anterior se cambia al nombre
    if(Arr::has($data,'old_values.idAFP'))
    $data['old_values']['idAFP']=Aportaciones::find($data['old_values']['idAFP'])->nombreAportacion;
    if (Arr::has($data,'new_values.idAFP'))
    $data['new_values']['idAFP']=$this->afp->nombreAportacion;

    //si hay valor de idSeguro anterior se cambia al nombre
    if(Arr::has($data,'old_values.idSeguro'))
    $data['old_values']['idSeguro']=Aportaciones::find($data['old_values']['idSeguro'])->nombreAportacion;
    if (Arr::has($data,'new_values.idSeguro'))
    $data['new_values']['idSeguro']=$this->seguro->nombreAportacion;

    //si hay valor de idCargo anterior se cambia al nombre
    if(Arr::has($data,'old_values.idCargo'))
    $data['old_values']['idCargo']=Cargo::find($data['old_values']['idCargo'])->nombreCargo;
    if (Arr::has($data,'new_values.idCargo'))
    $data['new_values']['idCargo']=$this->cargo->nombreCargo;

    //formato de salario
    if(Arr::has($data,'old_values.salarioBruto'))
    $data['old_values']['salarioBruto']='$ '.\Helper::dinero($data['old_values']['salarioBruto']);
    if (Arr::has($data,'new_values.salarioBruto'))
    $data['new_values']['salarioBruto']='$ '.\Helper::dinero($data['new_values']['salarioBruto']);

    //imagen de perfil
    if(Arr::has($data,'old_values.imagenEmpleado'))
    $data['old_values']['imagenEmpleado']="Foto de perfil antigua";
    if (Arr::has($data,'new_values.imagenEmpleado'))
    if($data['new_values']['imagenEmpleado']=="img/default-avatar.png")$data['new_values']['imagenEmpleado']="Sin Foto de perfil";
    else $data['new_values']['imagenEmpleado']="Nueva Foto de perfil";


    return $data;
  }

}
