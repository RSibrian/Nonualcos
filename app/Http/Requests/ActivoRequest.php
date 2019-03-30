<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivoRequest extends FormRequest
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
        'aniosVida'=> 'integer|min:1',
        'precio'=> 'required|min:1',
        'nombreActivo'=> 'required|alpha_spaces|between:3,40',
    ];
}
    public function messages(){
        return [
            'aniosVida.min' => '¡la vida util no debe ser menor a un año!',
            'precio.min' => 'Ingresar un valor mayor a 1',
            'nombreActivo.between' => 'ingrese nombres válidos (3 a 40 caracteres)',

        ];
    }
}
