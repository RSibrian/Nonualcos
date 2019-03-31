<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DescuentoRequest extends FormRequest
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

        'numeroCuenta'=> 'required|max:20',
    ];
}
    public function messages(){
        return [
            'numeroCuenta.max' => '¡El número de cuenta debe ser menor a 20 digitos!',
            'numeroCuenta.required' => '¡Ingrese el número de cuenta!',


        ];
    }
}
