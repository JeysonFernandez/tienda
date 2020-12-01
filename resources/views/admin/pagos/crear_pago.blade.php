@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Agregar Pago</h3></div>

            </div>
        </div>
        <!-- Compra -->
        <div class="card-body">
                <div class="card card table mt-3">
                    <div class="card-header bg-light text-black ">Formulario Pago</div>
                    <div class="card-body">
                    <form method="POST" action ="{{route('admin.pago.agregarPago')}}">
                            @csrf
                            <div class="form-group">
                                <label for="compra"> Compra </label>
                                <select name="compra" id="compra" class="form-control" >
                                    @foreach ($compras as $compra)
                                        <option value="{{$compra->id}}"> Cliente: {{$compra->usuario->nombre}} {{$compra->usuario->primer_apellido}}, Deuda Pendiente:  {{$compra->deuda_pendiente}}</option>  
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="monto"> Monto del Pago</label>
                                    <input type="number" value="0" id="monto" name="monto" max="{{$compra->deuda_pendiente}}" class="form-control"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fecha"> Fecha del Pago</label>
                                    <input type="date"  id="fecha" name="fecha" class="form-control"/>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fecha_siguiente_pago"> Fecha Siguiente Pago</label>
                                    <input type="date"  id="fecha_siguiente_pago" name="fecha_siguiente_pago" class="form-control"/>
                                </div>
                            </div> 
                            
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary"> Confirmar</button>
                            </div>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>

        
    </div>

</div>

@endsection