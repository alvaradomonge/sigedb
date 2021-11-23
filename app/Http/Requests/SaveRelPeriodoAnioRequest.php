<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRelPeriodoAnioRequest extends FormRequest
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
            'id_anio'=> 'required',
            'id_periodo'=> 'required',
            'valor_porcentual'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'id_anio'=>'Por favor ingrese el id_anio',
            'id_periodo'=>'Por favor ingrese el id_periodo',
            'valor_porcentual'=>'Por favor ingrese el valor_porcentual',
        ];
    }
}