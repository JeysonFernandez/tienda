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
}
