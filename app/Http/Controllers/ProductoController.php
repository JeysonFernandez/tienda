<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tipo;
use App\Models\Marca;
use App\Models\Color;
use App\Models\Proveedor;
use App\Models\Talla;
use App\Models\Categoria;
use App\Models\Genero;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use App\Http\Requests\StoreProductos;
use Illuminate\Http\Request;


use RealRashid\SweetAlert\Facades\Alert;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('productos.index', [
            'productos' => Producto::where('borrado', '=', 1)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.productos.create', [
            'tipos' => Tipo::all(),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'tallas' => Talla::all(),
            'colors' => Color::all(),
            'generos' => Genero::all(),
            'proveedores' => Proveedor::all(),
            'notificacionProductos' => NotificacionProducto::all(),
            'notificacionUsuarios' => NotificacionUsuario::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$validaData = $request->validate([
            'title' => 'required|min:3'
        ]);*/
        $producto = new Producto();
        $producto->tipo_id = $request->get('tipo');
        $producto->marca_id = $request->get('marca');
        $producto->categoria_id = $request->get('categoria');
        $producto->color_id = $request->get('color');
        $producto->talla_id = $request->get('talla');
        $producto->genero_id = $request->get('genero');
        $producto->proveedor_id = $request->get('proveedor');
        if ($request->get('stock_critico') > $request->get('stock_actual')) {
            $critico = $request->get('stock_actual');
        } else {
            $critico = $request->get('stock_critico');
        }
        $producto->stock_critico = $critico;
        $producto->stock_actual = $request->get('stock_actual');
        $producto->precio_unidad = $request->get('precio_unidad');
        $producto->fecha_creacion = now()->format('Y-m-d');
        $producto->imagen = $request->imagen->store('public/prendas');
        $producto->borrado = 1;
        $producto->save();

        return redirect()->route('admin.producto.getProducto', [
            'notificacionProductos' => NotificacionProducto::all(),
            'notificacionUsuarios' => NotificacionUsuario::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        $producto = Producto::where('borrado', '=', 1)->findOrFail($producto->id);
        return view('productos.detalle', [
            'producto' => $producto,
            'productos' => Producto::inRandomOrder()->take(6)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Producto::find($id);

        return view('admin.productos.edit', [
            'producto' => $producto,
            'tipos' => Tipo::all(),
            'categorias' => Categoria::all(),
            'marcas' => Marca::all(),
            'tallas' => Talla::all(),
            'colors' => Color::all(),
            'generos' => Genero::all(),
            'notificacionProductos' => NotificacionProducto::all(),
            'notificacionUsuarios' => NotificacionUsuario::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->tipo_id = $request->get('tipo');
        $producto->marca_id = $request->get('marca');
        $producto->categoria_id = $request->get('categoria');
        $producto->color_id = $request->get('color');
        $producto->talla_id = $request->get('talla');
        $producto->stock_critico = $request->get('stock_critico');
        $producto->stock_actual = $request->get('stock_actual');
        $producto->precio_unidad = $request->get('precio_unidad');
        $producto->imagen = $request->imagen->store('public/prendas');
        $producto->save();
        return redirect()->route('admin.producto.getProducto');
    }

    public function confirmarUpdate(StoreProductos $request)
    {

        $producto = Producto::find($request->get('id'));

        $producto->tipo_id = $request->get('tipo');
        $producto->marca_id = $request->get('marca');
        $producto->categoria_id = $request->get('categoria');
        $producto->color_id = $request->get('color');
        $producto->talla_id = $request->get('talla');
        if ($request->get('stock_critico') > $request->get('stock_actual')) {
            $critico = $request->get('stock_actual');
        } else {
            $critico = $request->get('stock_critico');
        }


        $producto->stock_critico = $critico;
        $producto->stock_actual = $request->get('stock_actual');
        $producto->precio_unidad = $request->get('precio_unidad');

        if(isset($request->imagen)){
            $producto->imagen = $request->imagen->store('public/prendas');
        }

        $producto->save();
        return redirect()->route('admin.producto.getProducto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->borrado = 2;
        $producto->save();
        return redirect()->route('admin.producto.getProducto');
    }

    public function confirmDelete(Request $request)
    {
        $producto = Producto::findOrFail($request->idfinal);
        $producto->borrado = 2;
        $producto->save();
        return redirect()->route('admin.producto.getProducto');
    }

    public function homeProductos()
    {
        //Alert::success('Gola','chao');

        return view('home.index', [
            'productos' => Producto::where('borrado', '=', 'no')->inRandomOrder()->take(20)->get(),
        ]);
    }

    public function carrito()
    {

        return view('productos.carrito');
    }

    public function addCarrito($id)
    {
        $producto = Producto::find($id);
        $carro = session()->get('carro');

        if (!$carro) {
            $carro = [$id => [
                'id' => $producto->id,
                'precio' => $producto->precio_unidad,
                'cantidad_maxima' => $producto->stock_actual,
                'imagen' => $producto->imagen,
                'cantidad' => 1]];
        } else {
            if (isset($carro[$id])) {
                $carro[$id]['cantidad']++;
                $carro[$id]['cantidad_maxima'] = $producto->stock_actual;
            } else {
                $carro[$id] = [
                'id' => $producto->id,
                'precio' => $producto->precio_unidad,
                'cantidad_maxima' => $producto->stock_actual,
                'imagen' => $producto->imagen,
                'cantidad' => 1];
            }
        }
        session()->put('carro', $carro);
        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function borrarElementoCarro($id)
    {
        $carro = session()->get('carro');
        unset($carro[$id]);
        session()->put('carro', $carro);
        return redirect()->back();
    }

    public function borrarCarro()
    {
        $carro = session()->get('carro');
        foreach (session('carro') as $id => $detalles) {
            unset($carro[$id]);
        }
        session()->put('carro', $carro);
        return redirect()->back();
    }
    public function actualizarCarrito(Request $request, $id)
    {
        $carro = session()->get('carro');
        $carro[$id]['cantidad'] = $request->get('cantidad');
        session()->put('carro', $carro);

        return redirect()->back();
    }
}
