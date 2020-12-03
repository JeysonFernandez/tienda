@extends('layouts.master')

@section('contenido')

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Registro de Compras</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.compra.exportCompra')}}" class="btn btn-naranjo btn-lg text-right">Exportar Excel</a></div>
            </div>
            <h5>{{$mensaje}}</h5>
            <form action="{{route('admin.compra.getCompraPost')}}" method="POST">
                @csrf
                <input type="date" name="fechaInicial" id="fechaInicial">
                <input type="date" name="fechaFinal" id="fechaFinal">
                <button type="submit">Mostrar</button>
            </form>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
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
                            <th>Usuario</th>
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
                                <td>
                                    <a  href="" data-toggle="modal" data-target="#modal-usuario-{{$compra->usuario->id}}"  title="Ver detalles compra"
                                        class="btn btn-success">{{$compra->usuario->email}}</a>
                                        @include('modals.modal_usuario',['usuario' => $compra->usuario])
                                </td>
                                <td>

                                    @if($compra->estado == \App\Models\Compra::Pendiente) Pendiente @endif
                                    @if($compra->estado == \App\Models\Compra::Completado) Completado @endif
                                </td>
                                <td>${{$compra->deuda_total}}</td>
                                <td>${{$compra->deuda_pendiente}}</td>
                                <td>
                                    @if($compra->deuda_pendiente>0)
                                        {{explode(' ',$compra->fecha_siguiente_pago)[0]}}
                                    @else
                                        No quedan fechas de pago
                                    @endif
                                </td>
                                <td>
                                @if($compra->deuda_pendiente>0)
                                    <a href="{{route('admin.pago.pagoPersonalizado',$compra->id)}}"class="btn btn-xs btn-success swa-confirm" data-toggle="tooltip"
                                        title="Agregar un pago" ><i class="fas fa-money-bill-wave"></i>
                                    </a>
                                @endif
                                    <a href="{{route('admin.compra.getComprasProductos',$compra->id)}}"class="btn btn-xs btn-warning swa-confirm" data-toggle="tooltip"
                                        title="Ver detalles compra" > <i class="far fa-eye"></i>
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
