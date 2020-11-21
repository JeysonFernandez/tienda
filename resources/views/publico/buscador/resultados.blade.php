@extends('layouts.esquema')

@section('content')
<section class="main-resultados my-5">
    <div class="container">
        <div class="row align-items-end mb-5">
            <div class="col-xl-2">
                <h1>Resultados</h1>
                <p class="text-muted">
                    <i class="fas fa-home"></i> /
                    <b>Buscador</b> /
                    Resultados
                </p>
            </div>

        </div>
        <hr>
        <div class="row mt-5 card-resultados">
            <div class="col-4">
                <div class="pl-0 dropdown-bar">
                    @include('publico.buscador._buscador')

                </div>
            </div>
            <div class="col-4">
                @isset($concesiones)
                    @foreach ($concesiones as $concesion_busqueda )
                    <div class="col-xl-6 mb-3">
                        <div class="card shadow card-resultados mb-3 bg-white px-3">
                            <div class="row no-gutters align-items-center justify-content-around">
                                <div class="col-xl-5 ">
                                    <img
                                    src="
                                    {{$concesion_busqueda->fotografias ? asset(json_decode($concesion_busqueda->fotografias)[0]) : asset('images/concesion-pcm-image.jpg')}}"
                                    class="card-img img-fluid rounded"
                                        alt="...">
                                    <span class="favorite">
                                        @if($concesion_busqueda->esFavoritoDelUsuario() == 0)
                                        <i data-toggle="tooltip" data-html="true" title="Agregar a favoritos" name="boton-favorito" class="fas fa-heart" data-id="{{$concesion_busqueda->id}}"></i>
                                        @elseif($concesion_busqueda->esFavoritoDelUsuario() == 1)
                                        <i data-toggle="tooltip" data-html="true" title="Eliminar de favoritos" name="boton-favorito" data-id="{{$concesion_busqueda->id}}" class="fas fa-heart"
                                            style="color:red"></i>
                                        @endif
                                    </span>
                                </div>
                                <div class="col-xl-7">
                                    <div class="card-body py-3 py-xl-0">
                                        <h4 class="card-title  pb-2">{{$concesion_busqueda->nombre ? 'Proyecto ' . @Str::limit($concesion_busqueda, 20, ' (...)')  : 'Concesion minera'}}</h4>
                                        <dl class="row">
                                            <dt class="col-sm-5">Tipo Yacimiento</dt>
                                            <dd class="col-sm-7">{{$concesion_busqueda->tipoYacimiento ?? ''}}</dd>

                                            <dt class="col-sm-5">Yacimiento</dt>
                                            <dd class="col-sm-7">{{$concesion_busqueda->formaYacimiento ?? ''}}</dd>

                                            <dt class="col-sm-5">Recurso</dt>
                                            <dd class="col-sm-7">{{$concesion_busqueda->recursoPrimario ?? ''}}</dd>

                                            <dt class="col-sm-5 text-truncate">Estudios</dt>
                                            <dd class="col-sm-7">Cuenta con estudios</dd>
                                        </dl>
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <a href="{{ route('publico.concesiones.ver', ['id' => $concesion_busqueda->id]) }}"
                                                    class="btn btn-detalle py-1 px-5 my-2">Ver detalles</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    No hay datos
                @endisset
            </div>


        </div>
    </div>
</section>
@endsection

@push('javascript')

<script>






</script>


@endpush
