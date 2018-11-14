<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Permiso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;//intervention Image
use Image;

class PermisoController extends Controller
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
    public function store(Request $request)
    {
        //
        if($request['fechaPermisoFinal']==null)
        {
            $request['fechaPermisoFinal']=$request['fechaPermisoInicio'];
        }
        if($request['fechaPermisoInicio']<=$request['fechaPermisoFinal']) {
            $file = Input::file('permisoPdf2');// convertir a input
            $random = str_random(10); // crear 10 letras ramdom
            $nombre = $random . '-' . $file->getClientOriginalName();//nombre archivo
            $nombre = EmpleadoController::eliminar_tildes($nombre);//eliminar las tildes
            //Ruta donde queremos guardar el pdf
            $file->move(public_path() . '/biblioteca/permisos/', $nombre);//a la ruta establecida copia y pega el archivo
            $url = '/biblioteca/permisos/' . $nombre;
            $request['permisoPdf'] = $url;
            Permiso::create($request->all());
            return redirect("/permisos/" . $request['idEmpleado'])->with('create', 'Sea creado con éxito el permiso');
        }
        else{
            return redirect("/permisos/" . $request['idEmpleado'])->with('sin_pass', 'Fechas incorrectas');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
        $date = Carbon::now();
        return view('permisos.show',compact('empleado','date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
