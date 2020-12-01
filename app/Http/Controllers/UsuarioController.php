<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\PedidoProducto;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUsuarioRequest;

use RealRashid\SweetAlert\Facades\Alert;

class UsuarioController extends Controller
{
    /*public function __construct(){
        $this->middleware('auth')->except(['login']);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }

    public function seleccionarPerfil()
    {
        return view('home.seleccionarPerfil');
    }

    public function login(Request $request){
        $validacion = $request->validate([
            'email' => 'required',
            'password' => 'required',
            ],

            [
                'email.required' => 'Requerido',
                'password.required' => 'Requerido',
            ]
        );
        $credenciales = $request->only('email','password');

         if(!Auth::attempt($credenciales)){
        //     //Comprar si es admin
        //     if(Auth::user()->tipo == 1){
        //         $carro= session()->get('carro');
        //         if($carro!=null){
        //             foreach(session('carro') as $id => $detalles){
        //                 unset($carro[$id]);
        //             }
        //             session()->put('carro',$carro);
        //         }

        //         //Comprobar si se llegado a la fecha de algun pedido
        //         $pedidos=Pedido::all();
        //         foreach($pedidos as $pedido){
        //             if($pedido->fecha <= now()->format('Y-m-d')){
        //                 $pedido->estado = 'c';

        //                 $productosPedido = PedidoProducto::where('pedido_id',$pedido->id);
        //                 foreach($productosPedido as $productoPedido){
        //                     $producto = Producto::find($productoPedido->producto_id);
        //                     $producto->stock_actual += $productoPedido->cantidad;
        //                     $producto->save();
        //                 }

        //                 $pedido->save();
        //             }
        //         }

        //     }
        // }
        // else{
            alert()->error('Ups!','Los datos ingresados no son correctos. Por favor, intenta nuevamente');
            return redirect()->back();
        }
        alert()->success('Conectado!','Has iniciado sesión de forma correcta');
        if( Auth::user()->tipo==1 ){
            return view('home.seleccionarPerfil');
        }

        return redirect()->route('index');
    }

    public function registrar(Request $request)
    {
        $validacion = $request->validate([
            'nombre' => 'required|min:3',
            'primer_apellido' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'email_confirmation' => 'required',
            'password_confirmation' => 'required'
            ],

            [   'nombre.required' => 'Requerido',
                'nombre.min' => 'El largo del nombre debe ser mayor a 3',
                'primer_apellido.required'=>'Requerido',
                'email.required' => 'Requerido',
                'password.required' => 'Requerido',
                'password.min' => 'Largo de contraseña menor al esperado',
                'email_confirmation.required' => 'Requerido',
                'password_confirmation.required' => 'Requerido'
            ]
        );

        $usuario = Usuario::create($request->all());
        $usuario->estado_calidad = 1;
        $usuario->tipo = 2;
        $usuario->conocido = 1;
        $usuario->password = Hash::make($request->get('password'));
        $usuario->deuda_total = 0;
        $usuario->save();

        alert()->success('Perfecto!','Has sido registrado exitosamente.');
        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('index');
    }
}
