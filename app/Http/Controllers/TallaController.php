<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreTalla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {

        return redirect()->route('admin.talla.getTalla');
    }

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
    public function create()
    {
        return view('admin.tallas.create',['notificacionProductos'=>NotificacionProducto::all(),
        'notificacionUsuarios'=>NotificacionUsuario::all()]);
    }

/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
    public function store(Request $request)
    {
        /*$validaData = $request->validate([
        'title' => 'required|min:3'
        ]);*/
        $talla = new Talla();
        $talla->nombre = $request->get('nombre');
        $talla->borrado = 1;
        $talla->save();

        return redirect()->route('admin.talla.getTalla');
    }

/**
* Display the specified resource.
*
* @param \App\talla $talla
* @return \Illuminate\Http\Response
*/
    public function show(Talla $talla)
    {
        $talla = Talla::findOrFail($talla->id);
        return view('tallas.show',[
        'talla' => $talla
        ]);
    }

/**
* Show the form for editing the specified resource.
*
* @param \App\talla $talla
* @return \Illuminate\Http\Response
*/
    public function edit($id)
    {
        $talla = Talla::find($id);

        return view('admin.tallas.edit',[
        'talla' => $talla,
        'notificacionProductos'=>NotificacionProducto::all(),
        'notificacionUsuarios'=>NotificacionUsuario::all()
        ]);
    }

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\talla $talla
* @return \Illuminate\Http\Response
*/
    public function update(StoreTalla $request, $id)
    {
        $talla = Talla::find($id);
        $talla->id = $id;
        $talla->nombre = $request->nombre;
        $talla->save();

        return redirect()->route('admin.talla.geTalla');
    }

    public function confirmarUpdate(StoreTalla $request)
    {

        $talla = Talla::find($request->get('id'));
        $talla->nombre = $request->get('nombre');
        $talla->save();

        return redirect()->route('admin.talla.getTalla');
    }

/**
* Remove the specified resource from storage.
*
* @param \App\talla $talla
* @return \Illuminate\Http\Response
*/
    public function destroy($id)
    {
        $talla = Talla::findOrFail($id);
        $talla->borrado = 2;
        $talla->save();
        
        return redirect()->route('admin.talla.getTalla');
    }

    public function confirmDelete(Request $request){
        $talla = Talla::findOrFail($request->idfinal);
        $talla->borrado = 2;
        $talla->save();
        
        return redirect()->route('admin.talla.getTalla');
    }

}
