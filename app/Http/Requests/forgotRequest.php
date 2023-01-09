<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class forgotRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password'=>'required|min:6',
            'password_confirmation'=>'required|same:password'
        ];
    }
    public function messages(){
        return[
            'password.required'=>'El usuario debe tener una contraseña',
            'password_confirmation.required'=>'El usuario debe tener una contraseña',
            'password.min'=>'La contraseña debe tener mas de 6 caracteres',
            'password_confirmation.same'=>'Los campos deben coincidir'
        ];
    }
}
