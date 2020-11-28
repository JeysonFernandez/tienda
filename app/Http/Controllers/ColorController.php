<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreColor;
use Illuminate\Http\Request;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;

class ColorController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{

return redirect()->route('admin.getcolor');
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('admin.colores.create',['notificacionProductos'=>NotificacionProducto::all(),
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
    $color = new Color();
    $color->nombre = $request->get('nombre');
    $color->borrado = 1;
    $color->save();

    return redirect()->route('admin.color.getColor');
}

/**
* Display the specified resource.
*
* @param \App\color $color
* @return \Illuminate\Http\Response
*/
public function show(Color $color)
{
    $color = Color::findOrFail($color->id);
    return view('colors.show',[
    'color' => $color
    ]);
}

/**
* Show the form for editing the specified resource.
*
* @param \App\color $color
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
    $color = Color::find($id);

    return view('admin.colores.edit',[
    'color' => $color,
    'notificacionProductos'=>NotificacionProducto::all(),
    'notificacionUsuarios'=>NotificacionUsuario::all()
    ]);
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\color $color
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{

    $color = Color::find($id);
    dd($request->get('nombre'));
    $color->id = $id;
    $color->nombre = $request->nombre;

    $color->save();
    return redirect()->route('admin.color.getColor');
}
public function confirmarUpdate(Request $request)
{

$color = Color::find($request->get('id'));

$color->nombre = $request->get('nombre');

$color->save();
return redirect()->route('admin.color.getColor');
}

/**
* Remove the specified resource from storage.
*
* @param \App\color $color
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    $color = Color::findOrFail($id);
    $color->borrado = 2;
    return redirect()->route('admin.color.getColor');
}

public function confirmDelete(Request $request)
{
    $color = Color::findOrFail($request->idfinal);
    $color->borrado = 2;
    $color->save();
    return redirect()->route('admin.color.getColor');
}

}
