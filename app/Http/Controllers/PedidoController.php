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


use App\Exports\PedidoExport;
use App\Exports\PedidoUsuarioExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Mail\PedidoUsuarioMail;
use Exception;

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

    public function agregar(Request $request, $id){
        $pedido = new Pedido();
        $pedido->usuario_id = $id;
        $pedido->lugar_visita = $request->get('lugar');
        $pedido->fecha = $request->get('fecha');
        $pedido->fecha_hora_inicio = $request->get('hora');
        $pedido->tipo = $request->get('tipo_id');
        $pedido->estado = 1; //pendiente 2 es completado

        //fecha_hora_fin
        $horaMinuto = explode((':'),$request->get('hora'));
        $total = $horaMinuto[0]*60  + $horaMinuto[1] ;
        if($request->get('tipo_id') == 1){
            $total += 60;
        }else{
            $total += 30;
        }
        $hora = (string)(intdiv($total,60));
        $minuto =(string)(fmod($total,60));
        if( (int)$minuto<10 ){
            $minuto = '0'.$minuto;
        }
        $fin = $hora.':'.$minuto;
        $pedido->fecha_hora_fin = $fin;
        $pedido->save();


        //guardar pedido
        $usuario = Usuario::find($pedido->usuario_id);
        $nombreCompleto = $usuario->nombre.' '.$usuario->apellido.'(Fono: '.$usuario->fono.')';


        //insertar nueva notificacion
        $notificacionUsuario = new NotificacionUsuario();
        $notificacionUsuario->fecha_creacion = now()->format('Y-m-d');
        $notificacionUsuario->tipo = 'p';
        $notificacionUsuario->mensaje='Se ha registrado el pedido de '.$usuario->nombre.' '.$usuario->apellido;
        $notificacionUsuario->usuario_id = $usuario->id;
        $notificacionUsuario->click = 1;
        $notificacionUsuario->save();



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
                $notificacionProducto->producto_id = $producto->id;
                $notificacionProducto->click = 1;
                $notificacionProducto->save();

                $correo=['nombreProducto'=>$producto->id,'cantidad'=>$producto->stock_actual,'tipo'=>'producto_critico'];
            }
            if($producto->stock_Actual== 0){
                //insertar nueva notificacion
                $notificacionProducto = new NotificacionProducto();
                $notificacionProducto->fecha_creacion = now()->format('Y-m-d');
                $notificacionProducto->tipo = 'c';
                $notificacionProducto->mensaje='Ya no queda stock de '.$producto->id;
                $notificacionProducto->producto_id = $producto->id;
                $notificacionProducto->click = 1;
                $notificacionProducto->save();

                $correo=['nombreProducto'=>$producto->id,'tipo'=>'sinStock'];
            }
            $producto->save();
            //guardar pedidoProducto
            $pedidoProducto = new PedidoProducto();
            $pedidoProducto->producto_id = $detalles['id'];
            $pedidoProducto->pedido_id = $ultimoPedido->id;
            $pedidoProducto->cantidad = $detalles['cantidad'];

            $valor= $detalles['precio'] * $detalles['cantidad'];
            $pedidoProducto->costo = $valor;
            $pedidoProducto->save();
        }
        
        try{
            Mail::to($usuario->email)->send(new PedidoUsuarioMail($usuario,$pedido));
        }catch(Exception $e){
            dd('chuta');
            alert()->error('Ups','Algo ha pasado, no se puede mandar el correo');
            return redirect()->route('index');
        }
        $carro= session()->get('carro');
        foreach(session('carro') as $id => $detalles){
            unset($carro[$id]);
        }
        session()->put('carro',$carro);
        alert()->success('Perfecto!','Su pedido ha sido registrado exitosamente. Hemos notificado a la administradora.');
        return redirect()->route('index');

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

    public function comprarPedido($id){

        $productos = PedidoProducto::where('pedido_id',$id)->get();
        $pedido = Pedido::find($id);
        $usuario = Usuario::findOrFail($pedido->usuario_id);
        return view('admin.pedidos.comprarPedido',['productos'=>$productos,'pedido'=>$pedido,'usuario'=>$usuario,'notificacionProductos' => NotificacionProducto::all(),
        'notificacionUsuarios' => NotificacionUsuario::all()]);
    }

    public function export()
    {
        return Excel::download(new PedidoExport, 'pedido-' . now()->format('d-m-Y') . '.xlsx');
    }
    public function exportUsuario($id)
    {
        return Excel::download(new PedidoUsuarioExport($id), 'pedido-usuario' . now()->format('d-m-Y') . '.xlsx');
    }


}
