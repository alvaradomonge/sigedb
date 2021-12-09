<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveUser extends FormRequest
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
            'name'=> 'required|max:20',
            'apellido1'=> 'required|max:20',
            'apellido2'=> 'required|max:20',
            'email'=> 'required|email',
            'cedula'=>'nullable',
            'telefono'=>'nullable',
            'direccion'=>'nullable'
            'id_estado'=>'required',
            'id_rol_usuario'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'Por favor ingrese el nombre',
            'nombre.max'=>'El nombre no debe exceder los 20 caracteres',
            'apellido1.required'=>'Por favor ingrese el primer apellido',
            'apellido1.max'=>'El apellido no debe exceder los 20 caracteres',
            'apellido2.required'=>'Por favor ingrese el segundo apellido',
            'apellido2.max'=>'El apellido no debe exceder los 20 caracteres',
            'email.email'=>'Ingrese un correo electrónico válido',
            'email.required'=>'El correo electrónico es obligatorio',

        ];
    }
}
