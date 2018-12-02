<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DiaPermiso extends Model
{
    //
    protected $table="dia_permisos";
    protected $fillable = [
        'dip_dias','dip_dias_descontados','dip_año','dip_mes','dip_fecha',
        'permiso_id'
    ];
    public function permiso()
    {
        return $this->belongsTo(Permisos::class);
    }
}
