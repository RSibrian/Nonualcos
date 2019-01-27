<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrestamoActivo extends Model
{
    //
    protected $table="activos_prestamo";
    protected $fillable = ['activos_id','prestamo_id'];

    public function activo()
    {
        return $this->belongsTo(Activos::class);
    }

}
