@extends('layouts.master')

@section('contenido')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Proveedores</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Agregar Proveedor</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.getproveedor')}}" class="btn btn-primary btn-lg text-right">Volver</a></div>
            </div>
        </div>
        
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/proveedors" method="POST">
                @csrf
                <div class="row row-space">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="label">Nombre</label>
                            <input class="form-control @error('nombre') is-invalid @enderror" type="text" id="nombre" name="nombre"   value="{{old('nombre')}}">
                        </div>
                        <div class="form-group">
                            <label class="label">Descripción</label>
                            <input class="form-control @error('descripcion') is-invalid @enderror" type="text" id="descripcion" name="descripcion"   value="{{old('descripcion')}}">
                        </div>
                        <div class="form-group">
                            <label class="label">Dirección</label>
                            <input class="form-control @error('direccion') is-invalid @enderror" type="text" id="direccion" name="direccion"   value="{{old('nombre')}}">
                        </div>
                    </div>
                   
                </div>

                <div class="p-t-15">
                    <button class="btn btn-primary" type="submit">Agregar</button>
                </div>
            </form>
        </div>
        
        
    </div>
    
    

</div>
    
    
            
@endsection