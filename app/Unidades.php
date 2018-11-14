<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
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
