<?php

namespace App\Http\Controllers;

use App\BitacoraAccion;
use Illuminate\Http\Request;

class BitacoraAccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $acciones=BitacoraAccion::All();
      return view('bitacoraAcciones.index',compact('acciones'));
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
}
