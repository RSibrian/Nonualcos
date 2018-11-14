<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'cargos';
    protected $fillable = [
        'idUnidad','nombreCargo'
    ];
    public function unidad()
    {
        return $this->belongsTo(Unidades::class,'idUnidad');
    }
    public function empleados()
    {
        return $this->hasMany(Empleado::class,'idCargo');
    }
}
