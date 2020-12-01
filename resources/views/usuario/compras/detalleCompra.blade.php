@extends('layouts.masterUsuario')

@section('contenido')

<div class="container-fluid">

    <!-- Page Heading -->


    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Productos</h3></div>


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
                            <th>Costo Total</th>
                            <th>Cantidad</th>
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
                            <th>Costo Total</th>
                            <th>Cantidad</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($produc->productos as $prod)


                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$prod->tipo->nombre}}</td>
                                <td>{{$prod->categoria->nombre}}</td>
                                <td>{{$prod->color->nombre}}</td>
                                <td>{{$prod->genero->nombre}}</td>
                                <td>{{$prod->marca->nombre}}</td>
                                <td>{{$prod->talla->nombre}}</td>
                                <td>{{$prod->stock_actual}}</td>
                                <td>{{$prod->stock_critico}}</td>
                                <td>{{$prod->pivot->costo_total}}</td>
                                <td>{{$prod->pivot->cantidad_producto}}</td>

                            </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>

@endsection
