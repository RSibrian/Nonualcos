<?php

namespace App\Http\Controllers;

use App\Http\Requests\UnidadRequest;
use App\Unidades;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades=Unidades::All();
        return view('unidades.index',compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnidadRequest $request)
    {
        Unidades::create($request->all());
        return redirect('/unidades')->with('create','Sea creado con éxito la Unidad');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unidades  $unidades
     * @return \Illuminate\Http\Response
     */
    public function show(Unidades $unidad)
    {
        return view('unidades.show',compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unidades  $unidades
     * @return \Illuminate\Http\Response
     */
    public function edit(Unidades $unidad)
    {
        return view('unidades.edit',compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unidades  $unidades
     * @return \Illuminate\Http\Response
     */
    public function update(UnidadRequest $request, Unidades $unidad)
    {
        $unidad->update($request->all());
        return redirect('/unidades')->with('update','Sea editado con éxito la Unidad');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unidades  $unidades
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unidades $unidades)
    {
        //
    }

    public function cargosUnidad(Unidades $unidad)
    {
        return view('unidades.cargosUnidad',compact('unidad'));
    }
}
