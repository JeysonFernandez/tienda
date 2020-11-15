<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use Illuminate\Http\Request;

class FechaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.fechas.fechas',[
            'fechas' => Fecha::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fechas.create',['notificacionProductos'=>NotificacionProducto::all(),
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
        $fecha = new Fecha();
        $fecha->fecha = $request->get('fecha');
        $fecha->hora = $request->get('hora');

        $duracion = $request->get('duracion');
        $fecha->duracion = $duracion*60;
        $fecha->save();

        return redirect()->route('admin.getfechas',[
            'notificacionProductos'=>NotificacionProducto::all(),
            'notificacionUsuarios'=>NotificacionUsuario::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function show(Fecha $fecha)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function edit(Fecha $fecha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fecha $fecha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fecha  $fecha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fecha $fecha)
    {
        //
    }
}
