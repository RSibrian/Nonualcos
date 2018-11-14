<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoLeyes extends Model
{
  protected $table = 'tipo_leyes';
  protected $fillable = [
      'nombreLey','valorPorcentaje'
  ];
}
