@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table  shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Notificaciones de Producto</h3></div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mensaje</th>
                            <th>Producto</th>
                            <th> Imagen</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Mensaje</th>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Fecha</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>

                        @foreach ($notificacionProductos as $notificacion)

                                <?php $cont++?>
                                <tr>
                                <td>{{$cont}}</td>
                                <td>{{$notificacion->mensaje}}</td>
                                <td>{{$notificacion->productos->tipo->nombre}}
                            {{$notificacion->productos->categoria->nombre}}
                            {{$notificacion->productos->color->nombre}}
                            {{$notificacion->productos->genero->nombre}}
                            {{$notificacion->productos->marca->nombre}}
                            {{$notificacion->productos->talla->nombre}}
                                </td>
                                <td>
                                    @if($notificacion->productos->imagen != '')
                                        <img src="{{Storage::url($notificacion->productos->imagen)}}" class="card-img img-fluid rounded" style="max-height: 100px;max-width:100px; background-size:auto;">
                                    @else
                                        No se ha agregado Imagen
                                    @endif
                                </td>
                                <td>
                            {{$notificacion->fecha_creacion}}</td>
                                <td></td>
                                </tr>

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>


    </div>

</div>


@endsection


