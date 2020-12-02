@extends('layouts.masterUsuario')

@section('contenido')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Registro de Pagos</h3></div>
            <div class="p-2 bd-highlight"><a href="{{route('usuario.exportUsuarioPago',['id' => auth()->user()->id])}}" class="btn btn-naranjo btn-lg text-right">Exportar Excel</a></div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Estado del Pago</th>
                            <th>Compra </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Estado del Pago</th>
                            <th>Compra </th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($compras as $compra)

                            @foreach ($compra->pagos as $pago)
                                <?php $cont++?>
                            <tr>
                                    <td>{{$cont}}</td>
                                    <td>{{$pago->monto}}</td>
                                    <td>{{$pago->fecha}}</td>
                                    <td>{{$pago->estado}}</td>
                                    <td>
                                        <a href="{{route('usuario.getCompraProductos',$compra->id)}}"class="btn btn-xs btn-naranjo swa-confirm" data-toggle="tooltip"
                                            title="Ver compras del usuario" > <i class="fas fa-shopping-bag"></i>
                                        </a>
                                    </td>
                            </tr>

                            @endforeach

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>

@endsection
