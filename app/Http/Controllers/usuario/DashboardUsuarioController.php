<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Pago;
use App\Models\Compra;
use App\Models\Pedido;
use App\Models\NotificacionUsuario;
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
        view('usuario.index',
        ['notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id',
        'desc')->get()]);
    }

    public function getCompras($id){
        $compras = Compra::where('usuario_id',"$id")->get();

        return view('usuario.compras.compras',[
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

        return view('usuario.pagos.pagos',[
        'pagos' => $pagos,
        'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getPedidos($id){
        $pedidos = Pedido::where('usuario_id','=',"$id")->get();

        return view('usuario.pedidos.pedidos',[
        'pedidos' => $pedidos,
        'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }

    public function getComprasProductos($id){
        $produc = Compra::find($id);

        return view('usuario.compras.detalleCompra', [
            'produc' => $produc,
            'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getPedidosProductos($id){
        $produc = Pedido::find($id);

        return view('usuario.pedidos.detallePedido', [
            'produc' => $produc,
            'notificaciones'=>NotificacionUsuario::where('usuario_id',$id)->orderBy('id', 'desc')->get()
        ]);
    }
    public function getNotificaciones($id){
        return view('usuario.notificaciones.notificacionesUsuarios', [
            'notificaciones'=>NotificacionUsuario::where('usuario_id',"$id")->orderBy('id', 'desc')->get()
        ]);
    }


}
