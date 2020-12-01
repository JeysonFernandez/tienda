@extends('layouts.master')

@section('contenido')
<div class="container-fluid">
    <div class="card card-table shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex bd-highlight mb-3">
                <div class="mr-auto p-2 bd-highlight"> <h3 class="m-0 font-weight-bold text-primary">Editar color</h3></div>
                <div class="p-2 bd-highlight"><a href="{{route('admin.color.verColor')}}" class="btn btn-primary btn-lg text-right">Volver</a></div>
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
            <form action="{{route('admin.color.updateColor',['id' => $color->id])}}" method="POST">
                @csrf
                <div class="row row-space">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="label">Nombre</label>
                            <input class="form-control @error('nombre') is-invalid @enderror" type="text" id="nombre" name="nombre"   value="{{old('nombre') ?? $color->nombre ?? '' }}">
                        </div>
                        @error('nombre')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <input type="hidden" name="id" value="{{$color->id}}">
                <div class="p-t-15">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
