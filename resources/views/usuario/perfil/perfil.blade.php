@extends('layouts.masterUsuario')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card p-0 o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">

                        <form method="POST" action="{{ route('usuario.misDatosGuardar',['id' => auth()->user()->id]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="nombre" class="">Nombre</label>
                                        <div class="">
                                            <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre',auth()->user()->nombre) }}"  autocomplete="nombre" autofocus>

                                            @error('nombre')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="primer_apellido" class="">Primer Apellido</label>

                                        <div class="">
                                            <input id="primer_apellido" type="text" class="form-control @error('primer_apellido') is-invalid @enderror" name="primer_apellido" value="{{ old('primer_apellido',auth()->user()->primer_apellido) }}"  autocomplete="primer_apellido" autofocus>

                                            @error('primer_apellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="segundo_apellido" class="">Segundo Apellido</label>

                                        <div class="">
                                            <input id="segundo_apellido" type="text" class="form-control @error('segundo_apellido') is-invalid @enderror" name="segundo_apellido" value="{{ old('segundo_apellido',auth()->user()->segundo_apellido) }}"  autocomplete="segundo_apellido" autofocus>

                                            @error('segundo_apellido')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email" class="">Correo electrónico</label>

                                        <div class="">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',auth()->user()->email) }}"   autofocus>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="email_confirmation" class="">Repetir Correo electrónico</label>

                                        <div class="">
                                            <input id="email_confirmation" type="email" class="form-control @error('email_confirmation') is-invalid @enderror" name="email_confirmation" value="{{ old('email_confirmation',auth()->user()->email) }}"  autocomplete="email_confirmation" autofocus>
                                            @error('email_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group mt-3">
                                <button class="btn btn-block btn-primary">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
