<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmpleadoEditRequest extends FormRequest
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
            'DUIEmpleado'=> 'required|size:10|unique:empleados,DUIEmpleado,'.$this->empleado['id'],
            'NITEmpleado'=> 'required|size:17|unique:empleados,NITEmpleado,'.$this->empleado['id'],
            'idCargo'=> 'numeric',
            'telefonoEmpleado.*'=>'sometimes|nullable|size:9|distinct',
            'telefonoEmpleado'=>Rule::unique('telefono_empleados')->ignore($this->empleado['id'],'idEmpleado'),
            'per_imagenE'=>'sometimes|nullable|mimes:jpeg,bmp,png',
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
