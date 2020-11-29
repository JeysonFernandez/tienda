@extends('layouts.esquema')

@section('content')

<div class="row justify-content-center py-5">
    <div class="col-xl-6 col-lg-8 col-md-12">
        <div class="card p-0 o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <h1 class="h4 text-gray-900 font-weight-bold mb-4 text-center">Tiendita de Pilar</h1>
                    
                            <p class="small">
                                Usted tiene más de un perfil. Seleccione uno para acceder.
                            </p>
                            
                            <ul class="list-unstyled">
                                <li class="mb-2"><a class="btn btn-block btn-info" href="{{route('admin.index')}}">Perfil de Admin</a></li>
                                <li class="mb-2"><a class="btn btn-block btn-info" href="{{'/usuario/1'}}">Perfil de Usuario</a></li>
                            </ul>
                            
                            <hr>

                            <div class="text-center">
                                <p><a class="small" href="{{route('publico.logout')}}"><b>Cerrar sesión</b></a></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection