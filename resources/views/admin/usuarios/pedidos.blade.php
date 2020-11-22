@extends('layouts.master')

@section('contenido')

<div class="container-fluid">
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Pedidos</h3></div>
            </div>
            <h5>{{$mensaje}}</h5>
            <form action="{{route('admin.pedido.getPedidoUsuarioPost',$id)}}" method="POST">
                @csrf
                <input type="date" name="fechaInicial" id="fechaInicial" value="{{old('fechaInicial')}}">
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
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$pedido->lugar_visita}}</td>
                                <td>{{$pedido->fecha}}</td>
                                <td>{{$pedido->hora}}</td>
                                <td>{{$pedido->usuario}}</td>
                                <td>
                                    @if ($pedido->tipo == 'v')
                                        Visita
                                    @else
                                        Express
                                    @endif
                                </td>
                                <td> 
                                    <a href="{{route('admin.pedido.getPedidoProductos',$pedido->id)}}"><i class="fas fa-fw fa-2x fa-pen-square" aria-hidden="true"></i></a>
                                    
                            </tr>
                        
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Seguro que quieres eliminar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Producto a eliminar es <span id="nombreProducto"></span></div>
                <div class="modal-footer" >
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-secondary .align-items-start" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.producto.confirmDelete')}}" method="POST" name="f1" id="f1" >
                        @csrf
                        @method('delete')
                        <input type="text" name="idfinal" id="idfinal" style="visibility: hidden">
                        <button type="submit" class="btn btn-primary .align-items-end">eliminar</button>
                    </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>

@endsection