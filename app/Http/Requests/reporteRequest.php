<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class reporteRequest extends FormRequest
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
            'inicio'=>'required',
            'fin'=>'required|after_or_equal:inicio',
        ];
    }
    public function messages(){
        return[
            'inicio.required'=>'*Es nesesario ingresar una fecha',
            'fin.required'=>'*Es nesesario ingresar una fecha',
            'fin.after_or_equal'=>'*La fecha debe ser una fecha posterior o igual a inicio',
        ];
    }
}
