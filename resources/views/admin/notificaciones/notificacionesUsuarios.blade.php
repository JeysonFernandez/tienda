@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Notificaciones de Usuario</h3></div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mensaje</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Mensaje</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Detalle</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($notificacionUsuarios as $notificacion)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$notificacion->mensaje}}</td>
                                <td>{{$notificacion->usuario->nombre}} {{$notificacion->usuario->apellido}}</td>
                                <td>{{$notificacion->fecha_creacion}}</td>
                                <td><a href=""></a></td>
                        </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>


@endsection
