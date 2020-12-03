@extends('layouts.master')

@section('contenido')

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Editar Producto</h3></div>

            </div>
        </div>
        <!-- Compra -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                <!-- @if ($errors->any())
                <div class="aler alert-danger">
                    <ul>
                        @foreach ( $errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif-->

            <form action="{{route('admin.producto.updateProducto',['id' => $producto->id])}}" method="POST">
                @csrf

                 @csrf
                <div class="row row-space">
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Tipo</label>
                            <select class="form-control @error('tipo') is-invalid @enderror" name="tipo" id="tipo">
                                @foreach ($tipos as $tipo)
                                   <option value="{{$tipo->id}}" @if ($producto->tipo_id == $tipo->id) selected @endif>{{$tipo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Categoria</label>
                            <select class="form-control @error('categoria') is-invalid @enderror" name="categoria" id="categoria">
                                @foreach ($categorias as $categoria)
                                   <option value="{{$categoria->id}}" @if ($producto->categoria_id == $categoria->id) selected @endif>{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Color</label>
                            <select class="form-control @error('color') is-invalid @enderror" name="color" id="color">
                                @foreach ($colors as $color)
                                   <option value="{{$color->id}}"@if ($producto->color_id == $color->id) selected @endif>{{$color->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Genero</label>
                            <select class="form-control @error('genero') is-invalid @enderror" name="genero" id="genero">
                                @foreach ($generos as $genero)
                                   <option value="{{$genero->id}}"@if ($producto->genero_id == $genero->id) selected @endif>{{$genero->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Marca</label>
                            <select class="form-control @error('marca') is-invalid @enderror" name="marca" id="marca">
                                @foreach ($marcas as $marca)
                                   <option value="{{$marca->id}}"@if ($producto->marca_id == $marca->id) selected @endif>{{$marca->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Talla</label>
                            <select class="form-control @error('talla') is-invalid @enderror" name="talla" id="talla">
                                @foreach ($tallas as $talla)
                                   <option value="{{$talla->id}}"@if ($producto->talla_id == $talla->id) selected @endif>{{$talla->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Stock Actual</label>
                            <input class="form-control @error('stock_actual') is-invalid @enderror"type="number" value="{{$producto->stock_actual}}" name="stock_actual" id="stock_actual">
                            @error('stock_actual')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Stock Critico</label>
                            <input class="form-control @error('stock_critico') is-invalid @enderror"type="number" value="{{$producto->stock_critico}}" name="stock_critico" id="stock_critico">
                            @error('stock_critico')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="label">Precio Unidad</label>
                            <input class="form-control @error('precio_unidad') is-invalid @enderror"type="number" value="{{$producto->precio_unidad}}" name="precio_unidad" id="sprecio_unidad">
                            @error('precio_unidad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                        <div class="col-6">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" id="imagen" name="imagen" class="custom-file-input" value="{{URL::asset($producto->imagen)}}">
                                <label for="imagen" class="custom-file-label" data-browse="Examinar">Seleccione la imagen</label>

                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="estado"> Estado </label>
                            <select name="estado" id="estado" class="form-control">
                                    <option value="{{\App\Models\Producto::PUBLICADO}}" {{$producto->borrado == \App\Models\Producto::PUBLICADO ? 'selected': ''}}>Publicado</option>
                                    <option value="{{\App\Models\Producto::BORRADOR}}" {{$producto->borrado == \App\Models\Producto::BORRADOR ? 'selected': ''}}>Borrador</option>
                                    <option value="{{\App\Models\Producto::BORRADO}}" {{$producto->borrado == \App\Models\Producto::BORRADO ? 'selected': ''}}>Borrado</option>
                            </select>
                        </div>
                    </div>
                <div class="col-6"></div>
                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn-primary ml-3" type="submit">Actualizar</button>
                    </div>
                </div>
                <input class="input--style-4" style="visibility: hidden" type="text" id="id" name="id" value="{{$producto->id}}" placeholder="{{$producto->id}}">
            </form>
                </div>
            </div>
    </div>

    </div>

</div>

@endsection
