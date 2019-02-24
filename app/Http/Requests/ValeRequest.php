<?php

namespace App\Http\Requests;

use App\Empleado;
use App\Salidas;
use App\Vehiculo;
use Illuminate\Foundation\Http\FormRequest;

class ValeRequest extends FormRequest
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
        return [
            //string,unique:table,column,except,idColumn, email, between:min,max, alpha_num, integer, alpha_dash, exists:table,column
            'fechaSalida' => 'required|date',
            'destinoTrasladarse' => 'required',
            'mision' => '',
            'idsolicitante' => '',
            'idempAutoriza' => '',
            'idempRecibe' => '',
            'numeroPlaca' => 'required|exists:vehiculos',
            'solicitante' => 'required',
            'fechaCreacion' => 'required|date',
            'numeroVale' => 'required|unique:vales', //|numeric|integer
            'costoUnitarioVale' => '',
            'tipoCombustible' => '',
            'galones' => '',
            'gasolinera' => 'required|string',
            'empRecibe' => 'required',
            'empAutoriza' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'fechaSalida.required' => '¡El campo Fecha de salida es requerido!',

            'destino.required'  => '¡El campo Destino es requerido!',

            'numeroPlaca.required'  => '¡El campo Vehículo es requerido!',
            'numeroPlaca.exists'  => '¡La placa del vehículo no existe!',

            'solicitante.required'  => '¡El campo Solicitante es requerido!',

            'fechaCreacion.required'  => '¡El campo Fecha de vale es requerido!',

            'numeroVale.required'  => '¡El campo Código de vale no debe estar vacío!',
            'numeroVale.unique'  => '¡El Código de vale ya existe!',

            'gasolinera.required'  => '¡El campo Gasolinera no debe estar vacío!',
            'gasolinera.string'  => '¡El campo Gasolinera contiene número!',

            'empRecibe.required'  => '¡El campo Empleado que recibe es requerido!',

            'empAutoriza.required'  => '¡El campo Empleado que autoriza es requerido!',

        ];
    }

    public function createVale($data){

        $vehiculo=Vehiculo::select('id')->where('numeroPlaca', '=', $data['numeroPlaca'])->get();
        $empleado=Empleado::select('id')->where('id', '=', $data['idsolicitante'])->get();

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
            'idVehiculo' => $vehiculo[0]->id,
            'idEmpleado' => $empleado[0]->id,
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
            'empleadoAutorizaVal' => $data->idempAutoriza,
            'empleadoRecibeVal' => $data['idempRecibe'],
            'estadoEntregadoVal' => $data['estadoEntregadoVal'],
        ]);


    }

}
