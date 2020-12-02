<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarProveedorRequest;
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

        return redirect()->route('admin.proveedor.verProveedor');
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
    public function store(Request $request)
    {
        /*$validaData = $request->validate([
        'title' => 'required|min:3'
        ]);*/
        $proveedor = new Proveedor();
        $proveedor->nombre = $request->get('nombre');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->descripcion = $request->get('descripcion');
        $proveedor->borrado = 1;
        $proveedor->save();

        return redirect()->route('admin.proveedor.verProveedor');
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
    public function editarProveedor($id)
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
    public function updateProveedor(Request $request, $id)
    {
        $proveedor = Proveedor::find($id);
        $proveedor->nombre = $request->get('nombre');
        $proveedor->descripcion = $request->get('descripcion');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->save();

        return redirect()->route('admin.proveedor.verProveedor');
    }

    public function confirmarUpdate(Request $request)
    {
        $proveedor = Proveedor::find($request->get('id'));
        $proveedor->nombre = $request->get('nombre');
        $proveedor->save();

        return redirect()->route('admin.proveedor.verProveedor');
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
        $proveedor->borrado = 2;
        return redirect()->route('admin.proveedor.verProveedor');
    }

    public function confirmDelete(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->idfinal);
        $proveedor->borrado = 2;

        return redirect()->route('admin.proveedor.verProveedor');
    }
}
