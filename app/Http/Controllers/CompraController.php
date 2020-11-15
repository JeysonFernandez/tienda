<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Producto;
use App\Models\Usuario;
use App\Models\CompraProducto;
use App\Http\Requests\StoreCompraRequest;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteUsuario;
use App\Mail\ReporteAdmin;
use App\Models\Rey;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('compras.index',[
            'compras' => Compra::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
        $usuarios = Usuario::all();
        return view('admin.compras.crear_compra',['usuarios' => $usuarios, 'productos' => $productos,'notificacionProductos'=>NotificacionProducto::all(),
        'notificacionUsuarios'=>NotificacionUsuario::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }

    public function agregar(StoreCompraRequest $request){
        $compra = new Compra();
        $compra->usuario_id = $request->get('usuario');
        $compra->deuda_total = $request->get('deuda_total');
        $compra->deuda_pendiente = $compra->deuda_total - $request->get('abono');
        $compra->fecha_siguiente_pago = $request->get('fecha_siguiente_pago');
        $compra->fecha_compra = $request->get('fecha_compra');
        if($compra->deuda_pendiente > 0){
            $compra->estado = 'p';
        }else{
            $compra->estado = 'c';
        }

        $usuario = Usuario::findOrFail($compra->usuario_id);
        $nombreCompleto = $usuario->nombre.' '.$usuario->apellido.'(Fono: '.$usuario->fono.')';
        $correo = (['nombreUsuario'=>$nombreCompleto,'fecha'=>$compra->fecha_compra,'tipo'=>'compra','fecha_siguiente_pago'=>$compra->fecha_siguiente_pago, 'total'=>$compra->deuda_total]);

        Mail::to($usuario->username)->send(new ReporteUsuario($correo));
        Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
        //insertar nueva notificacion
        $notificacionUsuario = new NotificacionUsuario();
        $notificacionUsuario->fecha_creacion = now()->format('Y-m-d');
        $notificacionUsuario->tipo = 'C';
        $notificacionUsuario->mensaje='Se ha registrado la compra de '.$usuario->nombre.' '.$usuario->apellido;
        $notificacionUsuario->usuario_id = $usuario->id;
        $notificacionUsuario->click = 'n';
        $notificacionUsuario->save();

        $compra->save();

        //Agregar deuda al usuario
        $usuario->deuda_total += $compra->deuda_total;
        $usuario->save();
        //guardar compra_producto
        $compras = Compra::all();
        $ultimaCompra = $compras->last();
        foreach (session('carro') as $id => $detalles){
            $compraProducto = new CompraProducto();
            $compraProducto->producto_id = $detalles['id'];
            $compraProducto->compra_id = $ultimaCompra->id;
            $compraProducto->cantidad_producto = $detalles['cantidad'];

            //Descontar cantidad de producto
            $producto = Producto::findOrFail($compraProducto->producto_id);
            $nuevoStock = $producto->stock_actual - $compraProducto->cantidad_producto;
            $producto->stock_actual = $nuevoStock;

            $producto->cant_vendida += $compraProducto->cantidad_producto;
            $max_venta = Rey::find(1);
            if($max_venta->cantidad < $producto->cant_vendida){
                $max_venta->producto_id = $producto->id;
                $max_venta->cant_vendida = $producto->cant_vendida;
                $notificacionProducto = new NotificacionProducto();
                $notificacionProducto->fecha_creacion = now()->format('Y-m-d');
                $notificacionProducto->tipo = 'r';
                $notificacionProducto->mensaje=$producto->id.'es el nuevo rey del lugar $$$.';
                $notificacionProducto->productos_id= $producto->id;
                $notificacionProducto->click = 'n';

                $notificacionProducto->save();
                $correo=['nombreProducto'=>$producto->id,'tipo'=>'reyVentas'];
                Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
            }


            //Notificacion producto
            if($producto->stock_Actual<= $producto->stock_critico){
                //insertar nueva notificacion
                $notificacionProducto = new NotificacionProducto();
                $notificacionProducto->fecha_creacion = now()->format('Y-m-d');
                $notificacionProducto->tipo = 'c';
                $notificacionProducto->mensaje='El producto '.$producto->id.'ahora está en estado critico';
                $notificacionProducto->productos_id= $producto->id;
                $notificacionProducto->click = 'n';

                $notificacionProducto->save();

                $correo=['nombreProducto'=>$producto->id,'cantidad'=>$producto->stock_actual,'tipo'=>'producto_critico'];
                Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
            }
            if($producto->stock_Actual== 0){
                //insertar nueva notificacion
                $notificacionProducto = new NotificacionProducto();
                $notificacionProducto->fecha_creacion = now()->format('Y-m-d');
                $notificacionProducto->tipo = 'n';
                $notificacionProducto->mensaje='Ya no queda stock de '.$producto->id;
                $notificacionProducto->productos_id = $producto->id;
                $notificacionProducto->click = 'n';
                $notificacionProducto->save();

                $correo=['nombreProducto'=>$producto->id,'tipo'=>'sinStock'];
                Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
            }

            $producto->save();

            $valor= $detalles['precio'] * $detalles['cantidad'];
            $compraProducto->costo_total = $valor;
            $compraProducto->save();
        }
        $carro= session()->get('carro');
        foreach(session('carro') as $id => $detalles){
            unset($carro[$id]);
        }
        session()->put('carro',$carro);
        return redirect('/admin/compras');
    }

    public function addCarrito(Request $request)
    {
        $producto = Producto::find($request->get('producto'));
        $carro = session()->get('carro');

        if(!$carro){
            $carro = [$request->get('producto') => [
                'id' => $producto->id,
                'precio' => $producto->precio_unidad,
                'cantidad_maxima' => $producto->stock_actual,
                'imagen' => $producto->imagen,
                'cantidad' => $request->get('cantidad')]];
        }else{
            if(isset($carro[$request->get('producto')])){
                if($producto->stock_actual >= $carro[$request->get('producto')]['cantidad']+1 ){
                    $carro[$request->get('producto')]['cantidad']+=$request->get('cantidad');
                }
                $carro[$request->get('producto')]['cantidad_maxima'] = $producto->stock_actual;
            }else{
                $carro[$request->get('producto')] =[
                    'id' => $producto->id,
                    'precio' => $producto->precio_unidad,
                    'cantidad_maxima' => $producto->stock_actual,
                    'imagen' => $producto->imagen,
                    'cantidad' => $request->get('cantidad')];
            }
        }
        session()->put('carro',$carro);
        return redirect()->back()->with('success','Product added to cart successfully');
    }

    public function confirmDelete(Request $request)
    {
        $compra = Compra::findOrFail($request->idfinal);

        $compraproductos = CompraProducto::where('compra_id',$compra->id);
        foreach($compraproductos as $compraproducto){
            $compraproducto->delete();
        }

        $compra->delete();
        return redirect()->route('admin.getcompras');
    }

    public function detalleCompraUsuario($id){
        $productos = CompraProducto::where('compra_id',$id)->get();
        return view('admin.usuarios.detalleCompra',['productos'=>$productos,'notificacionProductos' => NotificacionProducto::all(),
        'notificacionUsuarios' => NotificacionUsuario::all()]);
    }
    public function detalleCompraUsuarioCuenta($id){
        $productos = CompraProducto::where('compra_id',$id)->get();
        return view('usuarioMenu.compras.detalleCompra',['productos'=>$productos,'notificacionProductos' => NotificacionProducto::all(),
        'notificacionUsuarios' => NotificacionUsuario::all()]);
    }
}
