@extends('layouts.masterUsuario')

@section('contenido')

<div class="container-fluid">



    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Pedidos</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('usuario.exportPedidoUsuario',['id' => auth()->user()->id])}}" class="btn btn-naranjo btn-lg text-right">Exportar Excel</a></div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lugar a visitar</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Lugar a visitar</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Usuario</th>
                            <th>Tipo</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($pedidos as $pedido)
                            @if ($pedido->estado <> 'c')
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$pedido->lugar_visita}}</td>
                                <td>{{$pedido->fecha}}</td>
                                <td>{{$pedido->fecha_hora_inicio}}</td>
                                <td>{{$pedido->usuario_id}}</td>
                                <td>
                                    @if ($pedido->tipo == 'v')
                                        Visita
                                    @else
                                        Express
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('usuario.getpedidoproductos',$pedido->id)}}"class="btn btn-xs btn-naranjo swa-confirm" data-toggle="tooltip"
                                        title="Ver pedidos del usuario" > <i class="far fa-edit"></i>
                                    </a>
                                    <a href="/pedidos/cancelarPedido/{{$pedido->id}}"><button class="btn btn-danger"><i class="fas fa-minus-circle"></i></button></a>
                                </td>
                            </tr>
                            @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>
@endsection
