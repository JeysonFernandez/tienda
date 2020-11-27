@extends('layouts.esquema')

@section('content')


<div class="container-index">
    <div class="mt-5"><h1>Productos destacados</h1></div>
    <hr>
    <div class="row mt-5 card-resultados">
        @isset($concesiones)
        @foreach ($concesiones as $concesion_busqueda )
        <div class="col-xl-4 mb-3">
            <div class="card shadow card-resultados mb-3 bg-white px-3 border border warning">
                <div class="row no-gutters align-items-center justify-content-around">
                    <div class="col-xl-5 ">
                        <img
                        class="card-img img-fluid rounded"
                            alt="...">

                    </div>
                    <div class="col-xl-7">
                        <div class="card-body py-3 py-xl-0">
                            <h4 class="card-title  pb-2">Nombre Producto</h4>
                            <dl class="row">
                                <dt class="col-sm-5">Marca</dt>
                                <dd class="col-sm-7">Marca</dd>

                                <dt class="col-sm-5">Forma</dt>
                                <dd class="col-sm-7">Forma</dd>

                                <dt class="col-sm-5">Recurso</dt>
                                <dd class="col-sm-7">Recursos</dd>

                                <dt class="col-sm-5 text-truncate">Estudios</dt>
                                <dd class="col-sm-7">Cuenta con estudios</dd>

                            </dl>
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a href=""
                                        class="btn btn-detalle py-1 px-2 my-2">Ver detalles</a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href=""
                                        class="btn btn-detalle py-1 px-2 my-2">Añadir a Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else


        @endisset

    </div>
    <div class="mt-5"><h1>Nuestros Productos</h1></div>
    <hr>
    <div class="row mt-5 card-resultados">
        @isset($concesiones)
        @foreach ($concesiones as $concesion_busqueda )
        <div class="col-xl-6 mb-3">
            <div class="card shadow card-resultados mb-3 bg-white px-3">
                <div class="row no-gutters align-items-center justify-content-around">
                    <div class="col-xl-5 ">
                        <img
                        class="card-img img-fluid rounded"
                            alt="...">

                    </div>
                    <div class="col-xl-7">
                        <div class="card-body py-3 py-xl-0">
                            <h4 class="card-title  pb-2">Nombre Producto</h4>
                            <dl class="row">
                                <dt class="col-sm-5">Marca</dt>
                                <dd class="col-sm-7">Marca</dd>

                                <dt class="col-sm-5">Forma</dt>
                                <dd class="col-sm-7">Forma</dd>

                                <dt class="col-sm-5">Recurso</dt>
                                <dd class="col-sm-7">Recursos</dd>

                                <dt class="col-sm-5 text-truncate">Estudios</dt>
                                <dd class="col-sm-7">Cuenta con estudios</dd>

                            </dl>
                            <div class="row">
                                <div class="col-6 text-left">
                                    <a href=""
                                        class="btn btn-success py-1 my-2">Ver detalles</a>
                                </div>
                                <div class="col-6 text-right">
                                    <a href=""
                                        class="btn btn-naranjo py-1 my-2">Añadir a Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else

        @endisset

    </div>
</div>

@endsection
