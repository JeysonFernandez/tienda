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


    public function datos()
    {
        $categoria = Categoria::all();
        $color = Color::all();
        $marca = Marca::all();
        $talla = Talla::all();
        $proveedor = Proveedor::all();
        $tipo = Tipo::all();
        return view('buscador.index', [
            'categorias' => $categoria,
            'colors' => $color,
            'marcas' => $marca,
            'tallas' => $talla,
            'proveedors' => $proveedor,
            'tipos' => $tipo
        ]);
    }

    public function filtroBarra(Request $request)
    {
        $productos = Producto::where('borrado','=','no')->get();

        $categoria = Categoria::all();
        $color = Color::all();
        $marca = Marca::all();
        $talla = Talla::all();
        $proveedor = Proveedor::all();
        $tipo = Tipo::all();
        $genero = Genero::all();

        $mensaje = "";

        if($request->get('search') != ""){



            $producto = Producto::where('borrado','=','no')->get();
            $query = strtoupper(trim($request->get('search')));

            $productos = array();

            if ($query) {

                foreach ($producto as $prod) {


                    $data = array_merge(
                        ['tipo' => $prod->tipo->nombre],
                        ['categoria' => $prod->categoria->nombre],
                        ['color' => $prod->color->nombre],
                        ['genero' => $prod->genero->nombre],
                        ['marca' => $prod->marca->nombre],
                        ['talla' => $prod->talla->nombre],
                    );

                    foreach ($data as $dat) {
                        if (strtoupper($dat) == $query) {

                            array_push($productos, $prod);
                        }
                    }
                    $data = [];
                }
            }

            if(count($productos) < 1){
                $mensaje = "No existe productos para ".$request->get('search');
            }
        }


        return view('buscador.barra', [
            'categorias' => $categoria,
            'colors' => $color,
            'marcas' => $marca,
            'tallas' => $talla,
            'proveedors' => $proveedor,
            'tipos' => $tipo,
            'generos' => $genero,
            'productos' => $productos,
            'mensaje' => $mensaje
        ]);
    }

    public function filtroGeneral(Request $request)
    {

        $categoria = Categoria::all();
        $color = Color::all();
        $marca = Marca::all();
        $talla = Talla::all();
        $proveedor = Proveedor::all();
        $tipo = Tipo::all();
        $genero = Genero::all();
        $mensaje = "";



        $categoriaId = $request->get('categoria');
        $colorId = $request->get('color');
        $marcaId = $request->get('marca');
        $tallaId = $request->get('talla');
        $proveedorId = $request->get('proveedor');
        $tipoId = $request->get('tipo');
        $generoId = $request->get('genero');


        $productos = Producto::where('borrado','=','no')->where(function($query) use ($categoriaId){
        if($categoriaId){
        $query->where('categoria_id',$categoriaId);
        }
        })->
        where(function($query) use ($colorId){
        if($colorId){
        $query->where('color_id',$colorId);
        }
        })->
        where(function($query) use ($marcaId){
        if($marcaId){
        $query->where('marca_id',$marcaId);
        }
        })->
        where(function($query) use ($tallaId){
        if($tallaId){
        $query->where('talla_id',$tallaId);
        }
        })->
        where(function($query) use ($proveedorId){
        if($proveedorId){
        $query->where('proveedor_id',$proveedorId);
        }
        })->
        where(function($query) use ($tipoId){
        if($tipoId){
        $query->where('tipo_id',$tipoId);
        }
        })->
        where(function($query) use ($generoId){
        if($generoId){
        $query->where('genero_id',$generoId);
        }
        })
        ->get();

        $count = 0;
        foreach($productos as $producto){
            $count++;
        }

        if($count == 0){
            $mensaje = "No existen productos con ese filtro";
        }


        return view('buscador.barra', [
            'categorias' => $categoria,
            'colors' => $color,
            'marcas' => $marca,
            'tallas' => $talla,
            'proveedors' => $proveedor,
            'tipos' => $tipo,
            'generos' => $genero,
            'productos' => $productos,
            'mensaje' => $mensaje
        ]);
    }

    public function busqueda(Request $request)
    {
        $productos = Producto::query();
        $productos->activas();

        $categorias = Categoria::all();
        $colores = Color::all();
        $marcas = Marca::all();
        $tallas = Talla::all();
        $proveedores = Proveedor::all();
        $tipos = Tipo::all();
        $generos = Genero::all();

        if ( $request->isMethod('get') ) {
            $input = $request->all();

            /*if(isset($input['buscadorTexto'])){

                $concesiones ->where('nombre','LIKE', '%' .$input['buscadorTexto'] . '%')
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

            $productos = $productos->get();

            return view('publico.buscador.resultados',compact('productos','categorias','colores','marcas','tallas','proveedores','tipos','generos','input'));
        }

        $input = [];
        $productos = Producto::activas()->get();
        return view('publico.buscador.resultados',compact('productos','categorias','colores','marcas','tallas','proveedores','tipos','generos','input'));
    }

}
