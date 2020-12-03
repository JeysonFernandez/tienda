@extends('layouts.master')

@section('contenido')

<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Productos del pedido</h3></div>


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
                            <th>Stock Actual</th>
                            <th>Stock Critico</th>
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
                            <th>Stock Actual</th>
                            <th>Stock Critico</th>
                            <th>Valor Total</th>
                            <th>Cantidad</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($produc->pedidoproducto as $prod)


                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                    <td>
                                        @if($prod->imagen != '')
                                            <img src="{{Storage::url($producto->imagen)}}" class="card-img img-fluid rounded" style="max-height: 100px; background-size:auto;">
                                        @else
                                            No se ha agregado Imagen
                                        @endif
                                    </td>
                                <td>{{$prod->productos->tipo->nombre}}</td>
                                <td>{{$prod->productos->categoria->nombre}}</td>
                                <td>{{$prod->productos->color->nombre}}</td>
                                <td>{{$prod->productos->genero->nombre}}</td>
                                <td>{{$prod->productos->marca->nombre}}</td>
                                <td>{{$prod->productos->talla->nombre}}</td>
                                <td>{{$prod->productos->stock_actual}}</td>
                                <td>{{$prod->productos->stock_critico}}</td>
                                <td>{{$prod->valor_total}}</td>
                                <td>{{$prod->cantidad_producto}}</td>

                            </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>


@endsection
