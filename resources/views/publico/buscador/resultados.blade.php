@extends('layouts.esquema')

@section('content')
<section class="main-resultados my-5">
    <div class="container-fluid">
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
        <div class="row mt-5 ">
            <div class="col-3">
                <div class="p-0 dropdown-bar">
                    @include('publico.buscador._buscador')


                </div>
            </div>
            <div class="col-9 card-resultados">
                @isset($productos)
                    @foreach ($productos as $producto )
                    <div class="row">
                        <div class="card col-4 mx-1" >
                            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$producto}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca:       {{$producto->marca ?? ''}}</li>
                            <li class="list-group-item">Categoria:   {{$producto->categoria ?? ''}}</li>
                            <li class="list-group-item">Proveedor:   {{$producto->proveedor ?? ''}}</li>
                            <li class="list-group-item">Color:       {{$producto->color ?? ''}}</li>
                            <li class="list-group-item">Talla:       {{$producto->talla ?? ''}}</li>
                            <li class="list-group-item">Tipos:       {{$producto->tipo ?? ''}}</li>
                            <li class="list-group-item">Generos:     {{$producto->genero ?? ''}}</li>
                            </ul>
                            <div class="card-body">
                            <a href="{{route('publico.ver-producto',['id' => $producto->id])}}" class="card-link">Ver más</a>
                            <a href="#" class="card-link">Añadir al carrito</a>
                            </div>
                        </div>
                        <div class="card col-4 mx-1" >
                            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$producto}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca:       {{$producto->marca ?? ''}}</li>
                            <li class="list-group-item">Categoria:   {{$producto->categoria ?? ''}}</li>
                            <li class="list-group-item">Proveedor:   {{$producto->proveedor ?? ''}}</li>
                            <li class="list-group-item">Color:       {{$producto->color ?? ''}}</li>
                            <li class="list-group-item">Talla:       {{$producto->talla ?? ''}}</li>
                            <li class="list-group-item">Tipos:       {{$producto->tipo ?? ''}}</li>
                            <li class="list-group-item">Generos:     {{$producto->genero ?? ''}}</li>
                            </ul>
                            <div class="card-body">
                            <a href="{{route('publico.ver-producto',['id' => $producto->id])}}" class="card-link">Ver más</a>
                            <a href="#" class="card-link">Añadir al carrito</a>
                            </div>
                        </div>
                        <div class="card col-4 mx-1" >
                            <img class="card-img-top" src=".../100px180/?text=Image cap" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">{{$producto}}</h5>
                            </div>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item">Marca:       {{$producto->marca ?? ''}}</li>
                            <li class="list-group-item">Categoria:   {{$producto->categoria ?? ''}}</li>
                            <li class="list-group-item">Proveedor:   {{$producto->proveedor ?? ''}}</li>
                            <li class="list-group-item">Color:       {{$producto->color ?? ''}}</li>
                            <li class="list-group-item">Talla:       {{$producto->talla ?? ''}}</li>
                            <li class="list-group-item">Tipos:       {{$producto->tipo ?? ''}}</li>
                            <li class="list-group-item">Generos:     {{$producto->genero ?? ''}}</li>
                            </ul>
                            <div class="card-body">
                            <a href="#" class="card-link">Ver más</a>
                            <a href="#" class="card-link">Añadir al carrito</a>
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

$('#toast-region').toast('show');




</script>


@endpush
