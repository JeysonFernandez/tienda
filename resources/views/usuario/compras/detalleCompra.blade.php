@extends('layouts.masterUsuario')

@section('contenido')

<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Productos de la compra</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('usuario.exportCompraProducto',['id' => $compra->id])}}" class="btn btn-naranjo btn-lg text-right">Exportar Excel</a></div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Color</th>
                            <th>Genero</th>
                            <th>Marca</th>
                            <th>Talla</th>
                            <th>Valor Total</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Imagen</th>
                            <th>Tipo</th>
                            <th>Categoria</th>
                            <th>Color</th>
                            <th>Genero</th>
                            <th>Marca</th>
                            <th>Talla</th>
                            <th>Valor Total</th>
                            <th>Cantidad</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($compra->productos as $prod)


                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                    <td>
                                        @if($prod->imagen != '')
                                            <img src="{{Storage::url($prod->imagen)}}" class="card-img img-fluid rounded" style="max-height: 100px;max-width:100px; background-size:auto;">
                                        @else
                                            No se ha agregado Imagen
                                        @endif
                                    </td>
                                <td>{{$prod->tipo->nombre}}</td>
                                <td>{{$prod->categoria->nombre}}</td>
                                <td>{{$prod->color->nombre}}</td>
                                <td>{{$prod->genero->nombre}}</td>
                                <td>{{$prod->marca->nombre}}</td>
                                <td>{{$prod->talla->nombre}}</td>
                                <td>${{\App\Models\CompraProducto::where('compra_id',$compra->id)->where('producto_id',$prod->id)->first()->costo}}</td>
                                <td>{{\App\Models\CompraProducto::where('compra_id',$compra->id)->where('producto_id',$prod->id)->first()->cantidad}}</td>

                            </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>

@endsection
