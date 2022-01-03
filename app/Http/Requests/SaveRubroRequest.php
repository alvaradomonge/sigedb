<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRubroRequest extends FormRequest
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
            'id_materia'=> 'required',
            'valor_porcentual'=> 'numeric'
        ];
    }
    public function messages()
    {
        return [
            'nombre'=>'Por favor ingrese el nombre',
            'nombre.max'=>'El nombre no debe exceder los 50 caracteres',
            'id_materia'=>'Materia no indicada',
            'valor_porcentual.numeric'=> 'El valor porcentual debe ser numérico, no incluya símbolos (por ejemplo %) ni letras'
        ];
    }
}