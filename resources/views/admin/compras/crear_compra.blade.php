@extends('layouts.master')

@section('contenido')

<div class="container-fluid">
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Agregar Compra</h3></div>

            </div>
        </div>
        <!-- Compra -->
        <div class="card-body">
            <div class="col-sm-12  mt-2">
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <?php $total = 0?>
                <div class="card mt-3">
                    <div class="card-header bg-light text-black ">Formulario Compra</div>
                    <div class="card-body">
                    <form method="POST" action ="{{route('admin.compra.agregarAlCarrito')}}">
                            @csrf
                            <div class="form-group">
                                <label for="usuario"> Usuario </label>
                                <select name="usuario" id="usuario" class="form-control" >
                                    @foreach ($usuarios as $usuario)
                                        @if ($usuario->tipo <> 'a')
                                            <option value="{{$usuario->id}}" >{{$usuario->nombre}} {{$usuario->apellido}} (Fono: {{$usuario->fono}}) {{$usuario->username}}</option>  
                                        @endif
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="deuda_total"> Saldo Total</label>
                                <input type="number" value="{{$total}}" id="deuda_total" name="deuda_total" class="form-control @error('deuda_total') is-invalid @enderror" value="{{old('deuda_total')}}"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="abono"> Abono</label>
                                    <input type="number" id="abono" name="abono" class="form-control @error('abono') is-invalid @enderror" value="{{old('abono')}}" value="0"/>
                                </div>  
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="fecha_compra"> Fecha de la Compra</label>
                                    <input type="date" id="fecha_compra" name="fecha_compra" class="form-control @error('fecha_compra') is-invalid @enderror" value="{{old('fecha_compra')}}"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fecha_siguiente_pago"> Fecha del Siguiente Pago</label>
                                    <input type="date" id="fecha_siguiente_pago" name="fecha_siguiente_pago" class="form-control @error('fecha_siguiente_pago') is-invalid @enderror" value="{{old('fecha_siguiente_pago')}}"/>
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
        <!-- Carro -->
        <div class="card-body">
        <div class="card mt-3">
            <div class="card-header bg-light text-black ">Productos</div>
            <div class="card-body">
            <form method="POST" action ="{{route('admin.compra.agregarCompra')}}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="producto"> Producto </label>
                            <select name="producto" id="producto" class="form-control" >
                                @foreach ($productos as $producto)
                                    <option value="{{$producto->id}}">{{$producto->tipo->nombre}}
                                                                    {{$producto->categoria->nombre}}
                                                                    {{$producto->color->nombre}}
                                                                    {{$producto->genero->nombre}}
                                                                    {{$producto->marca->nombre}}
                                                                    {{$producto->talla->nombre}}
                                                                     (Stock Actual: {{$producto->stock_actual}})</option>  
                                @endforeach
                            </select>
                        </div> 
                        <div class="form-group col-md-5">
                            <label for="cantidad"> Cantidad</label>
                        <input type="number" value={{1}} id="cantidad" name="cantidad" class="form-control"/>
                        </div>
                    </div> 
                    
                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary"> Agregar a la compra</button>
                    </div>
                </form>
                <div class="card-body">
                    @include('publico.confirmarPedido.itemsCarrito')
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
        
    </div>

</div>

@endsection