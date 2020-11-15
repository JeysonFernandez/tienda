<?php

namespace App\Http\Controllers;

use App\Models\CompraProducto;
use App\Models\Pedido;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Fecha;
use App\Http\Requests\StorePedidoRequest;
use App\Models\PedidoProducto;
use App\Models\NotificacionUsuario;
use App\Models\NotificacionProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteUsuario;
use App\Mail\ReporteAdmin;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }

    public function cancelar($id){
        $pedido = Pedido::findOrFail($id);
        $pedido->estado = 'c';

        $productosPedido = PedidoProducto::where('pedido_id',$pedido->id);
        foreach($productosPedido as $productoPedido){
            $producto = Producto::find($productoPedido->producto_id);
            $producto->stock_actual += $productoPedido->cantidad;
            $producto->save();
        }

        $pedido->save();
        return redirect()->back();
    }

    public function agregar(StorePedidoRequest $request, $id){
        $pedido = new Pedido();
        $pedido->usuario_id = $id;
        $pedido->lugar_visita = $request->get('lugar');
        $pedido->fecha = $request->get('fecha');
        $pedido->hora = $request->get('hora');
        $pedido->tipo = $request->get('tipo');
        //Validación de datos
        $mensaje = '';
        $fechas = Fecha::all();
        foreach ($fechas as $fecha){
            if($fecha->fecha == $pedido->fecha && $fecha->hora == $pedido->hora){
                $mensaje = 'Esta fecha y lugar ya está ocupada';
            }
            else{
                if($fecha->fecha == $pedido->fecha){

                    $arregloFecha = explode(':', $fecha->hora);
                    //minutos fecha de la tabla
                    $horasUno = (int)$arregloFecha[0];
                    $minutosUno = (int)$arregloFecha[1];
                    $tiempoUno = $horasUno*60 + $minutosUno;

                    $arregloFechaPedido = explode(':', $pedido->hora);
                    //minutos fecha de la tabla
                    $horasDos = (int)$arregloFechaPedido[0];
                    $minutosDos = (int)$arregloFechaPedido[1];
                    $tiempoDos = $horasDos*60 + $minutosDos;

                    $resta_tiempo = $tiempoUno - $tiempoDos;
                    if($resta_tiempo<0){
                        $resta_tiempo*=-1;
                    }
                    if($resta_tiempo<$fecha->duracion){
                        $mensaje='Esta fecha ya está ocupada';
                    }
                }
            }
        }
        //Fin validación de datos

        //Si paso la validación de datos
        if ($mensaje == ''){
            //guardar pedido
            $usuario = Usuario::find($pedido->usuario_id);
            $nombreCompleto = $usuario->nombre.' '.$usuario->apellido.'(Fono: '.$usuario->fono.')';
            $correo = (['nombreUsuario'=>$nombreCompleto,'fecha'=>$pedido->fecha,'hora'=>$pedido->hora,'tipo'=>'pedido']);
            Mail::to($usuario->username)->send(new ReporteUsuario($correo));
            Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));

            //insertar nueva notificacion
            $notificacionUsuario = new NotificacionUsuario();
            $notificacionUsuario->fecha_creacion = now()->format('Y-m-d');
            $notificacionUsuario->tipo = 'p';
            $notificacionUsuario->mensaje='Se ha registrado el pedido de '.$usuario->nombre.' '.$usuario->apellido;
            $notificacionUsuario->usuario_id = $usuario->id;
            $notificacionUsuario->click = 'n';
            $notificacionUsuario->save();

            $pedido->save();
            //guardar fecha
            $fechaNueva = new Fecha();
            $fechaNueva->fecha = $pedido->fecha;
            $fechaNueva->hora = $pedido->hora;
            $fechaNueva->tipo = $pedido->tipo;
            if($fechaNueva->tipo == 'e'){
                $fechaNueva->duracion = 15;
            }
            else{
                $fechaNueva->duracion = 60;
            }
            $fechaNueva->save();

            //guardar pedido_producto
            $pedidos = Pedido::all();
            $ultimoPedido = $pedidos->last();
            foreach (session('carro') as $id => $detalles){
                //descontar stock
                $producto = Producto::find($detalles['id']);
                $producto->stock_actual -= $detalles['cantidad'];

            //Notificacion producto
            if($producto->stock_Actual<= $producto->stock_critico){
                //insertar nueva notificacion
                $notificacionProducto = new NotificacionProducto();
                $notificacionProducto->fecha_creacion = now()->format('Y-m-d');
                $notificacionProducto->tipo = 'c';
                $notificacionProducto->mensaje='El producto '.$producto->id.'ahora está en estado critico';
                $notificacionProducto->productos_id = $producto->id;
                $notificacionProducto->click = 'n';
                $notificacionProducto->save();

                $correo=['nombreProducto'=>$producto->id,'cantidad'=>$producto->stock_actual,'tipo'=>'producto_critico'];
                Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
            }
            if($producto->stock_Actual== 0){
                //insertar nueva notificacion
                $notificacionProducto = new NotificacionProducto();
                $notificacionProducto->fecha_creacion = now()->format('Y-m-d');
                $notificacionProducto->tipo = 'c';
                $notificacionProducto->mensaje='Ya no queda stock de '.$producto->id;
                $notificacionProducto->productos_id = $producto->id;
                $notificacionProducto->click = 'n';
                $notificacionProducto->save();

                $correo=['nombreProducto'=>$producto->id,'tipo'=>'sinStock'];
                Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
            }
                $producto->save();
                //guardar pedidoProducto
                $pedidoProducto = new PedidoProducto();
                $pedidoProducto->producto_id = $detalles['id'];
                $pedidoProducto->pedido_id = $ultimoPedido->id;
                $pedidoProducto->cantidad_producto = $detalles['cantidad'];

                $valor= $detalles['precio'] * $detalles['cantidad'];
                $pedidoProducto->valor_total = $valor;
                $pedidoProducto->save();
            }
            $carro= session()->get('carro');
            foreach(session('carro') as $id => $detalles){
                unset($carro[$id]);
            }
            session()->put('carro',$carro);
            return redirect(route('home'));
        }
        else{
            return redirect()->back()->with($mensaje);
        }
    }

    public function confirmDelete(Request $request)
    {
        $pedido = Pedido::findOrFail($request->idfinal);

        $pedidoproductos = PedidoProducto::where('pedido_id',$pedido->id);
        foreach($pedidoproductos as $pedidoproducto){
            $pedidoproducto->delete();
        }
        $fechapedido = Fecha::where(['fecha','=',$pedido->fecha],['hora','=',$pedido->hora]);
        $fechapedido->delete();
        $pedido->delete();
        return redirect()->route('admin.getpedidos');
    }

    public function detallePedidoUsuario($id){
        $productos = PedidoProducto::where('pedido_id',$id)->get();
        return view('admin.usuarios.detallePedido',['productos'=>$productos,'notificacionProductos' => NotificacionProducto::all(),
        'notificacionUsuarios' => NotificacionUsuario::all()]);
    }
    public function detallePedidoUsuarioCuenta($id){
        $productos = CompraProducto::where('compra_id',$id)->get();
        return view('usuarioMenu.pedidos.detallePedido',['productos'=>$productos,'notificacionProductos' => NotificacionProducto::all(),
        'notificacionUsuarios' => NotificacionUsuario::all()]);
    }

}
