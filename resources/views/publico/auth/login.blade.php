@extends('layouts.esquema')
@section('content')
<div class="container">
    <div class="row justify-content-center py-5">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card p-0 o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <h1>Iniciar Sesión</h1>
                        <hr>
                        <form class="user" method="POST" action="{{route('usuarios.login')}}">
                            @csrf
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                            @endif
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email"
                                    placeholder="Correo Electrónico" value="{{old('email')}}">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password"
                                    name="password" placeholder="Contraseña">
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            </div>
                            {{-- <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                    <label class="custom-control-label" for="remember">Mantener sesión iniciada en este navegador</label>
                                </div>
                            </div> --}}

                            <input type="hidden" name="idConcesion" value="@isset($id) {{$id}} @else -1 @endisset">
                            <button type="submit" class="btn btn-naranjo btn-user btn-block">
                                Iniciar Sesión
                            </button>
                        </form>
                        <hr>

                        <div class="text-center">
                            <a class="small" href="">Recuperar contraseña</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
