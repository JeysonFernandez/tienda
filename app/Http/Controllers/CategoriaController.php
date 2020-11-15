<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreCategoria;
use Illuminate\Http\Request;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;

class CategoriaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{

return redirect()->route('admin.getcategoria');
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('admin.categorias.create',['notificacionProductos'=>NotificacionProducto::all(),
    'notificacionUsuarios'=>NotificacionUsuario::all()]);
}

/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function store(StoreCategoria $request)
{
    /*$validaData = $request->validate([
    'title' => 'required|min:3'
    ]);*/
    $categoria = new Categoria();
    $categoria->nombre = $request->get('nombre');
    $categoria->borrado = "no";
    $categoria->save();

    return redirect()->route('admin.getcategoria');
}

/**
* Display the specified resource.
*
* @param \App\categoria $categoria
* @return \Illuminate\Http\Response
*/
public function show(Categoria $categoria)
{
    $categoria = Categoria::findOrFail($categoria->id);
    return view('categorias.show',[
    'categoria' => $categoria
    ]);
}

/**
* Show the form for editing the specified resource.
*
* @param \App\categoria $categoria
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$categoria = Categoria::find($id);

return view('admin.categorias.edit',[
'categoria' => $categoria,
'notificacionProductos'=>NotificacionProducto::all(),
'notificacionUsuarios'=>NotificacionUsuario::all()
]);
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\categoria $categoria
* @return \Illuminate\Http\Response
*/
public function update(StoreCategoria $request, $id)
{

    $categoria = Categoria::find($id);
    $categoria->id = $id;
    $categoria->nombre = $request->nombre;

    $categoria->save();
    return redirect()->route('admin.getcategoria');
}
public function confirmarUpdate(StoreCategoria $request)
{

$categoria = Categoria::find($request->get('id'));

$categoria->nombre = $request->get('nombre');

$categoria->save();
return redirect()->route('admin.getcategoria');
}

/**
* Remove the specified resource from storage.
*
* @param \App\categoria $categoria
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
$categoria = Categoria::findOrFail($id);
$categoria->borrado = "si";
$categoria->save();
return redirect()->route('admin.getcategoria');
}

public function confirmDelete(Request $request){
$categoria = Categoria::find($request->idfinal);
$categoria->borrado = "si";
$categoria->save();
return redirect()->route('admin.getcategoria');
}

}
