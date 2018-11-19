<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquidacion extends Model
{
    //Clase liquidacion

    protected $table = 'liquidaciones';
    protected $fillable = [
        'fechaLiquidacion','numeroFacturaLiquidacion','montoFacturaLiquidacion'
    ];

    public function vale()
    {
        return $this->hasMany(Vale::class, 'idLiquidacion');
    }
}
