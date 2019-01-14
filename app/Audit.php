<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
  protected $table="audits";

  public function user()
  {
      return $this->belongsTo(User::class,'user_id');
  }
  public function tipo()
{
  $tipo=substr(strrchr($this->auditable_type, "\\"), 1);
  if($tipo=="User")$tipo="Usuario";
  if($tipo=="Role")$tipo="Rol de Usuario";
  if($tipo=="ActivosUnidades")$tipo="Traslado de Activo";

    return $tipo;
  }
  public function accion()
  { $tipo="";
    if ($this->event=="created")$tipo="Crear";
    if ($this->event=="updated")$tipo="Actualizar";
    return $tipo;
  }
}
