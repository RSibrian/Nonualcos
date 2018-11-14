<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaBancariaRequest extends FormRequest
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
         'numeroCuenta'=> 'required|unique:cuentas_bancarias,numeroCuenta,'.$this->cuenta['id'],
         'banco'=> 'required',
     ];
 }
     public function messages(){
         return [
             'numeroCuenta.required' => '¡Por favor ingrese el número de cuenta!',
             'banco.required' => '¡Por favor ingrese el nombre del banco!',
         ];
     }
}
