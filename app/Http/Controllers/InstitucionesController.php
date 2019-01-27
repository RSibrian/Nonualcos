<?php

namespace App\Http\Controllers;

use App\Instituciones;
use Illuminate\Http\Request;
use App\Http\Requests\InstitucionRequest;


class InstitucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $instituciones=Instituciones::All();
        return view('prestamos.instituciones.index',compact('instituciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('prestamos.instituciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitucionRequest $request)
    {
        //
        Instituciones::create($request->all());
        return redirect('/instituciones')->with('create','Se ha creado con éxito el registro de una Instutución.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Instituciones  $instituciones
     * @return \Illuminate\Http\Response
     */
    public function show(Instituciones $institucion)
    {
        //
        return view('prestamos.instituciones.show',compact('institucion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Instituciones  $instituciones
     * @return \Illuminate\Http\Response
     */
    public function edit(Instituciones $institucion)
    {
        //
        return view('prestamos.instituciones.edit',compact('institucion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Instituciones  $instituciones
     * @return \Illuminate\Http\Response
     */
    public function update(InstitucionRequest $request, Instituciones $institucion)
    {
        //
        $institucion->update($request->all());
        return redirect('/instituciones')->with('update','Se ha editado correctamente el registro de una Institución.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Instituciones  $instituciones
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instituciones $institucion)
    {
        //
    }
}
