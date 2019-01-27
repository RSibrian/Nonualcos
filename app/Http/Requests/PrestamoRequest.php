<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrestamoRequest extends FormRequest
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
          'nombreSolicitante'=> 'required|alpha_spaces|between:3,40',
          'evento' => 'required|min:5|max:200',
          'DUISolicitante'=> 'required|size:10',
          'telefonoSolicitante.*'=>'required|size:9|distinct',
          'fechaEntregaPrestamo'=> 'required|beforeor_equal:'.$this->fechaDevolucionPrestamo,
          'activos'=>'required',



        ];
    }
    public function messages(){
        return [

          'nombreSolicitante.required' => 'Por favor ingrese la Institución',
          'nombreSolicitante.alpha_spaces'=>'ingrese nombres válidos (letras y espacios)',
          'nombreSolicitante.between'=>'ingrese nombres válidos (3 a 80 caracteres)',

          'evento.required'=>'Por favor ingrese el evento',
          'evento.min'=>'El evento debe tener al menos 5 caracteres',
          'evento.max'=>'El evento debe tener máximo 200 caracteres',

          'telefonoInstitucion.required'=>'Por favor ingrese el télefono',

          'DUISolicitante.size'=>'ingrese un número de DUI válido',

          'fechaEntregaPrestamo.beforeor_equal' => 'La fecha inicio no puede ser mayor a la fecha devolución',
          'activos.required'=> 'Seleccione al menos un activo',



        ];
    }
}
