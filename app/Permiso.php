<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    //
    protected $table="permisos";
    protected $fillable = [
        'idEmpleado','fechaPermisoInicio','fechaPermisoFinal','tipoPermiso',
        'casoPermiso','motivoPermiso','permisoPdf'
    ];
}
