<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=> 'required|unique:users,name,'.$this->user['id'],
            'email'=> 'required|email|unique:users,email,'.$this->user['id'],
            'password' => 'confirmed',
        ];
    }
    public function messages(){
        return [
            'name.required' => '¡Por favor ingrese el nombre de usuario!',
            'name.unique' => '¡El nombre de la usuario ya existe!',
            'email.required' => '¡Por favor ingrese el correo del usuario!',
            'email.unique' => '¡El correo de la usuario ya existe!',
            'email.email' => 'Ingrese un correo válido',
            'password.confirmed' => '¡Las Contraseñas no son iguales!',

        ];
    }
}
