<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePeriodoRequest extends FormRequest
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
            'id_anio'=> 'required',
            'activo'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            'nombre'=>'Por favor ingrese el nombre',
            'id_anio'=>'Por favor seleccione el año',
            'activo'=> 'Agregue la condición'
        ];
    }
}