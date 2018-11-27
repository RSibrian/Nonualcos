<?php

namespace App\Http\Requests;

use App\Liquidacion;
use App\Vale;
use Illuminate\Foundation\Http\FormRequest;

class LiquidacionRequest extends FormRequest
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
            //string,unique:table,column,except,idColumn, email, between:min,max, alpha_num, integer, alpha_dash, exists:table,column
            'fechaLiquidacion' => 'required|date',
            'numeroFacturaLiquidacion' => 'required|unique:liquidaciones|string',
            'montoFacturaLiquidacion' => 'required|min:5.0|numeric',
            'name'=> 'required|min:1',
        ];
    }

    public function messages()
    {
        return [
            'fechaLiquidacion.required' => '¡El campo Fecha de salida es requerido!',

            'numeroFacturaLiquidacion.required'  => '¡El campo No. de Factura es requerido!',
            'numeroFacturaLiquidacion.string'  => '¡El campo No. de Factura no es correcto!',
            'numeroFacturaLiquidacion.unique'  => '¡El No. de Factura ya existe!',

            'montoFacturaLiquidacion.required'  => '¡El campo Total es requerido!',
            'montoFacturaLiquidacion.numeric'  => '¡El valor del campo Total debe ser numérico!',
            'montoFacturaLiquidacion.min'  => '¡El valor del campo Total no debe ser menor a :min!',

            'name.required'  => '¡Es necesario que liquide por lo menos un vale!',
            'name.min'  => '¡Es necesario que liquide por lo menos un vale!',

        ];
    }

    public function createLiquidacion($data){

        $liquidacion=Liquidacion::create([
            'fechaLiquidacion' => $data['fechaLiquidacion'],
            'numeroFacturaLiquidacion' => $data['numeroFacturaLiquidacion'],
            'montoFacturaLiquidacion' => $data['montoFacturaLiquidacion']
        ]);

        $llaves = array_keys($data['name']);
        $max= count($llaves);

        for ($i = 0; $i < $max; $i++ ) {
            Vale::where('numeroVale', $llaves[$i])->update([
                'idLiquidacion' => $liquidacion->id,
                'estadoLiquidacionVal' => 1
            ]);
        }

    }
}