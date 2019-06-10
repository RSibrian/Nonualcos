<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AjusteRenta extends Model
{
    //
    protected $table="ajuste_rentas";
    protected $fillable = [
        'idEmpleado','salario','AFP','ISSS','renta'
    ];
}
