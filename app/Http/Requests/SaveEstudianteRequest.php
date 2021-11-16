<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEstudianteRequest extends FormRequest
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
            'nombre'=> 'required',
            'apellido1'=> 'required',
            'apellido2'=> 'required',
            'email'=> 'required|email',
            'cedula'=>'nullable',
            'telefono'=>'nullable',
            'direccion'=>'nullable'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'Por favor ingrese el nombre',
            'apellido1.required'=>'Por favor ingrese el primer apellido',
            'apellido2.required'=>'Por favor ingrese el segundo apellido',
            'email.email'=>'Ingrese un correo electrónico válido',
            'email.required'=>'El correo electrónico es obligatorio',

        ];
    }
}
