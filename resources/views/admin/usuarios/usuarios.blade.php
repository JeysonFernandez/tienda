@extends('layouts.master')

@section('contenido')

<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de usuarios</h3></div>
                <div class="p-2 bd-highlight"><a href="{{--route('usuarios.create')--}}" class="btn btn-primary btn-lg text-right">Agregar</a></div>

            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Deuda Pendiente por Compras</th>
                            <th>Estado Calidad</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Deuda Pendiente por Compras</th>
                            <th>Estado Calidad</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($usuarios as $usuario)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$usuario->nombre}} {{$usuario->apellido}}</td>
                                <td>{{$usuario->username}}</td>
                                <td>{{$usuario->deuda_total}}</td>
                                <td>{{$usuario->estado_calidad}}</td>
                                <td>
                                    <a  href="{{route('admin.usuario.getPedidoUsuario',['id' => $usuario->id])}}" class="btn btn-xs btn-naranjo swa-confirm" data-toggle="tooltip"
                                        title="Ver pedidos del usuario" > <i class="far fa-edit"></i>
                                    </a>
                                    <a  href="{{route('admin.usuario.getCompraUsuario',['id' => $usuario->id])}}" class="btn btn-xs btn-naranjo swa-confirm" data-toggle="tooltip"
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
