<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleadoPlanilla extends Model
{
    //
    protected $table="empleado_planillas";
    protected $fillable = [
        'idEmpleado','idPlanilla','unidad','cargo','salario','dias',
        'salarioDevengado','ISSS','idAFP', 'AFP','renta',
        'llegadasTarde','totalDescuentos','sueldoNeto',
        'ISSSPatronal','AFPPatronal'
    ];
    public function empleado()
    {
        return $this->belongsTo(Empleado::class,'idEmpleado');
    }
}
