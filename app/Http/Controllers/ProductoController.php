<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarProductoRequest;
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
use Illuminate\Support\Facades\Auth;

use App\Exports\ProductoExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


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
            'productos' => Producto::where('borrado', '!=', 3)->get()
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
            'tipos' => Tipo::where('borrado','!=',2)->get(),
            'categorias' => Categoria::where('borrado','!=',2)->get(),
            'marcas' => Marca::where('borrado','!=',2)->get(),
            'tallas' => Talla::where('borrado','!=',2)->get(),
            'colors' => Color::where('borrado','!=',2)->get(),
            'generos' => Genero::where('borrado','!=',2)->get(),
            'proveedores' => Proveedor::where('borrado','!=',2)->get(),
            'notificacionProductos' => NotificacionProducto::where('borrado','!=',2)->get(),
            'notificacionUsuarios' => NotificacionUsuario::where('borrado','!=',2)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarProductoRequest $request)
    {
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
        $producto->borrado = $request->get('estado');
        if(isset($request->imagen)){
            $producto->imagen = $request->imagen->store('public/prendas');
        }
        $producto->save();

        alert()->success('Perfecto!','Se ha agregado un nuevo producto.');
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
    public function verProducto($id)
    {
        $producto = Producto::where('borrado', '!=', 3)->findOrFail($id);
        return view('publico.producto.detalle', [
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
    public function editarProducto($id)
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

    public function export()
    {
        return Excel::download(new ProductoExport, 'producto-' . now()->format('d-m-Y') . '.xlsx');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function updateProducto(GuardarProductoRequest $request, $id)
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
        if(isset($request->imagen)){
            $producto->imagen = $request->imagen->store('public/prendas');
        }
        $producto->borrado = $request->get('estado');
        $producto->save();
        return redirect()->route('admin.producto.getProducto');
    }

    public function confirmarUpdate(Request $request)
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
        $producto->borrado = $request->get('estado');
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
        $producto->borrado = 3;
        $producto->save();
        alert()->success('Perfecto!','El producto se ha eliminado correctamente.');
        return redirect()->route('admin.producto.getProducto');
    }

    public function confirmDelete(Request $request)
    {
        $producto = Producto::findOrFail($request->idfinal);
        $producto->borrado = 3;
        $producto->save();
        alert()->success('Perfecto!','El producto se ha eliminado correctamente.');
        return redirect()->route('admin.producto.getProducto');
    }

    public function homeProductos()
    {
        //Alert::success('Gola','chao');
        $cantidad = Producto::where([['borrado','=',1],['cant_vendida','>',0]])->count();
        if($cantidad>0){
            $productosVendidos = Producto::where([['borrado','=',1],['cant_vendida','>',0]])->orderBy('cant_vendida')->take(2)->get();
            return view('home.index', [
                'productos' => Producto::where('borrado', '=', 1)->inRandomOrder()->take(20)->get(),
                'cantidad' => $cantidad,
                'productosVendidos' => $productosVendidos
            ]);
        }
        return view('home.index', [
            'productos' => Producto::where('borrado',1)->inRandomOrder()->take(20)->get(),
            'cantidad' => $cantidad
        ]);
    }

    public function carrito()
    {
        if(Auth::check()){
            $carro = session()->get('carro');
            if(!$carro){
                alert()->info('No hay productos en el carrito','Antes de ver tu carrito, primero debes añadir productos');
                return redirect()->route('index');
            }else{
                $productos = Producto::all();
                return view('publico.confirmarPedido.carrito', compact('productos'));
            }
        }else{
            alert()->info('Debes iniciar sesión','Antes de ver tu carrito, primero debes iniciar sesión');
            return redirect()->route('index');
        }
    }

    public function addCarrito($id)
    {
        $producto = Producto::find($id);
        if($producto->stock_actual==0){
            alert()->success('Lo sentimos','Este producto está agotado');
            return redirect()->back();
        }
        $carro = session()->get('carro');

        if (!$carro) {
            $carro = [$id => [
                'id' => $producto->id,
                'precio' => $producto->precio_unidad,
                'cantidad_maxima' => $producto->stock_actual,
                'imagen' => $producto->imagen,
                'nombre' => $producto->id,
                'cantidad' => 1],];
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
                'nombre' => $producto->id,
                'cantidad' => 1];
            }
        }
        session()->put('carro', $carro);
        if(Auth::check()){
            alert()->success('Perfecto!','Se ha añadido un elemento a tu carrito. Puedes editar la cantidad del producto desde el mismo carrito.');
        }else{
            alert()->success('Perfecto!','Se ha añadido un elemento a tu carrito. Puedes editar la cantidad del producto desde el mismo carrito. Para verlo, inicia sesión.');
        }

        return redirect()->back();
    }

    public function borrarElementoCarro($id)
    {
        $carro = session()->get('carro');
        unset($carro[$id]);
        session()->put('carro', $carro);

        alert()->success('Elemento eliminado.','Se ha eliminado un producto de tu carrito');
        return redirect()->back();
    }

    public function borrarCarro()
    {
        $carro = session()->get('carro');
        foreach (session('carro') as $id => $detalles) {
            unset($carro[$id]);
        }
        session()->put('carro', $carro);
        alert()->success('Perfecto!','Tu carrito ha sido limpiado exitosamente.');

        return redirect()->route('index');
    }
    public function actualizarCarrito(Request $request, $id)
    {
        $carro = session()->get('carro');
        $carro[$id]['cantidad'] = $request->get('cantidad');
        session()->put('carro', $carro);

        return redirect()->back();
    }
}
