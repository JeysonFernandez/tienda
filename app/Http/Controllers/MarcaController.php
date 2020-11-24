<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreMarca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{

return redirect()->route('admin.getmarca');
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('admin.marcas.create',['notificacionProductos'=>NotificacionProducto::all(),
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
    $marca = new Marca();
    $marca->nombre = $request->get('nombre');
    $marca->borrado = 1;
    $marca->save();

    return redirect()->route('admin.getmarca');
}

/**
* Display the specified resource.
*
* @param \App\marca $marca
* @return \Illuminate\Http\Response
*/
public function show(Marca $marca)
{
    $marca = Marca::findOrFail($marca->id);
    return view('marcas.show',[
    'marca' => $marca
    ]);
}

/**
* Show the form for editing the specified resource.
*
* @param \App\marca $marca
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$marca = Marca::find($id);

return view('admin.marcas.edit',[
'marca' => $marca,
'notificacionProductos'=>NotificacionProducto::all(),
'notificacionUsuarios'=>NotificacionUsuario::all()
]);
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\marca $marca
* @return \Illuminate\Http\Response
*/
public function update(StoreMarca $request, $id)
{

    $marca = Marca::find($id);
    dd($request->get('nombre'));
    $marca->id = $id;
    $marca->nombre = $request->nombre;

    $marca->save();
    return redirect()->route('admin.getmarca');
}
public function confirmarUpdate(StoreMarca $request)
{

$marca = Marca::find($request->get('id'));

$marca->nombre = $request->get('nombre');

$marca->save();
return redirect()->route('admin.getmarca');
}

/**
* Remove the specified resource from storage.
*
* @param \App\marca $marca
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
$marca = Marca::findOrFail($id);
$marca->borrado = 2;
$marca->save();
return redirect()->route('admin.getmarca');
}

public function confirmDelete(Request $request){
$marca = Marca::findOrFail($request->idfinal);
$marca->borrado = 2;
$marca->save();
return redirect()->route('admin.getmarca');
}

}
