<?php

namespace App;

use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Redactors\RightRedactor;
use Illuminate\Support\Arr;

class User extends Authenticatable implements Auditable
{
  use Notifiable,ShinobiTrait,\OwenIt\Auditing\Auditable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'email', 'password','idEmpleado'
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];
  /**
  * Attributes to exclude from the Audit.
  *
  * @var array
  */
  protected $auditExclude = [
    'remember_token',
  ];
  /**
  * Attribute modifiers.
  *
  * @var array
  */
  protected $attributeModifiers = [
    'password' => RightRedactor::class,
  ];

  /*   public function tipoUsuatios()
  {
  return $this->hasMany(TipoUsuario::class);
}*/
public function empleado()
{
  return $this->belongsTo(Empleado::class,'idEmpleado');
}
/**
* {@inheritdoc}
*/
//fución para cambiar los datos guardados en la auditoría
public function transformAudit(array $data): array
{
  if (Arr::has($data,'old_values.idEmpleado'))
    if(!empty($data['old_values']['idEmpleado']))$data['old_values']['idEmpleado']=Empleado::find($data['old_values']['idEmpleado'])->fullName;

    if(Arr::has($data,'new_values.idEmpleado'))
    if(!empty($data['new_values']['idEmpleado']))$data['new_values']['idEmpleado']=$this->Empleado->fullName;

    return $data;
  }

  public function bitacoraUsuario()
    {
      return $this->hasMany(BitacoraUsuario::class);
    }

}
