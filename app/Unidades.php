<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Unidades extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table = 'unidades';
    protected $fillable = [
        'codigoUnidad','nombreUnidad'
    ];
    public function cargos()
    {
        return $this->hasMany(Cargo::class,'idUnidad');
    }
    public function activosUnidades()
    {
        return $this->hasMany(ActivosUnidades::class,'idUnidad');
    }
}
