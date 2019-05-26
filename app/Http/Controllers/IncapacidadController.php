<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Permiso;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;//intervention Image
use Image;
class IncapacidadController extends Controller
{
    //
    public function store(Request $request)
    {
        //
        if($request['fechaPermisoFinal']==null)
        {
            $request['fechaPermisoFinal']=$request['fechaPermisoInicio'];
        }
        if($request['fechaPermisoInicio']<=$request['fechaPermisoFinal']) {
            if($request['permisoPdf2']==null)
            {
                $request['permisoPdf'] = null;
            }
            else {
                $file = Input::file('permisoPdf2');
                $random = str_random(10);
                $nombre = $random . '-' . $file->getClientOriginalName();
                $nombre = EmpleadoController::eliminar_tildes($nombre);
                //Ruta donde queremos guardar el pdf
                $file->move(public_path() . '/biblioteca/incapacidades/', $nombre);
                $url = '/biblioteca/incapacidades/' . $nombre;
                $request['permisoPdf'] = $url;
            }
            $request['perm_opcion'] = true;
            Permiso::create($request->all());
            $permisoActual = Permiso::all()->last();
            PermisoController::diaPermi($permisoActual);
            return redirect("/incapacidades/" . $request['idEmpleado'])->with('create', 'Se ha creado con éxito el registro de incapacidad');
        }
        else{
            return redirect("/incapacidades/" . $request['idEmpleado'])->with('sin_pass', 'Error de fechas');
        }
    }
    public function show(Empleado $empleado)
    {
        //
        $date = Carbon::now();
        return view('incapacidades.show',compact('empleado','date'));
    }
    public function update(Request $request, Permiso $permiso)
    {
        //
        $file = Input::file('permisoPdf2');
        $random = str_random(10);
        $nombre = "final - " . $random . '-' . $file->getClientOriginalName();
        $nombre = EmpleadoController::eliminar_tildes($nombre);
        //Ruta donde queremos guardar el pdf
        $file->move(public_path() . '/biblioteca/incapacidades/', $nombre);
        $url = '/biblioteca/incapacidades/' . $nombre;
        $request['permisoPdf'] = $url;
        $permiso->permisoPdf = $request['permisoPdf'];
        $permiso->save();
        return redirect("/incapacidades/". $request['idEmpleado'])->with('update','Se ha editado correctamente el registro de la incapacidades');

    }

}
