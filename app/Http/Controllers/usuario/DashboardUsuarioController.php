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


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

    public function cambiarPassword(Request $request)
    {
        if(Auth::check()){
            $usuario = Usuario::find(auth()->user()->id);
        }else{
            return redirect()->route('publico.index');
        }


        if($request->isMethod('post')){

            $messages = [
                'nueva.max' => 'El campo Contraseña debe tener máximo 100 carácteres',
                'nueva.confirmed' => 'Los campos contraseña no coinciden',
                '*.max' => 'El campo :attribute debe tener máximo 70 carácteres',
                'nueva.regex' => 'Tu contraseña debe tener un mínimo de 6 caracteres y al menos 1 letra',
                '*min' => 'El campo :attribute debe tener mínimo 6 caracteres',
                '*.required' => 'Por favor completa el campo :attribute',
            ];
            $rules = [
                'nueva' => 'required|min:6|confirmed|max:100|regex:/[a-zA-z]/',
                'nueva_confirmation' => 'required|min:6|max:100',
            ];


            $validator = Validator::make($request->all(),$rules, $messages,[
                'nueva' => 'Nueva Contraseña',
                'nueva_confirmation' => 'Repite Nueva Contraseña'
            ]);

            $input = $request->all();

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if (Hash::check($request->password,$usuario->password)) {

                $usuario->password = Hash::make($request->nueva);
                $usuario->save();
                alert()->success('Datos actualizados','Sus datos se han actualizado de forma correcta.');
                return view('usuario.perfil.perfil',compact('usuario'));
            }else{
                alert()->warning('Datos incorrectos, intente nuevamente','Si no se acuerda de la contraseña, solicite una nueva.');
                return redirect()->back();
            }
        }

        return view('usuario.auth.passwords.cambiar-contrasena');


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
