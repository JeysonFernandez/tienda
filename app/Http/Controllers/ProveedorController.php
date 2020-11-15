<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreProveedores;
use App\Models\Proveedor;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    return redirect()->route('admin.getProveedor');
    }

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
    return view('admin.proveedores.create',['notificacionProductos'=>NotificacionProducto::all(),
    'notificacionUsuarios'=>NotificacionUsuario::all()]);
}

/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function store(StoreProveedores $request)
{
    /*$validaData = $request->validate([
    'title' => 'required|min:3'
    ]);*/
    $proveedor = new Proveedor();
    $proveedor->nombre = $request->get('nombre');
    $proveedor->direccion = $request->get('direccion');
    $proveedor->descripcion = $request->get('descripcion');
    $proveedor->borrado = "no";
    $proveedor->save();

    return redirect()->route('admin.getproveedor');
}

/**
* Display the specified resource.
*
* @param \App\proveedor $proveedor
* @return \Illuminate\Http\Response
*/
public function show(Proveedor $proveedor)
{
    $proveedor = Proveedor::findOrFail($proveedor->id);
    return view('proveedores.show',[
    'proveedor' => $proveedor
    ]);
}

/**
* Show the form for editing the specified resource.
*
* @param \App\proveedor $proveedor
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$proveedor = Proveedor::find($id);

return view('admin.proveedores.edit',[
    'proveedor' => $proveedor,
    'notificacionProductos'=>NotificacionProducto::all(),
    'notificacionUsuarios'=>NotificacionUsuario::all()
]);
}

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\proveedor $proveedor
* @return \Illuminate\Http\Response
*/
public function update(StoreProveedores $request, $id)
{

    $proveedor = Proveedor::find($id);
    $proveedor->id = $id;
    $proveedor->nombre = $request->nombre;

    $proveedor->save();
    return redirect()->route('admin.getProveedor');
}
public function confirmarUpdate(StoreProveedores $request)
{

    $proveedor = proveedor::find($request->get('id'));

    $proveedor->nombre = $request->get('nombre');

    $proveedor->save();
    return redirect()->route('admin.getProveedor');
}

/**
* Remove the specified resource from storage.
*
* @param \App\proveedor $proveedor
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
    $proveedor = Proveedor::findOrFail($id);
    $proveedor->borrado = "si";
    return redirect()->route('admin.getProveedor');
}

public function confirmDelete(Request $request){
    $proveedor = Proveedor::findOrFail($request->idfinal);
    $proveedor->borrado = "si";
    return redirect()->route('admin.getProveedor');
}
}
