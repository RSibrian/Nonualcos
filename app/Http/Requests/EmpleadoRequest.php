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
            'nombresEmpleado'=> 'required|alpha|between:3,40',
            'apellidosEmpleado'=> 'required|alpha|between:3,40',
            'fechaNacimientoEmpleado'=> 'required',
            'dirreccionEmpleado' => 'required',
            'DUIEmpleado'=> 'required|size:10|unique:empleados',
            'NITEmpleado'=> 'required|size:17|unique:empleados',
            'idCargo'=> 'numeric',
            'telefonoEmpleado.*'=>'sometimes|nullable|size:9|distinct',
            'telefonoEmpleado'=>'unique:telefono_empleados',
            'per_imagenE'=>'sometimes|nullable|mimes:jpeg,bmp,png',
        ];
    }
    public function messages(){
        return [
          'nombresEmpleado'=>'ingrese nombres válidos',
          'nombresEmpleado.alpha'=>'ingrese nombres válidos (únicamente caracteres alfabéticos)',
          'nombresEmpleado.between'=>'ingrese nombres válidos (3 a 40 caracteres)',
          'apellidosEmpleado'=>'ingrese apellidos válidos',
          'apellidosEmpleado.between'=>'ingrese apellidos válidos (3 a 40 caracteres)',
          'apellidosEmpleado.alpha'=>'ingrese apellidos válidos (únicamente caracteres alfabéticos)',
            'fechaNacimientoEmpleado.required' => '¡Por favor ingrese la fecha de nacimiento!',
            'DUIEmpleado.size'=>'ingrese un número de DUI válido',
            'DUIEmpleado.unique' => '¡El DUI del empleado ya existe!',
            'NITEmpleado.size'=>'ingrese un número de NIT válido',
            'NITEmpleado.unique' => '¡El NIT del empleado ya existe!',
            'idCargo.numeric'=>'¡Por favor seleccione un cargo!',
            'dirreccionEmpleado.required'=>'por favor ingrese la dirección',
            'telefonoEmpleado.*.size'=>'Ingrese un número de teléfono válido (8 dígitos)',
            'telefonoEmpleado.*.distinct'=>'No puede ingresar un número de teléfono duplicado',
            'telefonoEmpleado.unique'=>'El número de teléfono ya ha sido asignado',
            'per_imagenE.mimes'=>'Ingrese un archivo de imagen válido (jpeg/jpg,bmp,png)',
        ];
    }
}
