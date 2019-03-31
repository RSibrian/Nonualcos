<?php

namespace App\Http\Controllers;

use App\Banco;
use App\Descuento;
use App\Empleado;
use Illuminate\Http\Request;
use Input;//intervention Image
use Image;
use App\Http\Requests\DescuentoRequest;

class DescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(DescuentoRequest $request)
    {
        //
        $file = Input::file('pre_imagen2');
        $random = str_random(10);
        $nombre = "inicio - ".$random . '-' . $file->getClientOriginalName();
        $nombre = EmpleadoController::eliminar_tildes($nombre);
        //Ruta donde queremos guardar el pdf
        $file->move(public_path() . '/biblioteca/descuentos/', $nombre);
        $url = '/biblioteca/descuentos/' . $nombre;
        $request['imagenInicio'] = $url;
        Descuento::create($request->all());
        return redirect("/descuentos/" . $request['idEmpleado'])->with('create', 'Se ha creado con éxito el registro de descuento de empleado');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        $bancos=Banco::pluck('ban_nombre','id');
        $salario=$empleado->salarioBruto;
        $cuota_max=$salario*0.20;
        $descuentos=$empleado->descuentos()->where('estadoDescuento',true)->get();
        $sumatoria_prestamo=0;
        foreach ($descuentos as $descuento)
        {
            $sumatoria_prestamo+=$descuento->pago;
        }
        return view('descuentos.show',compact('empleado','bancos','sumatoria_prestamo','cuota_max'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function edit(Descuento $descuento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Descuento $descuento)
    {
        //
      //  dd($request);
        $file = Input::file('pre_imagen2');
        $random = str_random(10);
        $nombre = "final - ".$random . '-' . $file->getClientOriginalName();
        $nombre = EmpleadoController::eliminar_tildes($nombre);
        //Ruta donde queremos guardar el pdf
        $file->move(public_path() . '/biblioteca/descuentos/', $nombre);
        $url = '/biblioteca/descuentos/' . $nombre;
        $request['imagenFinal'] = $url;


        $descuento->imagenFinal=$request['imagenFinal'] ;
        $descuento->estadoDescuento=0;
        $descuento->observacionDescuento=$request['observacionDescuento'] ;
        $descuento->save();
        return redirect("/descuentos/". $request['idEmpleado'])->with('update','Se ha editado correctamente el registro de descuento');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Descuento  $descuento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Descuento $descuento)
    {
        //
    }
}
