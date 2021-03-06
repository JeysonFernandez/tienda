<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarTipoRequest;
use App\Models\Tipo;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreTipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {
        return redirect()->route('admin.tipo.verTipo');
    }

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
    public function create()
    {
        return view('admin.tipos.create',['notificacionProductos'=>NotificacionProducto::all(),
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
        $tipo = new Tipo();
        $tipo->nombre = $request->get('nombre');
        $tipo->borrado = 1;
        $tipo->save();

        alert()->success('Perfecto!','El tipo se ha agregado correctamente.');
        return redirect()->route('admin.tipo.verTipo');
    }

/**
* Display the specified resource.
*
* @param \App\tipo $tipo
* @return \Illuminate\Http\Response
*/
    public function show(Tipo $tipo)
    {
        $tipo = Tipo::findOrFail($tipo->id);

        return view('tipos.show',[
        'tipo' => $tipo
        ]);
    }

/**
* Show the form for editing the specified resource.
*
* @param \App\tipo $tipo
* @return \Illuminate\Http\Response
*/
    public function editarTipo($id)
    {
        $tipo = Tipo::find($id);

        return view('admin.tipos.edit',[
        'tipo' => $tipo,
        'notificacionProductos'=>NotificacionProducto::all(),
        'notificacionUsuarios'=>NotificacionUsuario::all()
        ]);
    }

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\tipo $tipo
* @return \Illuminate\Http\Response
*/
    public function updateTipo(GuardarTipoRequest $request, $id)
    {

        $tipo = Tipo::find($id);
        $tipo->id = $id;
        $tipo->nombre = $request->nombre;
        $tipo->save();

        alert()->success('Perfecto!','El tipo se ha actualizado correctamente.');
        return redirect()->route('admin.tipo.verTipo');
    }

    public function confirmarUpdate(Request $request)
    {
        $tipo = Tipo::find($request->get('id'));
        $tipo->nombre = $request->get('nombre');
        $tipo->save();

        alert()->success('Perfecto!','El tipo se ha actualizado correctamente.');
        return redirect()->route('admin.tipo.verTipo');
    }

/**
* Remove the specified resource from storage.
*
* @param \App\tipo $tipo
* @return \Illuminate\Http\Response
*/
    public function destroy($id)
    {
        $tipo = Tipo::findOrFail($id);
        $tipo->borrado = 2;
        $tipo->save();

        alert()->success('Perfecto!','El tipo se ha borrado correctamente.');
        return redirect()->route('admin.tipo.verTipo');
    }

    public function confirmDelete(Request $request){
        $tipo = Tipo::findOrFail($request->idfinal);
        $tipo->borrado = 2;
        $tipo->save();

        alert()->success('Perfecto!','El tipo se ha borrado correctamente.');
        return redirect()->route('admin.tipo.verTipo');
    }

}
