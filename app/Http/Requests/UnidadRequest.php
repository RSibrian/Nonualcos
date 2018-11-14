<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadRequest extends FormRequest
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
        'codigoUnidad'=> 'required|unique:unidades,codigoUnidad,'.$this->unidad['id'],
        'nombreUnidad'=> 'required',
    ];
}
    public function messages(){
        return [
            'codigoUnidad.required' => '¡Por favor ingrese el codigo de la unidad!',
            'codigoUnidad.unique' => '¡El codigo de la unidad ya existe!',
            'nombreUnidad.required' => '¡Por favor ingrese el nombre de la unidad!',
        ];
    }
}
