<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GuardarCategoriaRequest extends FormRequest
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

        if(!isset($this->id)){
            $this->id = '';
        }


        return [
            'nombre' => ['required','max:100', Rule::unique('categorias')->ignore($this->id),]
        ];
    }
    public function messages()
    {
        return [
            'nombre.required'   => 'Debes ingresar el nombre',
            'nombre.max'        => 'El nombre debe tener como máximo 100 caracteres',
            'nombre.unique'     => 'Este nombre ya está siendo usado'
        ];
    }


}
