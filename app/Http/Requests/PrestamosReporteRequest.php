<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamosReporteRequest extends FormRequest
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
          'fechaInicio'=> 'required|beforeor_equal:'.$this->fechaFin,
          'fechaFin'=> 'required|beforeor_equal:'.$date,



        ];
    }
    public function messages(){
        return [

          'fechaInicio.required' => '¡Por favor ingrese la fecha!',
          'fechaInicio.beforeor_equal' => 'La fecha inicio no puede ser mayor a la fecha Fin',

          'fechaFin.required' => '¡Por favor ingrese la fecha!',
          'fechaFin.beforeor_equal' => 'La fecha final no puede ser mayor a la de hoy',


        ];
    }
}
