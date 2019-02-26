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
    $now=date('Y-m-d');
    $age=date("d-m-Y",strtotime($now."- 18 year"));
    return [
      'nombresEmpleado'=> 'required|alpha_spaces|between:3,40',
      'apellidosEmpleado'=> 'required|alpha_spaces|between:3,40',
      'fechaNacimientoEmpleado'=> 'required|beforeor_equal:'.$age,
      'dirreccionEmpleado' => 'required|min:20|max:200',
      'DUIEmpleado'=> 'required|size:10|unique:empleados',
      'NITEmpleado'=> 'required|size:17|unique:empleados',
      'idCargo'=> 'numeric',
      'telefonoEmpleado.*'=>'sometimes|nullable|size:9|distinct',
      'per_imagenE'=>'sometimes|nullable|mimes:jpeg,bmp,png',
      'fechaIngreso'=>'required|beforeor_equal:'.$now,
    ];
  }
  public function messages(){
    return [
      'nombresEmpleado.required'=>'ingrese nombres válidos',
      'nombresEmpleado.alpha_spaces'=>'ingrese nombres válidos (letras y espacios)',
      'nombresEmpleado.between'=>'ingrese nombres válidos (3 a 40 caracteres)',

      'apellidosEmpleado.required'=>'ingrese apellidos válidos',
      'apellidosEmpleado.between'=>'ingrese apellidos válidos (3 a 40 caracteres)',
      'apellidosEmpleado.alpha_spaces'=>'ingrese apellidos válidos (letras y espacios)',

      'fechaNacimientoEmpleado.required' => '¡Por favor ingrese la fecha de nacimiento!',
      'fechaNacimientoEmpleado.beforeor_equal' => 'Ingrese una fecha de nacimiento correcta (+18 años)',

      'DUIEmpleado.size'=>'ingrese un número de DUI válido',
      'DUIEmpleado.unique' => '¡El DUI del empleado ya existe!',

      'NITEmpleado.size'=>'ingrese un número de NIT válido',
      'NITEmpleado.unique' => '¡El NIT del empleado ya existe!',

      'idCargo.numeric'=>'¡Por favor seleccione un cargo!',

      'dirreccionEmpleado.required'=>'por favor ingrese la dirección',
      'dirreccionEmpleado.min'=>'La dirección debe tener al menos 20 caracteres',
      'dirreccionEmpleado.max'=>'La dirección debe tener máximo 200 caracteres',

      'telefonoEmpleado.*.size'=>'Ingrese un número de teléfono válido (8 dígitos)',
      'telefonoEmpleado.*.distinct'=>'No puede ingresar un número de teléfono duplicado',

      'per_imagenE.mimes'=>'Ingrese un archivo de imagen válido (jpeg/jpg,bmp,png)',

      'fechaIngreso.required'=>'La fecha de ingreso a la institución es requerida',
      'fechaIngreso.beforeor_equal'=>'La fecha de ingreso a la institución no puede ser mayor a la de hoy',
    ];
  }
}
