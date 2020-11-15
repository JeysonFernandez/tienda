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
        return view('home.registrarse');
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

    public function login(Request $request){
        $credenciales = $request->only('email','password');

        if(Auth::attempt($credenciales)){
            //Comprar si es admin
            if(Auth::user()->tipo == 'a'){
                $carro= session()->get('carro');
                if($carro!=null){
                    foreach(session('carro') as $id => $detalles){
                        unset($carro[$id]);
                    }
                    session()->put('carro',$carro);
                }

                //Comprobar si se llegado a la fecha de algun pedido
                $pedidos=Pedido::all();
                foreach($pedidos as $pedido){
                    if($pedido->fecha <= now()->format('Y-m-d')){
                        $pedido->estado = 'c';

                        $productosPedido = PedidoProducto::where('pedido_id',$pedido->id);
                        foreach($productosPedido as $productoPedido){
                            $producto = Producto::find($productoPedido->producto_id);
                            $producto->stock_actual += $productoPedido->cantidad;
                            $producto->save();
                        }

                        $pedido->save();
                    }
                }

            }
        }

        return redirect()->route('index');
    }

    public function registrar(Request $request)
    {
        $usuario = Usuario::create($request->all());
        $usuario->estado_calidad = 'a';
        $usuario->tipo = 'u';
        $usuario->conocido = 's';
        $usuario->password = Hash::make($request->get('password'));
        $usuario->save();

        return redirect('/');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}
