<?php

namespace App\Http\Requests;

use App\Empleado;
use App\Salidas;
use App\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;

class ValeRequest extends FormRequest
{
   // protected  $dontFlash=['costoUnitarioVale','costoGalones', 'costoAceite', 'costoGrasa', 'costoOtro', 'nombreOtro', 'costoTotalGalones'];
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
            'fechaSalida' => 'required|date',
            'aceite' => 'sometimes|nullable',
            'grasa' => 'sometimes|nullable',
            'otros' => 'sometimes|nullable',
            'fechaSalida' => 'required|date|after_or_equal:'.$now,
            'destinoTrasladarse' => 'required|alpha_spaces',
            'mision' => 'sometimes|nullable',
            'numeroPlaca' => 'integer|min:1',
            'solicitante' => 'integer|min:1',
            'fechaCreacion' => 'required|date|same:fechaSalida',
            'numeroVale' => 'required_if:bandera,1|unique:vales', //|numeric|integer
            'costoUnitarioVale' => '',
            'tipoCombustible' => 'required',
            'galones' => 'required|nullable|numeric|between:0.00,20.00',
            'costoGalones' => 'required|numeric|between:0.00,100.00',
            'aceite' => 'required_with_all:costoAceite',
            'costoAceite' => 'sometimes|nullable|required_if:aceite,on|numeric|between:0.00,30.00',
            'grasa' => 'required_with_all:costoGrasa',
            'costoGrasa' => 'sometimes|nullable|required_if:grasa,on|numeric|between:0.00,20.00',
            'otros' => 'required_with_all:nombreOtro,costoOtro',
            'nombreOtro' => 'sometimes|nullable|required_if:otros,on|alpha_spaces',
            'costoOtro' => 'sometimes|nullable|required_if:otros,on|numeric|between:0.00,60.00',
            'gasolinera' => 'required|alpha_spaces',
            'empRecibe' => 'integer|min:1',
            'empAutoriza' => 'integer|min:1',

        ];
    }

    public function messages()
    {
        $now=date('d/m/Y');
        return [
            'fechaSalida.required' => '¡El campo Fecha de salida es requerido!',
            'fechaSalida.after_or_equal' => '¡El campo Fecha de salida debe ser igual o mayor que '.$now,

            'destinoTrasladarse.required'  => '¡El campo Destino es requerido!',
            'destinoTrasladarse.alpha_spaces'  => '¡El campo Destino no debe contener números!',

            'numeroPlaca.min'  => '¡El campo Vehículo es requerido!',

            'solicitante.min'  => '¡El campo Solicitante es requerido!',

            'fechaCreacion.required'  => '¡El campo Fecha de vale es requerido!',
            'fechaCreacion.same'  => '¡El campo Fecha de vale tiene que ser igual a Fecha de salida!',

            'numeroVale.required_if'  => '¡El campo Código de vale no debe estar vacío!',
            'numeroVale.unique'  => '¡El Código de vale ya existe!',

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

    public function createVale($data){

        if ($data['bandera']!='1'){
            $data['numeroVale']="";
            $data['empAutoriza']='0';
            $data['empRecibe']='0';
            $data['estadoEntregadoVal']="off";
        }

        if (!($data['estadoEntregadoVal']=="on")){
            $data['estadoEntregadoVal']=0;
        }else{
            $data['estadoEntregadoVal']=1;
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

        $salida= Salidas::create([
            'fechaSalida' => $data['fechaSalida'],
            'destinoTrasladarse' => $data['destinoTrasladarse'],
            'mision' => $data['mision'],
            'idVehiculo' => $data['numeroPlaca'],
            'idEmpleado' => $data['solicitante'],
        ]);

        $salida->vales()->create([
            'fechaCreacion' => $data['fechaCreacion'],
            'numeroVale' => $data['numeroVale'],
            'costoUnitarioVale' => $data['costoUnitarioVale'],
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
        ]);


    }

}
