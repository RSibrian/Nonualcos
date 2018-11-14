<?php

namespace App\Http\Controllers;

use App\Aportaciones;
use App\Cargo;
use App\Empleado;
use App\Http\Requests\EmpleadoEditRequest;
use App\Http\Requests\EmpleadoRequest;
use App\Unidades;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;
use Image;
use Illuminate\Support\Facades\Response;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=Empleado::all();
        return view('empleados.index',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $aportaciones=Aportaciones::where('tipoAportacion',2)->orWhere('tipoAportacion',3)->pluck('nombreAportacion','id');
        $seguro=Aportaciones::where('tipoAportacion',1)->orWhere('tipoAportacion',3)->pluck('nombreAportacion','id');
        $unidades=Unidades::pluck('nombreUnidad','id');
        $cargos=Cargo::pluck('nombreCargo','id');
        $date = Carbon::now();
        return view('empleados.create',compact('aportaciones','seguro','cargos','date','unidades'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpleadoRequest $request)
    {
        if($request['per_imagenE']!=null) {
            //obtenemos el campo file definido en el formulario
            $file = Input::file('per_imagenE');
            $random = str_random(10);
            $nombre = $request['nombresEmpleado'] . " - " . $random . '-' . $file->getClientOriginalName();
            $nombre = EmpleadoController::eliminar_tildes($nombre);
            //Ruta donde queremos guardar las imagenes
            $path = public_path('/biblioteca/empleados/' . $nombre);
            $url = '/biblioteca/empleados/' . $nombre;
            $image = Image::make($file->getRealPath());
            $image->save($path);
            $request['imagenEmpleado'] = $url;
        }
        else {
            $request['imagenEmpleado'] = 'img/default-avatar.png';
        }
        Empleado::create($request->all());
        return redirect('/empleados')->with('create','Sea creado con éxito el Empleado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        return view('empleados.show',compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        $aportaciones=Aportaciones::where('tipoAportacion',2)->orWhere('tipoAportacion',3)->pluck('nombreAportacion','id');
        $seguro=Aportaciones::where('tipoAportacion',1)->orWhere('tipoAportacion',3)->pluck('nombreAportacion','id');
        $unidades=Unidades::pluck('nombreUnidad','id');
        $cargos=Cargo::pluck('nombreCargo','id');
        return view('empleados.edit',
            compact('empleado','aportaciones','seguro','unidades','cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(EmpleadoEditRequest $request, Empleado $empleado)
    {
        if($request['per_imagenE']!=null)
        {
            //obtenemos el campo file definido en el formulario
            $file = Input::file('per_imagenE');
            $random=str_random(10);
            $nombre = $request['nombresEmpleado']." - ".$random.'-'.$file->getClientOriginalName();
            $nombre=EmpleadoController::eliminar_tildes($nombre);
            //Ruta donde queremos guardar las imagenes
            $path = public_path('/biblioteca/empleados/'.$nombre);
            $url = '/biblioteca/empleados/'.$nombre;
            $image = Image::make($file->getRealPath());
            $image->save($path);
            $request['imagenEmpleado']=$url;
        }
        $empleado->update($request->all());
        return redirect("/empleados/{$empleado->id}")->with('update','Sea editado con éxito el empleado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
    public function codigoGenerado(Unidades $unidad){
        $cargos=$unidad->cargos;
        return Response::json($cargos);
    }
    static function eliminar_tildes($cadena){

        //Codificamos la cadena en formato utf8 en caso de que nos de errores
        //  $cadena = utf8_encode($cadena);
        //Ahora reemplazamos las letras
        $cadena = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $cadena
        );
        $cadena = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $cadena );

        $cadena = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $cadena );

        $cadena = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
            $cadena );

        $cadena = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $cadena );

        $cadena = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç'),
            array('n', 'N', 'c', 'C'),
            $cadena
        );
        // $cadena = preg_replace("/[^a-zA-Z0-9\_\-]+/", "", $cadena);

        return $cadena;
    }
}
