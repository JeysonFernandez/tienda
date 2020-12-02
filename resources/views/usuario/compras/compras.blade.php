@extends('layouts.masterUsuario')

@section('contenido')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Compras</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('usuario.exportCompraUsuario',['id' => auth()->user()->id])}}" class="btn btn-naranjo btn-lg text-right">Exportar Excel</a></div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Deuda Total</th>
                            <th>Deuda Pendiente</th>
                            <th>Siguiente Pago</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Estado</th>
                            <th>Deuda Total</th>
                            <th>Deuda Pendiente</th>
                            <th>Siguiente Pago</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($compras as $compra)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$compra->usuario->username}}</td>
                                <td>@if($compra->estado ==="t")
                                    Terminado
                                @else
                                    Pendiente
                                @endif</td>
                                <td>{{$compra->deuda_total}}</td>
                                <td>{{$compra->deuda_pendiente}}</td>
                                <td>{{$compra->fecha_siguiente_pago}}</td>
                                <td>
                                    <a href="{{route('usuario.getCompraProductos',$compra->id)}}"class="btn btn-xs btn-naranjo swa-confirm" data-toggle="tooltip"
                                        title="Ver compras del usuario" > <i class="fas fa-shopping-bag"></i>
                                    </a>
                                </td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>

@endsection
