<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    //
    protected $table="prestamos";
    protected $fillable = ['evento','nombreSolicitante','DUISolicitante','telefonoSolicitante','observacionPrestamo'
        ,'fechaEntregaPrestamo', 'fechaDevolucionPrestamo','pdfPrestamo','idInstitucion'];

    public function institucion()
    {
        return $this->belongsTo(Instituciones::class, "idInstitucion");
    }
    public function activos()
    {
        return $this->belongsToMany(Activos::class)->withTimestamps();
    }

    public static function prestamoRango($fechaInicio,$fechaFin)
    {
      return DB::table('prestamos')
      ->join('instituciones', 'prestamos.idInstitucion', '=', 'instituciones.id')
      ->where('prestamos.fechaEntregaPrestamo','>=',$fechaInicio)
      ->where('prestamos.fechaEntregaPrestamo','<=',$fechaFin)
      ->select('nombreInstitucion','prestamos.*')
      ->get();

    }

}
