<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarTallaRequest;
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

        return redirect()->route('admin.talla.verTalla');
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


    alert()->success('Perfecto!','La talla se ha agregado correctamente.');
        return redirect()->route('admin.talla.verTalla');
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
    public function editarTalla($id)
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
    public function updateTalla(GuardarTallaRequest $request, $id)
    {
        $talla = Talla::find($id);
        $talla->id = $id;
        $talla->nombre = $request->nombre;
        $talla->save();

        alert()->success('Perfecto!','La talla se ha actualizado correctamente.');
        return redirect()->route('admin.talla.verTalla');
    }

    public function confirmarUpdate(Request $request)
    {

        $talla = Talla::find($request->get('id'));
        $talla->nombre = $request->get('nombre');
        $talla->save();

        alert()->success('Perfecto!','La talla se ha actualizado correctamente.');
        return redirect()->route('admin.talla.verTalla');
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

        alert()->success('Perfecto!','La talla se ha borrado correctamente.');
        return redirect()->route('admin.talla.verTalla');
    }

    public function confirmDelete(Request $request){
        $talla = Talla::findOrFail($request->idfinal);
        $talla->borrado = 2;
        $talla->save();

        alert()->success('Perfecto!','La talla se ha borrado correctamente.');
        return redirect()->route('admin.talla.verTalla');
    }

}
