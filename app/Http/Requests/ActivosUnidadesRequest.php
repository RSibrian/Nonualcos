<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivosUnidadesRequest extends FormRequest
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
          $date=date('Y-m-d');
          'fechaInicioUni'=> 'required|beforeor_equal:'.$date,
        ];
    }
    public function messages(){
        return [
          'fechaInicioUni.required' => '¡Por favor ingrese la fecha de Asignación!',
          'fechaInicioUni.beforeor_equal' => 'La fecha no puede ser mayor a la de hoy',
        ];
    }
}
