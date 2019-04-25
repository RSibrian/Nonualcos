<?php

namespace App\Http\Controllers;

use App\Audit;
use App\User;
use App\Unidades;
use App\Cargo;
use App\Empleado;
use App\ClasificacionesActivos;
use App\Activos;
use App\Proveedor;
use App\Mantenimiento;
use App\Vale;
use App\Permiso;
use App\Descuento;
use App\ActivosUnidades;
use App\Banco;
use App\EntradasSalidas;
use App\Liquidacion;
use App\Salidas;
use App\Vehiculo;
use App\Instituciones;
use App\Prestamo;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $audits=Audit::orderBy('created_at','desc')->get();
      // dd($audit->getMetadata());
      return view('auditoria.index',compact('audits'));
    }

    public function show(Audit $auditoria)
    {
        //
        return view('auditoria.show',compact('auditoria'));
    }


    public function details(Audit $audit)
    {
      if ($audit->auditable_type==User::class) $article=User::find($audit->auditable_id);
      if ($audit->auditable_type==Role::class) $article=Role::find($audit->auditable_id);
      if ($audit->auditable_type==Unidades::class) $article=Unidades::find($audit->auditable_id);
      if ($audit->auditable_type==Cargo::class) $article=Cargo::find($audit->auditable_id);
      if ($audit->auditable_type==Empleado::class) $article=Empleado::find($audit->auditable_id);
      if ($audit->auditable_type==ClasificacionesActivos::class) $article=ClasificacionesActivos::find($audit->auditable_id);
      if ($audit->auditable_type==Activos::class) $article=Activos::find($audit->auditable_id);
      if ($audit->auditable_type==Proveedor::class) $article=Proveedor::find($audit->auditable_id);
      if ($audit->auditable_type==Mantenimiento::class) $article=Mantenimiento::find($audit->auditable_id);
      if ($audit->auditable_type==Vale::class) $article=Vale::find($audit->auditable_id);
      if ($audit->auditable_type==Permiso::class) $article=Permiso::find($audit->auditable_id);
      if ($audit->auditable_type==Incapacidades::class) $article=Incapacidades::find($audit->auditable_id);
      if ($audit->auditable_type==Descuento::class) $article=Descuento::find($audit->auditable_id);
      if ($audit->auditable_type==ActivosUnidades::class) $article=ActivosUnidades::find($audit->auditable_id);
      if ($audit->auditable_type==Banco::class) $article=Banco::find($audit->auditable_id);
      if ($audit->auditable_type==EntradasSalidas::class) $article=EntradasSalidas::find($audit->auditable_id);
      if ($audit->auditable_type==Liquidacion::class) $article=Liquidacion::find($audit->auditable_id);
      if ($audit->auditable_type==Salidas::class) $article=Salidas::find($audit->auditable_id);
      if ($audit->auditable_type==Vehiculo::class) $article=Vehiculo::find($audit->auditable_id);
      if ($audit->auditable_type==instituciones::class) $article=Instituciones::find($audit->auditable_id);
      if ($audit->auditable_type==Prestamo::class) $article=Prestamo::find($audit->auditable_id);

      $auditt = $article->audits->where('id',$audit->id)->first();
      $details=view('auditoria.details',compact('auditt'))->render();
      return response()->json($details);
    }
}
