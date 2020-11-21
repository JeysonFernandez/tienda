@extends('layouts.esquema')

@section('content')
<div class="main-ver-concesion container my-5 mb-5">
    <p class="mb-0 ubicacion-concesion"><i class="fas fa-map-marker-alt"></i></p>
    @isset($producto)
    <h1 class="titulo-concesion mb-4">
        {{$producto->nombre}}
    </h1>
    @else
    <h1 class="titulo-concesion mb-4">Proyecto de ejemplo #12345</h1>
    @endisset

    <p class="text-muted">
        <i class="fas fa-home"></i> /<b>Producto</b> /
    </p>


    <div class="row">

        {{---Galeria concesion--}}
        <div class="col-lg-5 mb-4 mb-lg-0">


            <div class="swiper-container gallery-top">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img class="img-fluid rounded img-slider" src="{{asset('images/concesion-pcm-image.jpg')}}">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img class="img-fluid rounded img-slider" src="{{asset('images/concesion-pcm-image.jpg')}}">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img class="img-fluid rounded img-slider" src="{{asset('images/concesion-pcm-image.jpg')}}">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img class="img-fluid rounded img-slider" src="{{asset('images/concesion-pcm-image.jpg')}}">
                        </a>
                    </div>
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next swiper-button-white"></div>
                <div class="swiper-button-prev swiper-button-white"></div>
            </div>

            <div class="swiper-container gallery-thumbs slider-thumbnail mt-2">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img src="{{asset('images/concesion-pcm-image.jpg')}}" class="img-fluid img-thumbnail-slider">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img src="{{asset('images/concesion-pcm-image.jpg')}}" class="img-fluid img-thumbnail-slider">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img src="{{asset('images/concesion-pcm-image.jpg')}}" class="img-fluid img-thumbnail-slider">
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a data-fslightbox href="{{asset('images/concesion-pcm-image.jpg')}}">
                            <img src="{{asset('images/concesion-pcm-image.jpg')}}" class="img-fluid img-thumbnail-slider">
                        </a>
                    </div>
                </div>
            </div>

        </div>

        {{---Datos basicos concesion--}}
        <div class="col-lg-7 pl-xl-5">
            <p class="despripcion-concesion text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque massa ac suscipit
                accumsan. Aenean non diam id lorem molestie tempus et sit amet turpis. Pellentesque malesuada dui
                sed
                elit placerat elementum. Sed id augue ac ex aliquet consectetur in vel enim. Vestibulum pharetra
                diam
                hendrerit, tincidunt ante ullamcorper, pharetra tortor. Cras in iaculis lacus. Aliquam nec molestie
                nunc. Fusce at vehicula nunc.
            </p>

            <ul class="datos-concesion pl-3 mt-5">
                <li class="row mb-3">
                    <div class="col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i></span> Fecha
                    </div>
                    <div class="col-6">
                        <strong>{{$producto->created_at ? $producto->created_at->format('d-F-Y') : ''}}</strong>
                    </div>
                </li>
                <li class="row mb-3">
                    <div class="col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i> Marca</span>
                    </div>
                    <div class="col-6">
                        <strong>{{$producto->marca ?? ''}}</strong>
                    </div>
                </li>
                <li class="row mb-3">
                    <div class=" col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i>Categoria</span>
                    </div>
                    <div class="col-6">
                        <strong> {{$producto->categoria ?? ''}}</strong>
                    </div>
                </li>
                <li class="row mb-3">
                    <div class=" col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i>Proveedor</span>
                    </div>
                    <div class="col-6">
                        <strong> {{$producto->proveedor ?? ''}}</strong>
                    </div>
                </li>
                <li class="row mb-3">
                    <div class=" col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i>Color</span>
                    </div>
                    <div class="col-6">
                        <strong> {{$producto->color ?? ''}}</strong>
                    </div>
                </li>
                <li class="row mb-3">
                    <div class=" col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i></span>Talla
                    </div>
                    <div class="col-6">
                        <strong> {{$producto->talla ?? ''}}</strong>
                    </div>
                </li>

                <li class="row mb-3">
                    <div class=" col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i></span>Tipos
                    </div>
                    <div class="col-6">
                        <strong> {{$producto->tipo ?? ''}}</strong>
                    </div>
                </li>
                <li class="row mb-3">
                    <div class=" col-6">
                        <span class=""><i class="fas fa-circle mr-2 list-dot align-middle"></i></span>Generos
                    </div>
                    <div class="col-6">
                        <strong> {{$producto->genero ?? ''}}</strong>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
