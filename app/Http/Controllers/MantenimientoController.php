<?php

namespace App\Http\Controllers;

use App\Mantenimiento;
use App\Activos;
use App\Empleado;
use App\Proveedor;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\MantenimientoRequest;

class MantenimientoController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    $mantenimientos=Mantenimiento::All();
    return view('mantenimientos.index',compact('mantenimientos'));
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $raw= DB::raw("CONCAT (nombresEmpleado, ' ', apellidosEmpleado) as fullName");
    $empleados=Empleado::select($raw,'id')->pluck('fullName','id');
    $proveedores=Proveedor::pluck('nombreEmpresa','id');
    $date = Carbon::now();
    return view('mantenimientos.create',compact('date','empleados','proveedores'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(MantenimientoRequest $request)
  {
    // // sustituirá el codigoInventario por el idActivo del artículo antes de validar
    // $request['idActivo']=Activos::select('id')->where('codigoInventario',$request['idActivo'])->first();
    // if ($request['idActivo']!=null)$request['idActivo']=$request['idActivo']->id;

    Mantenimiento::create($request->all());
    return redirect('/mantenimientos')->with('create','Se ha registrado con éxito el mantenimiento');
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Mantenimiento  $mantenimiento
  * @return \Illuminate\Http\Response
  */
  public function show(Mantenimiento $mantenimiento)
  {
    return view('mantenimientos.show',compact('mantenimiento'));

  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Mantenimiento  $mantenimiento
  * @return \Illuminate\Http\Response
  */
  public function edit(Mantenimiento $mantenimiento)
  {
    $raw= DB::raw("CONCAT (nombresEmpleado, ' ', apellidosEmpleado) as fullName");
    $empleados=Empleado::select($raw,'id')->pluck('fullName','id');
    $date = Carbon::now();
    return view('mantenimientos.edit',compact('date','empleados','mantenimiento'));
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Mantenimiento  $mantenimiento
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, Mantenimiento $mantenimiento)
  {
    $mantenimiento->update($request->all());
    return redirect('/mantenimientos')->with('update','La actualización del mantenimiento se ha realizado con éxito');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  \App\Mantenimiento  $mantenimiento
  * @return \Illuminate\Http\Response
  */
  public function destroy(Mantenimiento $mantenimiento)
  {
    //
  }

  /**
  * Show the form for creating a new resource.
  * @param  \App\Mantenimiento
  * @return \Illuminate\Http\Response
  */
  public function autocompletarActivos(Request $request)
  {
    $data = Activos::select("id as value","codigoInventario as value1","nombreActivo as value2")
    ->where("codigoInventario","LIKE","{$request->input('query')}%")
    ->get();

    return response()->json($data);
  }
}
