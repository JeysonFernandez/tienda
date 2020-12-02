<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Compra;
use App\Models\NotificacionUsuario;
use App\Models\NotificacionProducto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReporteUsuario;
use App\Mail\ReporteAdmin;

use App\Exports\PagoCompraExport;
use App\Exports\PagoExport;
use App\Exports\PagoUsuarioExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PagoController extends Controller
{
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
        $compras = Compra::all();
        return view('admin.pagos.crear_pago',
        ['compras' => $compras,'notificacionProductos'=>NotificacionProducto::all(),
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
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function show(Pago $pago)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function edit(Pago $pago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pago $pago)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pago  $pago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pago $pago)
    {
        //
    }

    public function agregar(Request $request){
        $pago = new Pago();
        $pago->compra_id = $request->get('compra');
        $pago->fecha = $request->get('fecha');
        $pago->monto = $request->get('monto');
        //Descontar el monto
        $compra = Compra::findOrFail($pago->compra_id);
        $nuevoMonto = $compra->deuda_pendiente - $pago->monto;

        //ESTADO DEL PAGO   RETRASADO-ADELANTADO- A TIEMPO
        if($pago->fecha > $compra->fecha_siguiente_pago){
            $pago->estado = 'r';
        }elseif($pago->fecha < $compra->fecha_siguiente_pago){
            $pago->estado = 'a';
        }else{
            $pago->estado = 't';
        }

        //ESTADO DE LA COMPRA  CANCELADA - PENDIENTE
        if($nuevoMonto == 0){
            $compra->estado = 'c';
        }else{
            $compra->fecha_siguiente_pago = $request->get('fecha_siguiente_pago');

        }
        $compra->deuda_pendiente = $nuevoMonto;

        $usuario = Usuario::findOrFail($compra->usuario_id);
        $nombreCompleto = $usuario->nombre.' '.$usuario->apellido.'(Fono: '.$usuario->fono.')';
        $correo = (['nombreUsuario'=>$nombreCompleto,'fecha'=>$pago->fecha,'monto'=>$pago->monto,'fecha_siguiente_pago'=>$compra->fecha_siguiente_pago,'deuda_pendiente'=>$nuevoMonto,'tipo'=>'pago']);

        Mail::to($usuario->username)->send(new ReporteUsuario($correo));
        Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
        $notificacionUsuario = new NotificacionUsuario();
        $notificacionUsuario->fecha_creacion = now()->format('Y-m-d');
        $notificacionUsuario->tipo = 'c';
        $notificacionUsuario->mensaje=$usuario->nombre.' '.$usuario->apellido.' está a poco de terminar su deuda
        total.';
        $notificacionUsuario->usuario_id = $usuario->id;
        $notificacionUsuario->click = 'n';
        $notificacionUsuario->save();

        //Descontar al usuario
        $usuario->deuda_total -= $pago->monto;
        if($usuario->deuda_Total<10000){
            $correo = (['nombreUsuario'=>$nombreCompleto,'deuda'=>$nuevoMonto, 'tipo'=>'usuario_critico']);
            Mail::to('chirismo123@gmail.com')->send(new ReporteAdmin($correo));
        }
        $usuario->save();
        //insertar nueva notificacion
        $notificacionUsuario = new NotificacionUsuario();
        $notificacionUsuario->fecha_creacion = now()->format('Y-m-d');
        $notificacionUsuario->tipo = 'P';
        $notificacionUsuario->mensaje='Se ha registrado el Pago de '.$usuario->nombre.' '.$usuario->apellido;
        $notificacionUsuario->usuario_id = $usuario->id;
        $notificacionUsuario->click = 'n';
        $notificacionUsuario->save();

        $pago->save();
        $compra->save();
        return redirect()->route('admin.getpagos');
    }

    public function exportPago()
    {
        return Excel::download(new PagoExport, 'pago-' . now()->format('d-m-Y') . '.xlsx');
    }
    public function exportUsuarioPago($id)
    {
        return Excel::download(new PagoUsuarioExport($id), 'pago-usuario-' . now()->format('d-m-Y') . '.xlsx');
    }
    public function exportCompraPago($id)
    {
        return Excel::download(new PagoCompraExport($id), 'pago-compra-' . now()->format('d-m-Y') . '.xlsx');
    }


}
