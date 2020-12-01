<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class GuardarProductoRequest extends FormRequest
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
            'stock_critico' => 'required',
            'stock_actual' => 'required',
            'precio_unidad' => 'required',
            'tipo' => 'required',
            'talla' => 'required',
            'color' => 'required',
            'genero' => 'required',
            'categoria' => 'required',
            'marca' => 'required',
            'proveedor' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'stock_critico' => 'Stock Critico',
            'stock_actual' => 'Stock Actual',
            'precio_unidad' => 'Precio Unidad',
            'tipo_id' => 'Tipo',
            'talla_id' => 'Talla',
            'color_id' => 'Color',
            'genero_id' => 'Genero',
            'categoria_id' => 'Categoria',
            'marca_id' => 'Marca',
            'proveedor_id' => 'Proveedor',
        ];
    }
    public function messages()
    {
        return [
            '*.required'   => 'Complete el campo :attribute',
        ];
    }


}
