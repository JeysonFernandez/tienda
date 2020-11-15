<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Pago;
use App\Compra;
use App\Pedido;
use App\NotificacionUsuario;
use Illuminate\Support\Facades\DB;

class DashboardUsuarioController extends Controller
{
    public function __Construct()
    {
        $this->middleware('auth');
    }

    public function getDashboard($id)
    {
        return
        view('usuarioMenu.index',['notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id',
        'desc')->get()]);
    }

    public function getCompras($id){
        $compras = Compra::where('usuario_id',"$id")->get();
        
        return view('usuarioMenu.compras.compras',[
        'compras' => $compras,
        'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getPagos($id){
        $pagos = DB::table('pagos')
            ->select('pagos.monto','pagos.fecha','pagos.estado')
            ->leftJoin('compras','pagos.compra_id','=','compras.id')
            ->where('compras.usuario_id','=',"$id")
            ->groupBy('pagos.monto','pagos.fecha','pagos.estado')
            ->get();
        
        return view('usuarioMenu.pagos.pagos',[
        'pagos' => $pagos,
        'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getPedidos($id){
        $pedidos = Pedido::where('usuario_id','=',"$id")->get();
        
        return view('usuarioMenu.pedidos.pedidos',[
        'pedidos' => $pedidos,
        'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }

    public function getComprasProductos($id){
        $produc = Compra::find($id);
        
        return view('usuarioMenu.compras.detalleCompra', [
            'produc' => $produc,
            'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getPedidosProductos($id){
        $produc = Pedido::find($id);
        
        return view('usuarioMenu.pedidos.detallePedido', [
            'produc' => $produc,
            'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getNotificaciones($id){   
        return view('usuarioMenu.notificaciones.notificacionesUsuarios', [
            'notificaciones'=>NotificacionUsuario::where('usuario_id',"$id")->orderBy('id', 'desc')->get()
        ]);
    }

    
}
