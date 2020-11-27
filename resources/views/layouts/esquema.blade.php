<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

    </head>
    <body >
            <nav class="navbar navbar-expand-xl navbar-light bg-white shadow-sm sticky-top">
                <div class="container-fluid navbar-content">
                    <a class="navbar-brand" href="{{route('index')}}">
                        <h4>Tiendita de Pilar</h4>
                    </a>
                    <button id="toggleMenu" class="navbar-toggler" type="button" data-toggle="collapse"   aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="overlay-menu-movil"></div>
                    <div class="collapse d-flex w-100 justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav navbar-nav-custom ml-auto align-items-start align-items-xl-center">
                            <a class="navbar-brand my-4 d-block d-xl-none" href="">
                                <h4>Tiendita de Pilar</h4>
                            </a>


                            @guest
                                <li class="nav-item  mx-0 mx-xl-4 mt-3 mt-xl-0 order-3 order-xl-0">
                                    <form action="{{route('publico.busqueda')}}" method="get">

                                            <div class="input-group nav-search input-rounded shadow-sm">
                                            <input class="form-control input-rounded" placeholder="Buscar" type="text" name="buscadorTexto">
                                            <div class="input-group-append">
                                                <button class="btn bg-white"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </li>


                                <li class="nav-item mx-0 mx-xl-2">
                                <a class="nav-link font-weight-bolder" href="{{route('publico.auth.login')}}">Iniciar sesión</a>
                                </li>

                                <li class="nav-item mx-0 mx-xl-3">
                                    <a href="{{route('publico.auth.registrarse')}}" class="btn btn-naranjo font-weight-bolder">
                                        Registrarse gratis
                                    </a>
                                </li>
                            @else
                                <li class="nav-item mx-4">
                                    <form action="{{route('publico.busqueda')}}" method="get">
                                        @csrf
                                            <div class="input-group nav-search input-rounded shadow-sm">
                                            <input class="form-control input-rounded" placeholder="Buscar" type="text" name="buscadorTexto">
                                            <div class="input-group-append">
                                                <button class="btn bg-white"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                                {{--
                                <li class="nav-item mx-2">
                                    <a class="nav-link font-weight-bolder" href="">Mis Favoritos</a>
                                </li>
                                --}}
                                <li class="nav-item mx-2">
                                <a class="nav-link font-weight-bolder" href="{{route('publico.producto.carrito')}}">Mi Carrito</a>
                                </li>

                                <li class="nav-item mx-3">
                                    <div class="btn-group info-usuario-dropdown">
                                        <button class="btn btn-naranjo inicial-usuario d-flex align-items-center rounded-circle font-weight-bolder dropdown-toggle" id="dropdownMenuButton" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Str::upper(Str::limit(auth()->user()->nombre,1,'')) }}
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="dropdownMenuButton">
                                            <span class="d-block px-4 mb-4 mt-2 bienvenida-usuario">Bienvenido {{ auth()->user()->nombre}} </span>

                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Cambiar contraseña
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i> Datos personales
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="{{route('publico.logout')}}">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Cerrar Sesión
                                            </a>
                                        </div>
                                    </div>
                                </li>

                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="container-fluid">
                @yield('content')
            </main>
            @include('sweetalert::alert')
            <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
            <script src="{{ asset('js/app.js') }}"></script>

            @yield('javascript')
            @stack('javascript')
    </body>
</html>
