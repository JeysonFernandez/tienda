@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Registro de Pagos </h3></div>
            <div class="p-2 bd-highlight"><a href="/admin/pagos/crear"><button type="button" class="btn btn-primary btn-lg text-right">Agregar</button></a></div>

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
                            <th>Compra </th>
                            <th>Estado del Pago</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Monto</th>
                            <th>Fecha</th>
                            <th>Compra </th>
                            <th>Estado del Pago</th>
                            <th></th>
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
                                <td>Compra #{{$pago->compra_id}} / {{$pago->compras->usuario->nombre}} {{$pago->compras->usuario->primer_apellido}}</td>
                                <td>
                                    @if($pago->estado == 1)
                                        Pagado con retraso
                                    @elseif( $pago->estado==2 )
                                        Pagado por adelantado
                                    @else
                                        Pagado el día acordado
                                    @endif
                                </td>
                                <td><!-- <a href="/compras/{{ $pago->id }}/edit" onclick="nombre(this)"><i class="fas fa-fw fa-2x fa-pen-square" aria-hidden="true"></i></a>-->
                                <a href="/pagos/{{$pago->id}}" ><i class="fas fa-fw fa-2x fa-trash-restore" aria-hidden="true"></i></a></td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>

@endsection
