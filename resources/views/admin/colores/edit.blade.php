@extends('layouts.master')

@section('contenido')
<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Editar Color</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.color.getcolor')}}" class="btn btn-primary btn-lg text-right">Volver</a></div>
            </div>
        </div>
        
        <div class="card-body">

           <!-- @if ($errors->any())
                <div class="aler alert-danger">
                    <ul>
                        @foreach ( $errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif-->
            
            <form action="{{route('admin.color.confirmarUpdate')}}" method="POST">
                @csrf
                
                <div class="row row-space">
                    <div class="col-12">
                        <div class="input-group">
                            <label class="label">Nombre</label>
                            <input class="input--style-4" type="text" id="nombre" name="nombre" value="{{old('nombre')}}" placeholder="{{$color->nombre}}">
                        </div>
                    </div>
                   
                </div>

                <div class="p-t-15">
                    <button class="btn btn--radius-2 btn--blue" type="submit">Actualizar</button>
                </div>
                <input class="input--style-4" style="visibility: hidden" type="text" id="id" name="id" value="{{$color->id}}" placeholder="{{$color->id}}">
            </form>
        </div>
        
        
    </div>
    
    

</div>
    
    
            
@endsection