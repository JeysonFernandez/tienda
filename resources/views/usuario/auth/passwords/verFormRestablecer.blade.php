@extends('publico.layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-8 col-md-9">
            <div class="card p-0 o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <img class="w-75 img-fluid" src="{{asset('images/logo-consesion-minera.png')}}">
                        </div>
                        <form class="formulario-enjoy-route" method="POST" action="{{ route('publico.restablecer.ver-form-email') }}">
                            <h3>{{__('Ingrese el email de su cuenta')}}</h3>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="list-unstyled">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{ csrf_field()}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-md-3 mb-2 ">
                                        <label for="email" class="form-label">{{__('Correo electrónico')}}</label>
                                        <input id="email" type="email" required class="form-control @error('email') is-invalid @enderror" value="{{ old('email') or '' }}" name="email">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="concesionId" value="@isset(request()->concesionId) {{request()->concesionId}} @else '' @endisset">
                            <button type="submit" class="btn btn-primary d-block w-100">{{__('Enviar correo')}}</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
