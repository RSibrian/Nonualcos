<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradasSalidasRequest extends FormRequest
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
      $date=date('Y-m-d');
        return [
          'fechaInicio'=> 'required|beforeor_equal:'.$date,
          'fechaFin'=> 'required|beforeor_equal:'.$date,
          'fechaInicio' => 'beforeor_equal:'.$this->fechaFin,
          'tiempoHora'=> 'required',
        ];
    }
    public function messages(){
        return [

          'fechaInicio.required' => '¡Por favor ingrese la fecha!',
          'fechaInicio.beforeor_equal' => 'La fecha inicio no puede ser mayor a la de hoy o fecha fin',

          'fechaFin.required' => '¡Por favor ingrese la fecha!',
          'fechaFin.beforeor_equal' => 'La fecha final no puede ser mayor a la de hoy',

          'tiempoHora.required' => '¡Por favor ingrese la hora!',
        ];
    }
}
