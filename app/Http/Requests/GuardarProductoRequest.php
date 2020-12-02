<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

use App\Models\Producto;

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
            'stock_critico' => 'required_if:estado,'.Producto::PUBLICADO,
            'stock_actual' =>  'required_if:estado,'.Producto::PUBLICADO,
            'precio_unidad' =>  'required_if:estado,'.Producto::PUBLICADO,
            'tipo' =>  'required_if:estado,'.Producto::PUBLICADO,
            'talla' =>  'required_if:estado,'.Producto::PUBLICADO,
            'color' =>  'required_if:estado,'.Producto::PUBLICADO,
            'genero' =>  'required_if:estado,'.Producto::PUBLICADO,
            'categoria' =>  'required_if:estado,'.Producto::PUBLICADO,
            'marca' =>  'required_if:estado,'.Producto::PUBLICADO,
            'proveedor' =>  'required_if:estado,'.Producto::PUBLICADO,
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

            '*.required_if'   => 'Complete el campo :attribute cuando el estado es PUBLICADO',
        ];
    }


}
