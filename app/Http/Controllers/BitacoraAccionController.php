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
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BitacoraAccionController extends Controller
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
      return view('bitacoraAcciones.index',compact('audits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BitacoraAccion  $bitacoraAccion
     * @return \Illuminate\Http\Response
     */
    public function show(BitacoraAccion $bitacoraAccion)
    {
        //
        return view('bitacoraAcciones.show',compact('bitacoraAccion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BitacoraAccion  $bitacoraAccion
     * @return \Illuminate\Http\Response
     */
    public function edit(BitacoraAccion $bitacoraAccion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BitacoraAccion  $bitacoraAccion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BitacoraAccion $bitacoraAccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BitacoraAccion  $bitacoraAccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(BitacoraAccion $bitacoraAccion)
    {
        //
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

      $audit = $article->audits()->latest()->first();
      $details=view('bitacoraAcciones.details',compact('audit'))->render();
      return response()->json($details);
    }
}
