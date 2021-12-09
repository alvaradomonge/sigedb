<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMateriaRequest extends FormRequest
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
            'nombre'=> 'required|max:50',
            'id_grupo_guia'=> 'required|max:20',
            'id_libro_notas'=> 'required|max:20',
            'id_user'=> 'required|max:20',
            'id_estado'=> 'required|max:20',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'Por favor ingrese el nombre',
            'nombre.max'=>'El nombre no debe exceder los 50 caracteres',
            'id_grupo_guia.required'=>'Por favor elegir el grupo',
            'id_libro_notas.required'=>'Por favor elegir el libro de notas',
            'id_user.required'=>'Por favor ingrese el docente',
            'id_estado.required'=>'Por favor ingrese el estado de la materia',
        ];
    }
}
