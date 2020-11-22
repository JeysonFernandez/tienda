@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    
    <h1 class="h3 mb-2 text-gray-800">Fechas no Disponibles</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Tabla de Fechas</h3></div>
                <div class="p-2 bd-highlight"><a href="/fechas/create"><button type="button" class="btn btn-primary btn-lg text-right">Agregar</button></a></div>

            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center aling-center table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Duracion(Minutos)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Duracion(Horas)</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $cont = 0?>
                        @foreach ($fechas as $fecha)
                            <?php $cont++?>
                            <tr>
                                <td>{{$cont}}</td>
                                <td>{{$fecha->fecha}}</td>
                                <td>{{$fecha->hora}}</td>
                                <th>{{$fecha->duracion}}</th>
                                <td> 
                                <a href="/fechas/{{$fecha->id}}" ><i class="fas fa-fw fa-2x fa-trash-restore" aria-hidden="true"></i></a></td> 
                        </tr>
                        
                        @endforeach
                        
                        
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

</div>

@endsection