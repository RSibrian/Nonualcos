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
use App\TelefonoEmpleado;
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
        $empleados=Empleado::all()->where('estadoEmpleado',1);
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

        $emp=Empleado::create($request->all());
        for ($i=0; $i < 3; $i++) {
          if ($request['telefonoEmpleado.'.$i]!=null) {
            $tel=new TelefonoEmpleado();
            $tel->telefonoEmpleado=$request['telefonoEmpleado.'.$i];
            $tel->tipoTelefono=$request['tipoTelefono.'.$i];
            $tel->idEmpleado=$emp->id;
            $tel->save( );
          }
        }
        return redirect('/empleados')->with('create','Se ha creado con éxito el registro de empleado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
      $telefonos=TelefonoEmpleado::where('idEmpleado',$empleado->id);
        return view('empleados.show',compact('empleado','telefonos'));
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
        $tels=TelefonoEmpleado::where('idEmpleado', $empleado->id)->get();
        return view('empleados.edit',
            compact('empleado','aportaciones','seguro','unidades','cargos','tels'));
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

        for ($i=0; $i < 3; $i++) {
          $tel=new TelefonoEmpleado();
          if(isset($empleado->telefonosEmpleado[$i])) $tel=$empleado->telefonosEmpleado[$i];
          if ($request['telefonoEmpleado.'.$i]!=null) {
            $tel->telefonoEmpleado=$request['telefonoEmpleado.'.$i];
            $tel->tipoTelefono=$request['tipoTelefono.'.$i];
            $tel->idEmpleado=$empleado->id;
            $tel->save();
          }else{
            $tel->delete()?'':'';
          }
        }
        return redirect("/empleados/{$empleado->id}")->with('update','Se ha editado correctamente el registro de empleado');
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

    public function reporteEmpleado()
        {

          $empleados=Empleado::All();


          $date = date('d-m-Y');
          $date1 = date('g:i:s a');
          //dd($date);
          $vistaurl="empleados.reporteEmpleado";
          $view =  \View::make($vistaurl, compact('empleados', 'date','date1'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->setPaper('letter', 'landscape');

          $pdf->loadHTML($view);
          return $pdf->stream('Listado de Empleados '.'-'.$date.'.pdf');
        }

        public function reporteExpediente($idEmpleado)
            {

              $empleado=Empleado::find($idEmpleado);


              $date = date('d-m-Y');
              $date1 = date('g:i:s a');
              //dd($date);
              $vistaurl="empleados.reporteExpediente";
              $view =  \View::make($vistaurl, compact('empleado', 'date','date1'))->render();
              $pdf = \App::make('dompdf.wrapper');
              $pdf->setPaper('letter', 'portrait');

              $pdf->loadHTML($view);
              return $pdf->stream('Expediente de Empleado '.$empleado->nombresEmpleado.' '.$empleado->apellidosEmpleado.'-'.$date.'.pdf');
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
