<?php

namespace App\Http\Requests;

use App\Empleado;
use App\Salidas;
use App\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;

class ValeEditRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $now=date('Y-m-d');
        return [
            //string,unique:table,column,except,idColumn, email, between:min,max, alpha_num, integer, alpha_dash, exists:table,column
            'aceite' => 'sometimes|nullable',
            'grasa' => 'sometimes|nullable',
            'otros' => 'sometimes|nullable',
            'fechaSalida' => 'sometimes|date',
            'destinoTrasladarse' => 'sometimes|nullable',
            'lugarSalida' => 'required_if:radiosalida,1|nullable',
            'hsalida' => 'required_if:radiosalida,1|nullable',
            'crecibidogls' => 'required_if:radiosalida,1|nullable',
            'ksalida' => 'required_if:radiosalida,1|nullable',
            'hllegada' => 'required_if:radiosalida,1|nullable',
            'kllegada' => 'required_if:radiosalida,1|nullable',
            'mision' => 'required_if:radiosalida,1|nullable',
            'numeroPlaca' => 'integer|min:0',
            'solicitante' => 'integer|min:0',
            'fechaCreacion' => 'sometimes|date',
            'numeroVale' => 'nullable', //|numeric|integer
            'costoUnitarioVale' => '',
            'tipoCombustible' => 'sometimes|nullable',
            'galones' => 'sometimes|nullable|numeric|between:0.00,20.00',
            'costoGalones' => 'sometimes|nullable|numeric|between:0.00,100.00',
            'aceite' => 'required_with_all:costoAceite',
            'costoAceite' => 'sometimes|nullable|required_if:aceite,on|numeric|between:0.00,30.00',
            'grasa' => 'required_with_all:costoGrasa',
            'costoGrasa' => 'sometimes|nullable|required_if:grasa,on|numeric|between:0.00,20.00',
            'otros' => 'required_with_all:nombreOtro,costoOtro',
            'nombreOtro' => 'sometimes|nullable|required_if:otros,on|alpha_spaces',
            'costoOtro' => 'sometimes|nullable|required_if:otros,on|numeric|between:0.00,60.00',
            'gasolinera' => 'sometimes|nullable|alpha_spaces',
            'empRecibe' => 'integer|min:1',
            'empAutoriza' => 'integer|min:1',
            'estadoRecibidoVal'=>'',
            'estadoEntregadoVal'=>'',
        ];
    }

    public function messages()
    {
        $now=date('d/m/Y');
        return [
            'fechaSalida.required' => '¡El campo Fecha de salida es requerido!',
            'fechaSalida.before_or_equal' => '¡El campo Fecha de salida debe ser igual o menor que '.$now,

            'destinoTrasladarse.required'  => '¡El campo Destino es requerido!',
            'destinoTrasladarse.alpha_spaces'  => '¡El campo Destino no debe contener números!',

            'lugarSalida.required_if'  => '¡El campo Lugar de salida es requerido!',

            'hsalida.required_if'  => '¡El campo Hora de salida es requerido!',

            'crecibidogls.required_if'  => '¡El campo Combustible recibido es requerido!',

            'ksalida.required_if'  => '¡El campo Kilometraje de salida es requerido!',

            'hllegada.required_if'  => '¡El campo Hora de llegada es requerido!',

            'kllegada.required_if'  => '¡El campo Kilometraje de llegada es requerido!',

            'mision.required_if'  => '¡El campo Misión es requerido!',

            'numeroPlaca.min'  => '¡El campo Vehículo es requerido!',

            'solicitante.min'  => '¡El campo Solicitante es requerido!',

            'fechaCreacion.required'  => '¡El campo Fecha de vale es requerido!',
            'fechaCreacion.same'  => '¡El campo Fecha de vale tiene que ser igual a Fecha de salida!',

            'numeroVale.required_if'  => '¡El campo Código de vale no debe estar vacío!',

            'galones.required' => '¡El campo Número de galones es requerido!',
            'galones.numeric' => '¡El campo Número de galones debe ser numérico!',
            'galones.between' => '¡El campo Número de galones no debe ser mayor a 20.00 galones!',

            'costoGalones.required' => '¡El campo Costo galones es requerido!',
            'costoGalones.numeric' => '¡El campo Costo galones contiene letras!',
            'costoGalones.between' => '¡El campo Costo galones no debe ser mayor a $100.00!',

            'aceite.required_with_all' => '¡En agregar a vale: Seleccione la opción de aceite!',

            'costoAceite.numeric' => '¡El campo Costo aceite contiene letras!',
            'costoAceite.between' => '¡El campo Costo aceite no debe ser mayor a $30.00!',
            'costoAceite.required_if' => '¡El campo Costo aceite es requerido!',

            'grasa.required_with_all' => '¡En agregar a vale: Seleccione la opción de grasa!',

            'costoGrasa.numeric' => '¡El campo Costo grasa contiene letras!',
            'costoGrasa.between' => '¡El campo Costo grasa no debe ser mayor a $20.00!',
            'costoGrasa.required_if' => '¡El campo Costo grasa es requerido!',

            'otros.required_with_all' => '¡En agregar a vale: Seleccione la opción de otro!',

            'nombreOtro.alpha_spaces' => '¡El campo Nombre otro no debe contener números!',
            'nombreOtro.required_if' => '¡El campo Nombre otro es requerido!',

            'costoOtro.numeric' => '¡El campo Costo otro contiene letras!',
            'costoOtro.between' => '¡El campo Costo grasa no debe ser mayor a $60.00!',
            'costoOtro.required_if' => '¡El campo Costo otro es requerido!',

            'gasolinera.required'  => '¡El campo Gasolinera no debe estar vacío!',
            'gasolinera.alpha_spaces'  => '¡El campo Gasolinera contiene números!',

            'empRecibe.min'  => '¡El campo Empleado que recibe es requerido!',

            'empAutoriza.min'  => '¡El campo Empleado que autoriza es requerido!',

        ];
    }

    public function updateVale($data, $vale){

        $liquidacion=0;

        if ($data['bandera']!='1'){
            $data['numeroVale']=$vale['numeroVale'];
            $data['empAutoriza']=$vale['empleadoAutorizaVal'];
            $data['empRecibe']=$vale['empleadoRecibeVal'];

            if ($vale['estadoEntregadoVal']==0){
                $data['estadoEntregadoVal']="off";
            }else{
                $data['estadoEntregadoVal']="on";
            }

            if ($vale['estadoRecibidoVal']==0){
                $data['estadoRecibidoVal']="off";
            }else{
                $data['estadoRecibidoVal']="on";
            }
        }else{

            if ($vale['estadoEntregadoVal']==1 ||  $data['estadoEntregadoVal']=='on'){
                $data['estadoEntregadoVal']="on";
            }else{
                $data['estadoEntregadoVal']="off";
            }

            if ($vale['estadoRecibidoVal']==1 || $data['estadoRecibidoVal']=='on'){
                $data['estadoRecibidoVal']="on";
            }else{
                $data['estadoRecibidoVal']="off";
            }

        }


        if (!($data['estadoEntregadoVal']=="on")){
            $data['estadoEntregadoVal']=0;
        }else{
            $data['estadoEntregadoVal']=1;
        }

        if (!($data['estadoRecibidoVal']=="on")){
            $data['estadoRecibidoVal']=0;
        }else{
            $data['estadoRecibidoVal']=1;
        }

        if (!($data['aceite']=="on")){
            $data['aceite']=0;
        }else{
            $data['aceite']=1;
        }

        if (!($data['grasa']=="on")){
            $data['grasa']=0;
        }else{
            $data['grasa']=1;
        }

        if (!($data['otros']=="on")){
            $data['otros']='';
        }else{
            $data['otros']=$data['nombreOtro'];
        }

        if ($data['destinoTrasladarse']==''){
            $data['destinoTrasladarse']='';
            $data['mision']='';
            $data['solicitante']=$data['empRecibe'];
        }

        if ($data['numeroVale']==''){
            $data['numeroVale']='';
            $data['costoUnitarioVale']=0;
            $data['tipoCombustible']=0;
            $data['galones']=0;
            $data['gasolinera']='';
            $data['costoGalones']=0;
            $data['aceite']=0;
            $data['costoAceite']=0;
            $data['grasa']=0;
            $data['costoGrasa']=0;
            $data['otros']='';
            $data['costoOtro']=0;
        }

        if(($data['hllegada']!=null && $data['kllegada']!=null && $data['mision']!=null) && ($data['numeroVale']=='')){
            $liquidacion=1;
        }


       $vale->update([
           'fechaCreacion' => $data['fechaCreacion'],
           'numeroVale' => $data['numeroVale'],
           'costoUnitarioVale' => $data['costoUnitarioVale'],
           'fechaSalida' => $data['fechaSalida'],
           'tipoCombustible' => $data['tipoCombustible'],
           'galones' => $data['galones'],
           'gasolinera' => $data['gasolinera'],
           'costoGalones' => $data['costoGalones'],
           'aceite' => $data['aceite'],
           'costoAceite' => $data['costoAceite'],
           'grasa' => $data['grasa'],
           'costoGrasa' => $data['costoGrasa'],
           'otro' => $data['otros'],
           'costoOtro' => $data['costoOtro'],
           'empleadoAutorizaVal' => $data['empAutoriza'],
           'empleadoRecibeVal' => $data['empRecibe'],
           'estadoEntregadoVal' => $data['estadoEntregadoVal'],
           'estadoRecibidoVal' => $data['estadoRecibidoVal'],
           'estadoLiquidacionVal' => $liquidacion,
        ]);

        //echo dd($vale);

        $vale->salida()->update([
            'fechaSalida' => $data['fechaSalida'],
            'destinoTrasladarse' => $data['destinoTrasladarse'],
            'mision' => $data['mision'],
            'lugarSalida' => $data['lugarSalida'],
            'crecibidogls' => $data['crecibidogls'],
            'hsalida' => $data['hsalida'],
            'ksalida' => $data['ksalida'],
            'hllegada' => $data['hllegada'],
            'kllegada' => $data['kllegada'],
            'idVehiculo' => $data['numeroPlaca'],
            'idEmpleado' => $data['solicitante'],
        ]);


    }
}
