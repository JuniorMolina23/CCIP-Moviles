<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CCIPRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required',
            'lastname' => 'required',
            'username' => 'required|unique:usuario_c_c_i_p_s',
            'email' => 'required|email|unique:usuario_c_c_i_p_s',
            'password' => 'required|min:6'
        ];
    }
    public function messages()
    {
        return[
            'name.required'=>'*El campo nombre es requerido',
            'lastname.required'=>'*El campo apellido es requerido',
            'username.required'=>'*El nombre de usuario es requerido',
            'email.required'=>'*El campo correo es requerido',
            'password.required'=>'*El usuario debe de tener una contraseña',
            'username.unique'=>'*El nombre de usuario ya existe',
            'email.unique'=>'*El correo ya ha sido registrado',
            'password.min'=>'La contraseña debe ser mayor a 6 caracteres'
        ];
    }
}
