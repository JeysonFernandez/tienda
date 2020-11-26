@extends('layouts.master')

@section('contenido')

<div class="container-fluid">
    
    <h1 class="h3 mb-2 text-gray-800">Productos</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Agregar Producto</h3></div>

            </div>
        </div>
        <!-- Compra -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    @if ($errors->any())
                        <div class="aler alert-danger">
                            <ul>
                                @foreach ( $errors->all() as $error )
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('admin.producto.agregarProducto')}}" method="POST" enctype="multipart/form-data">
                        @csrf 
                        <div class="form-group">
                            <label for="tipo"> Tipo </label>
                            <select name="tipo" id="tipo" class="form-control" >
                                @foreach ($tipos as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marca"> Marca </label>
                            <select name="marca" id="marca" class="form-control" >
                                @foreach ($marcas as $marca)
                                    <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="categoria"> Categoria </label>
                            <select name="categoria" id="categoria" class="form-control" >
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="color"> Color </label>
                            <select name="color" id="color" class="form-control" >
                                @foreach ($colors as $color)
                                    <option value="{{$color->id}}">{{$color->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="talla"> Talla </label>
                            <select name="talla" id="talla" class="form-control" >
                                @foreach ($tallas as $talla)
                                    <option value="{{$talla->id}}">{{$talla->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="genero"> Genero </label>
                            <select name="genero" id="genero" class="form-control" >
                                @foreach ($generos as $genero)
                                    <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="proveedor"> Proveedor </label>
                            <select name="proveedor" id="proveedor" class="form-control" >
                                @foreach ($proveedores as $proveedor)
                                    <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock_actual"> Stock Actual </label>
                            <input type="number" class="form-control  @error('stock_actual') is-invalid @enderror" id="stock_actual" name="stock_actual" value={{old('stock_actual')}} >
                        </div> 
                        <div class="form-group">
                            <label for="stock_critico"> Stock Crítico (Si se coloca un valor mayor al Stock Actual, automáticamente el Stock crítico será igual a Stock Actual) </label>
                            <input type="number" class="form-control  @error('stock_critico') is-invalid @enderror" id="stock_critico" name="stock_critico" value={{old('stock_critico')}} >
                        </div> 
                        <div class="form-group">
                            <label for="precio_unidad"> Precio Unidad ($) </label>
                            <input type="number" class="form-control  @error('precio_unidad') is-invalid @enderror" id="precio_unidad" name="precio_unidad" value={{old('precio_unidad')}}>
                        </div>  
                        <div class="form-group">
                            <div class="custom-file">
                                <input accept="image/*" type="file" id="imagen" name="imagen" class="custom-file-input">
                                <label for="imagen" class="custom-file-label" data-browse="Examinar">Seleccione la imagen</label>
                            </div>
                        </div> 
                        <button class="btn btn-primary" type="submit">Agregar</button>
                    </form>
                </div>
            </div>
    </div>
        
    </div>

</div>

@endsection
@section('js')
    <script>
        $('#imagen').on('change',function(){
           var archivo = $(this).val().replace('C:\\fakepath\\',"");
           $(this).next('.custom-file-label').html(archivo); 
        });
    </script>
@endsection
