<?php

namespace App\Http\Controllers;

use App\Activos;
use App\ActivosUnidades;
use App\ClasificacionesActivos;
use App\Instituciones;
use App\Prestamo;
use App\PrestamoActivo;
use App\PrestamoTemporal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;
use Carbon\Carbon;

use App\Http\Requests\PrestamosReporteRequest;
use App\Http\Requests\PrestamoRequest;

class PrestamoController extends Controller
{

    public function index()
    {
        //
        return view('prestamos.calendar');

    }

    public function indexPrestamo()
    {
        //
        $prestamos=Prestamo::orderBy('id','desc')->get();
        return view('prestamos.indexPrestamo',compact('prestamos'));

    }

    public function create()
    {
        //
        $instituciones=Instituciones::pluck('nombreInstitucion','id');
        $date = date('Y-m-d\TH:i');
        $activos=ActivosUnidades::activosxUnidades();
        return view('prestamos.create', compact('date','instituciones','activos'));

    }


    public function store(PrestamoRequest $request)
    {

        $file = Input::file('pdfPrestamo2');
        $random=str_random(10);
        $nombre = "Solicitudes de Prestamos ".$random.'-'.$file->getClientOriginalName();
        $nombre=PrestamoController::eliminar_tildes($nombre);
        //Ruta donde queremos guardar el pdf
        $file->move(public_path().'/biblioteca/prestamos/',$nombre);
        $url = '/biblioteca/prestamos/'.$nombre;
        $request['pdfPrestamo']=$url;
        Prestamo::create($request->all());

        $ultimaSolicitud=Prestamo::all()->last();
        $ultimaSolicitud->activos()->sync($request->get('activos'));
        return redirect('prestamos/indexPrestamo')->with('create','Sea creado con éxito el préstamo');
    }
    public function showPrestamo(Prestamo $prestamo)
    {
      $activos=PrestamoActivo::All()->where('prestamo_id',$prestamo->id);
      //dd($activos);
      return view('prestamos.showPrestamo',compact('prestamo','activos'));
    }

    public function show($id)
    {
        //

        $resultado= Prestamo::all();
        $indice=0;
        foreach ($resultado as $solicitud) {
            $date =  date('Y-m-d H:i',time());


           if($solicitud->estadoPrestamo==1){
                if($date>$solicitud->fechaDevolucionPrestamo){
                    //  dd($solicitud->sol_fecha_fin);
                    $solicitud->estadoPrestamo=3;
                    $solicitud->save();
                }
            }
            if($solicitud->estadoPrestamo==4){
                if($date>$solicitud->fechaDevolucionPrestamo && $solicitud->fechaRegresoPrestamo==null || $solicitud->fechaRegresoPrestamo>$solicitud->fechaDevolucionPrestamo   ){
                    $solicitud->estadoPrestamo=5;
                    $solicitud->save();
                }
            }
            if($solicitud->estadoPrestamo==0)
                $resultado[$indice]->color="#831517"; // color ocre = cancelado
            else if($solicitud->estadoPrestamo==1)
                $resultado[$indice]->color="#00bcd4"; // color celeste = pendiente
            else if($solicitud->estadoPrestamo==2)
                $resultado[$indice]->color="#17A589"; // color verde = completo
            else if($solicitud->estadoPrestamo==3)
                $resultado[$indice]->color="#F83324"; // color rojo = no reclamado
            else if($solicitud->estadoPrestamo==4)
                $resultado[$indice]->color="#7D29A0"; // color morado = entregado
            else if($solicitud->estadoPrestamo==5)
                $resultado[$indice]->color="#6A6968"; // color gris = no devuelto
            else
                $resultado[$indice]->color="#FC8804"; // color  naranja = devuelto tarde



          /*  if($solicitud->estadoPrestamo==1)
                $resultado[$indice]->color="#00bcd4"; // color celeste = pendiente
            else
                $resultado[$indice]->color="#17A589";*/

            $resultado[$indice]->start=$solicitud->fechaEntregaPrestamo;
            $resultado[$indice]->end=$solicitud->fechaDevolucionPrestamo;
            $resultado[$indice]->title=$solicitud->evento;
            $resultado[$indice]->descripcion="";
            $contador=0;
            foreach ($solicitud->activos as $activo) {
                $contador++;
                $tr1="<tr >";
                $td1="<td></td>";
                $td2="<td>".$contador."</td>";
                $td3="<td>".$activo->codigoInventario."</td>";
                $td4="<td>".$activo->nombreActivo."</td>";
                $td5="<td>".$activo->marca."</td>";
                $td6="<td>".$activo->modelo."</td>";
                $td7="<td>".$activo->color."</td>";
                $tr2="</tr>";
                $resultado[$indice]->descripcion.=$tr1.$td1.$td2.$td3.$td4.$td5.$td6.$td7.$tr2;
                /*$resultado[$indice]->descripcion.= $activo->codigoInventario." "
                    .$activo->nombreActivo." ".$activo->marca." ".$activo->modelo." ".
                    $activo->color."<br>";*/
            }


           /* tablaDatos.append(tr1+td1+td2+td3+td4+td5+td6+tr2);*/
            $resultado[$indice]->beneficiarioEvent=$solicitud->nombreSolicitante;
            $resultado[$indice]->lugarEvent=$solicitud->institucion->nombreInstitucion;
            $resultado[$indice]->dui=$solicitud->DUISolicitante;
            $resultado[$indice]->telefono=$solicitud->telefonoSolicitante;
            $resultado[$indice]->estado=$solicitud->estadoPrestamo;

            $indice++;
        }
        return response()->json($resultado);

    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request,$id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrestamoTemporal  $prestamoTemporal
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrestamoTemporal $prestamoTemporal)
    {
        $prestamoTemporal->delete();
        $prestamosAuxAjax= PrestamoTemporal::auxCompleto(Auth::user()->id);
        return response()->json($prestamosAuxAjax);

    }
    public function storeAjaxAux(Request $request)
    {
        if($request->ajax()){
            $request['user_id']=Auth::user()->id;
            PrestamoTemporal::create($request->all());
            $prestamosAuxAjax= PrestamoTemporal::auxCompleto(Auth::user()->id);
            //   $prestamosAuxAjax=DonPrestamoAux::where('user_id',Auth::user()->id)->get();
            return response()->json($prestamosAuxAjax);
        }
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
        return $cadena;
    }

    public function comprobanteEntregaPrestamo(Prestamo $prestamo)
        {
          $activos=PrestamoActivo::All()->where('prestamo_id',$prestamo->id);
          $date = date('d-m-Y');
          $date1 = date('g:i:s a');
          $vistaurl="prestamos/reportes/.comprobanteEntregaPrestamo";
          $view =  \View::make($vistaurl, compact('prestamo', 'activos','date','date1'))->render();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML($view);
          $pdf->setPaper('letter', 'portrait');
          return $pdf->stream('Comprobante de Entrega de Activos '.$date.'.pdf');
        }
    public function generarReportePrestamo(){
        $date =Carbon::now();
        $date1 =Carbon::now();
        return view('prestamos.generarReportePrestamo', compact('date','date1'));
    }
    public function reportePrestamo(PrestamosReporteRequest $request)
    {

      $prestamos=Prestamo::prestamoRango($request['fechaInicio'],$request['fechaFin']);
    //  $prestamos=Prestamo::All();
        //dd($prestamos);
        $fechaInicio=$request['fechaInicio'];
        $fechaFin=$request['fechafin'];

        $date = date('d-m-Y');
        $date1 = date('g:i:s a');
        $vistaurl="prestamos/reportes/.reportePrestamo";
        $view =  \View::make($vistaurl, compact('prestamos','fechaInicio','fechaFin','date','date1'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        $pdf->setPaper('letter', 'landscape');
        return $pdf->stream('Reporte Prestamo '.$date.'.pdf');
    }

    public function storeAjaxCancel(Request $request)
    {
        if($request->ajax()){
            $solicitud=Prestamo::find($request['id']);
            if( $solicitud->estadoPrestamo==1)
            {
                if($request['estadoPrestamo']==4)
                {
                    foreach ($solicitud->activos as $activo) {
                        $activo->estadoActivo=3;
                        $activo->save();
                    }
                }
                $solicitud->estadoPrestamo=$request['estadoPrestamo'];
                $solicitud->save();
            }
            return response()->json($request->all());
        }
    }
    public function storeAjaxFinalizar(Request $request)
    {
        $date = date('Y-m-d\TH:i');
        if($request->ajax()){
            $solicitud=Prestamo::find($request['id']);
            $solicitud->fechaRegresoPrestamo=$date;
            if($request['estadoPrestamo']==2)
            {
                foreach ($solicitud->activos as $activo) {
                    $activo->estadoActivo=1;
                    $activo->save();
                }
            }
            if( $solicitud->estadoPrestamo==5)
            {
                $solicitud->estadoPrestamo=6;

                $solicitud->save();
            }
            else{
                if( $solicitud->estadoPrestamo==4)
                {
                    $solicitud->estadoPrestamo=$request['estadoPrestamo'];
                    $solicitud->save();
                }
            }

            return response()->json($request->all());
        }
    }
}
