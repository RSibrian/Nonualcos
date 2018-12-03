<?php

namespace App\Http\Controllers;

use App\Banco;
use Illuminate\Http\Request;

class BancoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bancos=Banco::all();
        return view('bancos.index',compact('bancos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bancos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Banco::create($request->all());
        return redirect('/bancos')->with('create','Sea creado con éxito el registro');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function show(Banco $banco)
    {
        //
        return view('bancos.show',compact('banco'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function edit(Banco $banco)
    {
        return view('bancos.edit',compact('banco'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banco $banco)
    {
        $banco->update($request->all());
        return redirect("/bancos")->with('update','Sea editado con éxito el registro');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banco  $banco
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banco $banco)
    {
        //
    }
}
