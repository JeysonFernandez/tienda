@extends('layouts.masterUsuario')

@section('contenido')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card p-0 o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <form method="POST" action="{{ route('usuario.cambiar-contrasena') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password" class="">{{__('Contraseña')}}</label>
                                        <div class="">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}"  autocomplete="password" autofocus>

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password" class="">{{__('Nueva Contraseña')}}</label>
                                        <div class="">
                                            <input id="nueva" type="password" class="form-control @error('nueva') is-invalid @enderror" name="nueva" value="{{ old('nueva') }}">

                                            @error('nueva')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="nueva" class="">{{__('Tu contraseña debe como mínimo 6 caracteres ')}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="">{{__('Repetir Nueva Contraseña')}}</label>
                                        <div class="">
                                            <input id="nueva_confirmation" type="password" class="form-control @error('nueva_confirmation') is-invalid @enderror" name="nueva_confirmation" value="{{ old('nueva_confirmation') }}">
                                            <label for="password" class=""></label>
                                            @error('nueva_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group mt-3">
                                <button class="btn btn-block btn-naranjo">{{__('Guardar Datos')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
