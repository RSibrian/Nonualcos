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
          'nombreTipo'=> 'required|min:5|max:50',
        ];
    }
    public function messages(){
        return [
            'codigoTipo.required' => '¡Por favor ingrese el código de la clasificación!',
            'codigoTipo.unique' => '¡El código de la clasificación ya existe!',
            'nombreTipo.required' => '¡Por favor ingrese el nombre de la clasificación!',
            'nombreTipo.min' => '¡El nombre de la clasificación debe tener más de 5 caracteres!',
            'nombreTipo.max' => '¡El nombre de la clasificación debe tener menos de 50 caracteres!',
        ];
    }
}
