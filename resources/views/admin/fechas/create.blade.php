@extends('layouts.master')

@section('contenido')
<div class="container-fluid">

    <h1 class="h3 mb-2 text-gray-800">Fechas</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="p-2 bd-highlight"><a href="{{route('admin.getfechas')}}" class="btn btn-primary btn-lg text-right">Volver</a></div>
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
            <form action="/fechas" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fecha"> Fecha</label>
                        <input type="date" id="fecha" name="fecha" class="form-control @error('fecha') is-invalid @enderror"/>
                    </div>  
                    <div class="form-group col-md-6">
                        <label for="hora"> Hora</label>
                        <input type="time" id="hora" name="hora" class="form-control @error('hora') is-invalid @enderror"/>
                    </div>
                </div>  
                <div class="row row-space">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="label">Duracion</label>
                            <input class="form-control @error('nombre') is-invalid @enderror" type="number" id="duracion" name="duracion"   value="{{old('nombre')}}">
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