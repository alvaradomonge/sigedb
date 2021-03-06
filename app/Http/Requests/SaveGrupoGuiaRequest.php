<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveGrupoGuiaRequest extends FormRequest
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
            'id_periodo'=> 'required|max:20'
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'=>'Por favor ingrese el nombre',
            'nombre.max'=>'El nombre no debe exceder los 50 caracteres',
            'id_periodo.required'=>'Por favor elegir el periodo',
        ];
    }
}
