<?php

namespace App\Http\Controllers;

use App\DiaPermiso;
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
            if($request['permisoPdf2']==null)
            {
                $request['permisoPdf'] = null;
            }
            else {
                $file = Input::file('permisoPdf2');// convertir a input
                $random = str_random(10); // crear 10 letras ramdom
                $nombre = $random . '-' . $file->getClientOriginalName();//nombre archivo
                $nombre = EmpleadoController::eliminar_tildes($nombre);//eliminar las tildes
                //Ruta donde queremos guardar el pdf
                $file->move(public_path() . '/biblioteca/permisos/', $nombre);//a la ruta establecida copia y pega el archivo
                $url = '/biblioteca/permisos/' . $nombre;
                $request['permisoPdf'] = $url;
            }
            $request['perm_opcion'] = false;
            Permiso::create($request->all());
            $permisoActual = Permiso::all()->last();
            PermisoController::diaPermi($permisoActual);
            return redirect("/permisos/" . $request['idEmpleado'])->with('create', 'Se ha creado con éxito el registro de permiso');
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
        $file = Input::file('permisoPdf2');
        $random = str_random(10);
        $nombre = 'final-' . $random . '-' . $file->getClientOriginalName();
        $nombre = EmpleadoController::eliminar_tildes($nombre);
        //Ruta donde queremos guardar el pdf
        $file->move(public_path() . '/biblioteca/permisos/', $nombre);
        $url = '/biblioteca/permisos/' . $nombre;
        $request['permisoPdf'] = $url;
        $permiso->permisoPdf = $request['permisoPdf'];
        $permiso->save();
        return redirect("/permisos/". $request['idEmpleado'])->with('update','Se ha editado correctamente el registro de permiso');

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
    static function diferenciaFechas($fechaInicio, $fechaFin)
    {
        $inicio = new \DateTime($fechaInicio);
        $fin = new \DateTime($fechaFin);
        $resultado = $inicio->diff($fin);
        return $resultado->days+1;
    }
    static function fechaSiguiente($fecha)
    {
        $dias_inicio_mes=date("t", strtotime($fecha));
        $mes_inicio=date("m", strtotime($fecha));
        $anno_inicio=date("Y", strtotime($fecha));
        $resultado = date($anno_inicio."-".$mes_inicio."-".$dias_inicio_mes);
        return $resultado;
    }
    static function guardarDiaPermiso($dip_dias,$dip_año,$dip_mes,$permiso_id,$fecha)
    {
        DiaPermiso::create([
            'dip_dias'=>$dip_dias,
            'dip_año'=>$dip_año,
            'dip_mes'=>$dip_mes,
            'permiso_id'=>$permiso_id,
            'dip_fecha'=>$fecha,
        ]);
    }
    static function diaPermi($permiso)
    {

        if($permiso->tipoPermiso==2 || $permiso->perm_opcion==1) {
            $fin = $permiso->fechaPermisoFinal;
            if($permiso->tipoPermiso==4 && $permiso->casoPermiso!=8)
            {
                $inicio = $permiso->fechaPermisoInicio;
                $dias=PermisoController::diferenciaFechas($inicio,$fin);
                if($dias > 3) $inicio=date("Y-m-d", strtotime("$inicio +3 days"));
                else return 0;
            }
            else $inicio = $permiso->fechaPermisoInicio;
            do{
                $dias_inicio_mes=date("t", strtotime($inicio));
                $mes_inicio=date("m", strtotime($inicio));
                $anno_inicio=date("Y", strtotime($inicio));
                $fecha_fin_mes = date($anno_inicio."-".$mes_inicio."-".$dias_inicio_mes);
                $fecha=date($anno_inicio."-".$mes_inicio."-01");
                if($fin<=$fecha_fin_mes) {
                    $dias=PermisoController::diferenciaFechas($inicio,$fin);
                    PermisoController::guardarDiaPermiso($dias,$anno_inicio,$mes_inicio,$permiso->id,$fecha);
                    $inicio=date("Y-m-d", strtotime("$fecha +1 month"));
                }else{
                    $dias=PermisoController::diferenciaFechas($inicio,$fecha_fin_mes);
                    PermisoController::guardarDiaPermiso($dias,$anno_inicio,$mes_inicio,$permiso->id,$fecha);
                    $inicio=date("Y-m-d", strtotime("$fecha +1 month"));
                }
            }while($inicio<$fin);
        }
    }





}
