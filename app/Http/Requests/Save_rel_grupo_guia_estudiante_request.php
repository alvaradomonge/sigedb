<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Save_rel_grupo_guia_estudiante_request extends FormRequest
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
    	$id = $this->request->get('id_grupo_guia') ? ',' . $this->request->get('id_grupo_guia') : '';
        return [
            'id_grupo_guia'=> 'required',
            'id_user'=> 'required|unique:grupo_guia'.$id
        ];
    }
    public function messages()
    {
        return [
            'id_grupo_guia'=>'Campo requerido',
            'id_user.unique'=>'El estudiante ya existe',
        ];
    }
}