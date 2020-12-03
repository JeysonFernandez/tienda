<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarCategoriaRequest;
use App\Models\Categoria;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreCategoria;
use Illuminate\Http\Request;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use RealRashid\SweetAlert\Facades\Alert;

class CategoriaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {

    return redirect()->route('admin.categoria.verCategorias');
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function crearCategoria()
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
    public function guardarCategoria(GuardarCategoriaRequest $request)
    {
        $validaData = $request->validate([
            'nombre' => 'required|min:3'
        ]);
        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->borrado = 1;
        $categoria->save();

        alert()->success('Perfecto!','Se ha registrado una nueva categoria.');
        return redirect()->route('admin.categoria.verCategorias');
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
    public function editarCategoria($id)
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
    public function updateCategoria(GuardarCategoriaRequest $request, $id)
    {

        $categoria = Categoria::find($id);
        $categoria->id = $id;
        $categoria->nombre = $request->nombre;
        $categoria->save();

        alert()->success('Perfecto!','La categoria se ha editado correctamente.');
        return redirect()->route('admin.categoria.verCategorias');
    }

    public function confirmarUpdate(Request $request)
    {

        $categoria = Categoria::find($request->get('id'));
        $categoria->nombre = $request->get('nombre');
        $categoria->save();

        alert()->success('Perfecto!','La categoria se ha editado correctamente.');
        return redirect()->route('admin.categoria.verCategorias');
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
        $categoria->borrado = 2;
        $categoria->save();

        return redirect()->route('admin.categoria.verCategoria');
    }

    public function confirmDelete(Request $request){
        $categoria = Categoria::find($request->idfinal);
        $categoria->borrado = 2;
        $categoria->save();

        return redirect()->route('admin.categoria.verCategorias');
    }

}
