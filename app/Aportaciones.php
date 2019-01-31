<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aportaciones extends Model
{
  protected $table = 'aportaciones';
  protected $fillable = [
      'nombreAportacion','descripcionAportacion','tipoAportacion','desEmpleadoAportacion',
      'despatronAportacion','estadoAportacion',
      ];
}
