<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasificacionActivosRequest extends FormRequest
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
          'codigoTipo'=> 'required|unique:clasificaciones_activos,codigoTipo,'.$this->clasificacionesActivos['id'],
          'nombreTipo'=> 'required',
        ];
    }
    public function messages(){
        return [
            'codigoTipo.required' => '¡Por favor ingrese el codigo de la Clasificación!',
            'codigoTipo.unique' => '¡El codigo de la Clasificación ya existe!',
            'nombreTipo.required' => '¡Por favor ingrese el nombre de la Clasificación!',
        ];
    }
}
