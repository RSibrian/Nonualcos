<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitucionRequest extends FormRequest
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
          'nombreInstitucion'=> 'required|alpha_spaces|between:3,80',
          'direccionInstitucion' => 'required|min:10|max:200',
          'telefonoInstitucion.*'=>'required|size:9|distinct',



        ];
    }
    public function messages(){
        return [

          'nombreInstitucion.required' => 'Por favor ingrese la Institución',
          'nombreInstitucion.alpha_spaces'=>'ingrese nombres válidos (letras y espacios)',
          'nombreInstitucion.between'=>'ingrese nombres válidos (3 a 80 caracteres)',

          'direccionInstitucion.required'=>'Por favor ingrese la dirección',
          'direccionInstitucion.min'=>'La dirección debe tener al menos 10 caracteres',
          'direccionInstitucion.max'=>'La dirección debe tener máximo 200 caracteres',

          'telefonoInstitucion.required'=>'Por favor ingrese el télefono',

        ];
    }
}
