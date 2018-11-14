<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MantenimientoRequest extends FormRequest
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
             'fechaRecepcionTaller'=> 'required',
             'empresaEncargada'=> 'required',
             'personalRecibeMantenimiento'=> 'required',
             'idActivo'=> 'required|numeric',

         ];
     }
     public function messages(){
         return [
             'fechaRecepcionTaller.required' => 'Se requiere la fecha de entrega en taller',
             'empresaEncargada.required' => '¡Se requiere el nombre de la empresa encargada!',
             'personalRecibeMantenimiento.required'=>'¡Por favor ingrese el nombre de quien recibe!',
             'idActivo.required'=>'por favor ingrese el código del activo',
         ];
     }
}
