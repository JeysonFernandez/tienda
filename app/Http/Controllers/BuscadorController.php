<?php

namespace App\Http\Controllers;


use App\Models\Categoria;
use App\Models\Color;
use App\Models\Marca;
use App\Models\Talla;
use App\Models\Proveedor;
use App\Models\Tipo;
use App\Models\Genero;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BuscadorController extends Controller
{

    public function verProducto($id)
    {
        $producto = Producto::find($id);

        return view('publico.buscador.ver',compact('producto'));
    }



    public function busqueda(Request $request)
    {
        $productos = Producto::query();


        $categorias = Categoria::all();
        $colores = Color::all();
        $marcas = Marca::all();
        $tallas = Talla::all();
        $proveedores = Proveedor::all();
        $tipos = Tipo::all();
        $generos = Genero::all();

        if ( $request->isMethod('get') ) {
            $input = $request->all();
            dump($input);
            /*if(isset($input['buscadorTexto'])){

                $productos ->where('nombre','LIKE', '%' .$input['buscadorTexto'] . '%')
                    ->orWhere('sector','LIKE', '%' . $input['buscadorTexto'] . '%')
                    ->orWhere('resena_tecnica','LIKE', '%' .$input['buscadorTexto'] . '%')
                    ->orWhere('titulo_fotografias','LIKE', '%' .$input['buscadorTexto'] . '%');
            }*/

            if (isset($input['tipo_id'])) {
                $productos->where('tipo_id',$input['tipo_id']);

            }

            if (isset($input['color_id'])) {
                $productos->where('color_id',$input['color_id']);

            }

            if (isset($input['genero_id'])) {
                $productos->where('genero_id',$input['genero_id']);
            }

            if (isset($input['categoria_id'])) {
                $productos->where('categoria_id',$input['categoria_id']);
            }

            if (isset($input['marca_id'])) {
                $productos->where('marca_id',$input['marca_id']);
            }

            if (isset($input['proveedor_id'])) {
                $productos->where('proveedor_id',$input['proveedor_id']);

            }
            dump($productos->get());
            $productos = $productos->activas()->get();
            return view('publico.buscador.resultados',compact('productos','categorias','colores','marcas','tallas','proveedores','tipos','generos','input'));
        }

        $input = [];
        $productos = Producto::activas()->get();
        return view('publico.buscador.resultados',compact('productos','categorias','colores','marcas','tallas','proveedores','tipos','generos','input'));
    }

}
