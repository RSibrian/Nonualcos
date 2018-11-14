<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CuentaBancariaRequest;
use App\CuentaBancaria;

class CuentaBancariaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $cuentas=CuentaBancaria::All();
      return view('cuentas.index',compact('cuentas'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      return view('cuentas.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(CuentaBancariaRequest $request)
  {
      CuentaBancaria::create($request->all());
      return redirect('/cuentas')->with('create','Se ha creado con éxito la Cuenta Bancaria');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\CuentaBancaria  $cuenta
   * @return \Illuminate\Http\Response
   */
  public function edit(CuentaBancaria $cuenta)
  {
      return view('cuentas.edit',compact('cuenta'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\CuentaBancaria  $cuenta
   * @return \Illuminate\Http\Response
   */
  public function update(CuentaBancariaRequest $request, CuentaBancaria $cuenta)
  {
      $cuenta->update($request->all());
      return redirect('/cuentas')->with('update','Se ha editado con éxito la Cuenta Bancaria');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\CuentaBancaria  $cuenta
   * @return \Illuminate\Http\Response
   */
  public function destroy(CuentaBancaria $cuenta)
  {
      //
  }
}
