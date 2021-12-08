<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLibroNotasRequest extends FormRequest
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
            'es_cualitativo'=> 'required|max:1',
        ];
    }
    public function messages()
    {
        return [
            'es_cualitativo.required'=>'Por favor ingrese el tipo de libro de notas',
            'es_cualitativo.max'=>'No debe exceder de 1 caracteres',
        ];
    }
}
