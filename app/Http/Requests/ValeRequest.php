<?php

namespace App\Http\Requests;

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
            'destino' => 'required',
            'mision' => 'required|max:100|min:10',
            'numeroPlaca' => 'required|exists:vehiculos',
            'solicitante' => 'required|string|max:40|min:3',
            'fechaCreacion' => 'required',
            'numeroVale' => 'required|unique:vales', //|numeric|integer
            'cVale' => 'required|numeric',
            'tipoCombustible' => 'required|string',
            'nGalones' => 'required|numeric',
            'gasolinera' => 'required|string|max:70|min:4',
            'empRecibe' => 'required|string|max:40|min:3',
            'empAutoriza' => 'required|string|max:40|min:3',

        ];
    }

    public function messages()
    {
        return [
            'fechaSalida.required' => '¡El campo Fecha de salida no debe estar vacío!',

            'destino.required'  => '¡El campo Destino no debe estar vacío!',

            'mision.required'  => '¡El campo Misión no debe estar vacío!',
            'mision.min'  => '¡El campo Misión no puede tener menos de :min caracteres!',
            'mision.max'  => '¡El campo Misión no puede tener más de :max caracteres!',

            'numeroPlaca.required'  => '¡El campo Vehículo no debe estar vacío!',
            'numeroPlaca.exists'  => '¡La placa del vehículo no existe!',

            'solicitante.required'  => '¡El campo Solicitante no debe estar vacío!',
            'solicitante.string'  => '¡El campo Solicitante es incorrecto!',
            'solicitante.min'  => '¡El campo Solicitante no puede tener menos de :min caracteres!',
            'solicitante.max'  => '¡El campo Solicitante no puede tener más de :max caracteres!',

            'fechaCreacion.required'  => '¡El campo Fecha de vale no debe estar vacío!',

            'numeroVale.required'  => '¡El campo Código de vale no debe estar vacío!',
            'numeroVale.unique'  => '¡El Código de vale ya existe!',

            'cVale.required'  => '¡El campo Costo de vale no debe estar vacío!',
            'cVale.numeric'  => '¡El valor del campo Costo de vale es incorrecto!',

            'tipoCombustible.required'  => '¡El campo Tipo de combustible no debe estar vacío!',
            'tipoCombustible.string'  => '¡El campo Tipo de combustible es incorrecto!',

            'nGalones.required'  => '¡El campo Número de galones no debe estar vacío!',
            'nGalones.numeric'  => '¡El campo Número de galones es incorrecto!',

            'gasolinera.required'  => '¡El campo Gasolinera no debe estar vacío!',
            'gasolinera.string'  => '¡El campo Gasolinera contiene número!',
            'gasolinera.min'  => '¡El campo Gasolinera no puede tener menos de :min caracteres!',
            'gasolinera.max'  => '¡El campo Gasolinera no puede tener más de :max caracteres!',

            'empRecibe.required'  => '¡El campo Empleado que recibe no debe estar vacío!',
            'empRecibe.string'  => '¡El campo Empleado que recibe es incorrecto!',
            'empRecibe.min'  => '¡El campo Empleado que recibe no puede tener menos de :min caracteres!',
            'empRecibe.max'  => '¡El campo Empleado que recibe no puede tener más de :max caracteres!',

            'empAutoriza.required'  => '¡El campo Empleado que autoriza no debe estar vacío!',
            'empAutoriza.string'  => '¡El campo Empleado que autoriza contiene números!',
            'empAutoriza.min'  => '¡El campo Empleado que autoriza no puede tener menos de :min caracteres!',
            'empAutoriza.max'  => '¡El campo Empleado que autoriza no puede tener más de :max caracteres!',

        ];
    }
}
