@extends('layouts.master')

@section('contenido')

<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Usuario / Compra / Registro de Pagos</h3></div>
            <div class="p-2 bd-highlight"><a href="{{route('admin.pago.agregarPagoCompra',['id' => $compra->id])}}"><button type="button" class="btn btn-primary btn-lg text-right">Agregar</button></a></div>

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
                            <th>ID Compra</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Estado del Pago</th>
                            <th>ID Compra</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($pagos as $pago)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$pago->monto}}</td>
                                <td>{{$pago->fecha}}</td>
                                <td>
                                    @if($pago->estado == \App\Models\Pago::Retrasado) Atrasado @endif
                                    @if($pago->estado == \App\Models\Pago::Adelantada) Adelantada @endif
                                    @if($pago->estado == \App\Models\Pago::Tiempo) A Tiempo @endif
                                </td>
                                <td><a  href="" data-toggle="modal" data-target="#modal-compra-{{$compra->id}}"  title="Ver detalles compra"
                                    class="btn btn-success"><i class="far fa-eye"></i></a>
                                    @include('modals.modal_compra',['compra' => $compra])
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
