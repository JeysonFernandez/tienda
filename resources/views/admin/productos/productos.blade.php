@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Productos</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.producto.crearProducto')}}" class="btn btn-primary btn-lg text-right">Agregar</a></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.producto.exportProducto')}}" class="btn btn-naranjo btn-lg text-right">Exportar Excel</a></div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Color</th>
                            <th>Genero</th>
                            <th>Marca</th>
                            <th>Talla</th>
                            <th>Stock Actual</th>
                            <th>Stock Critico</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Color</th>
                            <th>Genero</th>
                            <th>Marca</th>
                            <th>Talla</th>
                            <th>Stock Actual</th>
                            <th>Stock Critico</th>
                            <th>Precio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($productos as $producto)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$producto->tipo->nombre}}</td>
                                <td>{{$producto->categoria->nombre}}</td>
                                <td>{{$producto->color->nombre}}</td>
                                <td>{{$producto->genero->nombre}}</td>
                                <td>{{$producto->marca->nombre}}</td>
                                <td>{{$producto->talla->nombre}}</td>
                                <td>{{$producto->stock_actual}}</td>
                                <td>{{$producto->stock_critico}}</td>
                                <td>{{$producto->precio_unidad}}</td>
                                <td>
                                @if($producto->borrado == \App\Models\Producto::BORRADOR)Borrado @endif
                                @if($producto->borrado == \App\Models\Producto::PUBLICADO)Publico @endif
                                </td>
                                <td> <a type="submit" class="btn btn-xs btn-success" data-toggle="tooltip" href="{{route('admin.producto.editarProducto',['id' => $producto->id])}}" title="Editar">
                                    <i class="fas fa-edit"></i>
                               </a>
                               <a type="submit" class="btn btn-xs btn-danger"data-toggle="modal" data-target="#deleteModal" href="#" onclick="nombre(this)" id="{{$producto->nombre}}-{{$producto->id}}"> <i class="fas fa-trash-alt"></i>
                               </a></td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seguro que quieres eliminar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Producto a eliminar es <span id="nombreProducto"></span></div>
                <div class="modal-footer" >
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-secondary .align-items-start" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.producto.confirmDelete')}}" method="POST" name="f1" id="f1" >
                        @csrf
                        @method('delete')
                        <input type="text" name="idfinal" id="idfinal" style="visibility: hidden">
                        <button type="submit" class="btn btn-primary .align-items-end">eliminar</button>
                    </form>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        function nombre(nom){
            nomb = nom.id.split("-");
            var texto = document.getElementById("nombreProducto");
            texto.innerHTML = nomb[0];
            document.f1.idfinal.value = nomb[1];
        }
    </script>
@endsection
