<?php

namespace App;
use DB;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use App\Instituciones;
use Carbon\Carbon;

class Prestamo extends Model implements Auditable
{
  use \OwenIt\Auditing\Auditable;
    //
    protected $table="prestamos";
    protected $fillable = ['evento','nombreSolicitante','DUISolicitante','telefonoSolicitante','observacionPrestamo'
        ,'fechaEntregaPrestamo', 'fechaDevolucionPrestamo','pdfPrestamo','idInstitucion'];

        protected $auditExclude = [
              'pdfPrestamo',
          ];
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

    /**
    * {@inheritdoc}
    */
    //fución para cambiar los datos guardados en la auditoría
    public function transformAudit(array $data): array
    {
      //dd($data);
      //Institución
      if(Arr::has($data,'old_values.idInstitucion'))
      $data['old_values']['idInstitucion']=Instituciones::find($data['old_values']['idInstitucion'])->nombreInstitucion;

      if (Arr::has($data,'new_values.idInstitucion'))
      $data['new_values']['idInstitucion']=Instituciones::find($data['new_values']['idInstitucion'])->nombreInstitucion;

      //fechaEntregaPrestamo
      if(Arr::has($data,'old_values.fechaEntregaPrestamo'))
      $data['old_values']['fechaEntregaPrestamo']=Carbon::parse($data['old_values']['fechaEntregaPrestamo'])->format('d/m/Y h:i:s a');

      if (Arr::has($data,'new_values.fechaEntregaPrestamo'))
      $data['new_values']['fechaEntregaPrestamo']=Carbon::parse($data['new_values']['fechaEntregaPrestamo'])->format('d/m/Y h:i:s a');

      //fechaDevolucionPrestamo
      if(Arr::has($data,'old_values.fechaDevolucionPrestamo'))
      $data['old_values']['fechaDevolucionPrestamo']=Carbon::parse($data['old_values']['fechaDevolucionPrestamo'])->format('d/m/Y h:i:s a');

      if (Arr::has($data,'new_values.fechaDevolucionPrestamo'))
      $data['new_values']['fechaDevolucionPrestamo']=Carbon::parse($data['new_values']['fechaDevolucionPrestamo'])->format('d/m/Y h:i:s a');

      return $data;
    }

}
