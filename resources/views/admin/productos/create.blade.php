@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
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
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tipo"> Tipo </label>
                                    <select name="tipo" id="tipo" class="form-control" >
                                        @foreach ($tipos as $tipo)
                                            <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="marca"> Marca </label>
                                    <select name="marca" id="marca" class="form-control" >
                                        @foreach ($marcas as $marca)
                                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="categoria"> Categoria </label>
                                    <select name="categoria" id="categoria" class="form-control" >
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="color"> Color </label>
                                    <select name="color" id="color" class="form-control" >
                                        @foreach ($colors as $color)
                                            <option value="{{$color->id}}">{{$color->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="talla"> Talla </label>
                                    <select name="talla" id="talla" class="form-control" >
                                        @foreach ($tallas as $talla)
                                            <option value="{{$talla->id}}">{{$talla->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="genero"> Genero </label>
                                    <select name="genero" id="genero" class="form-control" >
                                        @foreach ($generos as $genero)
                                            <option value="{{$genero->id}}">{{$genero->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="proveedor"> Proveedor </label>
                                    <select name="proveedor" id="proveedor" class="form-control" >
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stock_actual"> Stock Actual </label>
                                    <input type="number" class="form-control  @error('stock_actual') is-invalid @enderror" id="stock_actual" name="stock_actual" value={{old('stock_actual')}} >
                                    @error('stock_actual')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="stock_critico"> Stock Crítico</label>
                                    <input type="number" class="form-control  @error('stock_critico') is-invalid @enderror" id="stock_critico" name="stock_critico" value={{old('stock_critico')}} >
                                    @error('stock_critico')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="precio_unidad"> Precio Unidad ($) </label>
                                    <input type="number" class="form-control  @error('precio_unidad') is-invalid @enderror" id="precio_unidad" name="precio_unidad" value={{old('precio_unidad')}}>
                                    @error('precio_unidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="costo_producto"> Costo Unidad ($) </label>
                                    <input type="number" class="form-control  @error('costo_producto') is-invalid @enderror" id="costo_producto" name="costo_producto" value={{old('costo_producto')}}>
                                    @error('costo_producto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 ">
                                <div class="form-group">
                                    <label for="imagen">Imagen</label>
                                    <div class="custom-file">
                                        <input  type="file" id="imagen" name="imagen" class="custom-file-input">
                                        <label for="imagen" class="custom-file-label" data-browse="Examinar">Seleccione la imagen</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="estado"> Estado </label>
                                    <select name="estado" id="estado" class="form-control">
                                            <option value="{{\App\Models\Producto::PUBLICADO}}">Publicado</option>
                                            <option value="{{\App\Models\Producto::BORRADOR}}" selected>Borrador</option>
                                            <option value="{{\App\Models\Producto::BORRADO}}">Borrado</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary " type="submit">Agregar</button>
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
