<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Pago;
use App\Models\Compra;
use App\Models\Pedido;
use App\Models\NotificacionUsuario;
use App\Models\Usuario;
use App\Models\CompraProducto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


use App\Exports\PedidoUsuarioExport;
use App\Exports\CompraUsuarioExport;
use App\Exports\CompraProductoExport;
use Maatwebsite\Excel\Facades\Excel;

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
        $compras = Compra::where('usuario_id',$id)->get();

        return view('usuario.pagos.pagos',[
        'compras' => $compras,
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
        $compra = Compra::find($id);

        return view('usuario.compras.detalleCompra', [
            'compra' => $compra,
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


    public function misDatos($id)
    {
        $usuario = Usuario::find($id);

        return view('usuario.perfil.perfil', [
            'usuario' => $usuario,
            'notificaciones'=>NotificacionUsuario::where('usuario_id',"$id")->orderBy('id', 'desc')->get()
        ]);
    }

    public function misDatosGuardar(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        $usuario->password = Hash::make($request->password);
        $usuario->save();
        return redirect()->route('usuario.index',['id' => auth()->user()->id]);
    }

    public function exportUsuarioPedido($id)
    {
        return Excel::download(new PedidoUsuarioExport($id), 'pedido-usuario-' . now()->format('d-m-Y') . '.xlsx');
    }
    public function exportUsuarioCompra($id)
    {
        return Excel::download(new CompraUsuarioExport($id), 'compra-usuario-' . now()->format('d-m-Y') . '.xlsx');
    }
    public function exportCompraProducto($id)
    {
        return Excel::download(new CompraProductoExport($id), 'compra-producto-' . now()->format('d-m-Y') . '.xlsx');
    }

}
