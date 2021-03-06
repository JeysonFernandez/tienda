<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarGeneroRequest;
use App\Models\Genero;
use App\Models\NotificacionProducto;
use App\Models\NotificacionUsuario;
use App\Http\Requests\StoreCaracteristicasProducto;
use App\Http\Requests\StoreGenero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
    public function index()
    {

    return redirect()->route('admin.genero.verGenero');
    }

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
    public function create()
    {
        return view('admin.generos.create',['notificacionProductos'=>NotificacionProducto::all(),
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
        $genero = new Genero();
        $genero->nombre = $request->get('nombre');
        $genero->borrado = 1;
        $genero->save();


        alert()->success('Perfecto!','La clasificación se ha agregado correctamente.');
        return redirect()->route('admin.genero.verGenero');
    }

/**
* Display the specified resource.
*
* @param \App\genero $genero
* @return \Illuminate\Http\Response
*/
public function show(Genero $genero)
{
    $genero = Genero::findOrFail($genero->id);

    return view('generos.show',[
                'genero' => $genero
           ]);
}

/**
* Show the form for editing the specified resource.
*
* @param \App\genero $genero
* @return \Illuminate\Http\Response
*/
    public function editarGenero($id)
    {
        $genero = Genero::find($id);

        return view('admin.generos.edit',[
                'genero' => $genero,
                'notificacionProductos'=>NotificacionProducto::all(),
                'notificacionUsuarios'=>NotificacionUsuario::all()
                ]);
    }

/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param \App\genero $genero
* @return \Illuminate\Http\Response
*/
    public function updateGenero(GuardarGeneroRequest $request, $id)
    {

        $genero = Genero::find($id);
        $genero->id = $id;
        $genero->nombre = $request->nombre;
        $genero->save();

        alert()->success('Perfecto!','La clasificación se ha actualizado correctamente.');
        return redirect()->route('admin.genero.verGenero');
    }

    public function confirmarUpdate(Request $request)
    {
        $genero = Genero::find($request->get('id'));
        $genero->nombre = $request->get('nombre');
        $genero->save();

        alert()->success('Perfecto!','La clasificación se ha actualizado correctamente.');
        return redirect()->route('admin.genero.verGenero');
    }

/**
* Remove the specified resource from storage.
*
* @param \App\genero $genero
* @return \Illuminate\Http\Response
*/
    public function destroy($id)
    {
        $genero = Genero::findOrFail($id);
        $genero->borrado = 2;
        $genero->save();


        alert()->success('Perfecto!','La clasificación se ha borrado correctamente.');
        return redirect()->route('admin.genero.verGenero');
    }

    public function confirmDelete(Request $request)
    {
        $genero = Genero::findOrFail($request->idfinal);
        $genero->borrado = 2;
        $genero->save();

        alert()->success('Perfecto!','La clasificación se ha borrado correctamente.');
        return redirect()->route('admin.genero.verGenero');
    }

}
