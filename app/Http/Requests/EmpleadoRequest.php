<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
            'nombresEmpleado'=> 'required',
            'apellidosEmpleado'=> 'required',
            'fechaNacimientoEmpleado'=> 'required',
            'dirreccionEmpleado' => 'required',
            'DUIEmpleado'=> 'required|unique:empleados',
            'NITEmpleado'=> 'required|unique:empleados',
            'idCargo'=> 'numeric',

        ];
    }
    public function messages(){
        return [
            'fechaNacimientoEmpleado.required' => '¡Por favor ingrese la fecha de nacimiento!',
            'DUIEmpleado.unique' => '¡El DUI del empleado ya existe!',
            'NITEmpleado.unique' => '¡El NIT del empleado ya existe!',
            'idCargo.numeric'=>'¡Por favor seleccione un cargo!',
            'dirreccionEmpleado.required'=>'por favor ingrese la direccion',

        ];
    }
}
