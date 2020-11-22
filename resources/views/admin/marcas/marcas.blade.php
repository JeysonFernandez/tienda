@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Marcas</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.marca.crearMarca')}}" class="btn btn-primary btn-lg text-right">Agregar</a></div>

            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($marcas as $marca)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$marca->nombre}}</td>
                                <td> <a href="/marcas/{{ $marca->id }}/edit" onclick="nombre(this)"><i class="fas fa-fw fa-2x fa-pen-square" aria-hidden="true"></i></a>
                                <a data-toggle="modal" data-target="#deleteModal" href="#" onclick="nombre(this)" id="{{$marca->nombre}}-{{$marca->id}}"><i class="fas fa-fw fa-2x fa-trash-restore" aria-hidden="true"></i></a></td> 
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
                    <form action="{{route('marcas.confirmDelete')}}" method="POST" name="f1" id="f1" >
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


@section('js')
    <script>
        function nombre(nom){
            nomb = nom.id.split("-");
            var texto = document.getElementById("nombreProducto");
            texto.innerHTML = nomb[0];
            document.f1.idfinal.value = nomb[1];
        }
    </script>
@endsection
