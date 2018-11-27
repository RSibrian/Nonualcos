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
      'reparacionesSolicitadas'=>'required',
      'personalSolicitaMantenimiento'=>'required',
      'fechaRecepcionTaller'=> 'required',
      'empresaEncargada'=> 'required',
      'idActivo'=> 'required|numeric',
    ];
  }
  public function messages(){
    return [
      'reparacionesSolicitadas.required'=>'Por favor ingrese las reparaciones solicitadas en el artículo',
      'fechaRecepcionTaller.required' => 'Se requiere la fecha de entrega en taller',
      'empresaEncargada.required' => '¡Se requiere el nombre de la empresa encargada!',
      'personalSolicitaMantenimiento.required'=>'¡Por favor seleccione el empleado que solicita el mantenimiento!',
      'idActivo.required'=>'por favor ingrese el código del activo',
    ];
  }
}
