@extends('layouts.esquema')

@section('content')


    <div id="myCarousel" class="carousel slide pt-5" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
          <div class="container">
            <div class="carousel-caption text-left">
              <h1>Example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
            </div>
          </div>
        </div>
        @foreach ($productos as $producto)
          <div class="carousel-item">
              @if($producto->imagen ==null)
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
              @else
              <img src="{{Storage::url($producto->imagen)}}" class="card-img-top">
              @endif
              <div class="container">
                <div class="carousel-caption">
                  <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
              </div>
          </div>
          @endforeach
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
          <div class="container">
            <div class="carousel-caption">
              <h1>Another example headline.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><rect width="100%" height="100%" fill="#777"/></svg>
          <div class="container">
            <div class="carousel-caption text-right">
              <h1>One more for good measure.</h1>
              <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
              <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <div><h1>Algunos de nuestros productos</h1></div>

    <div class="album py-5 bg-light">
      <div class="container">
        <div class="row">
          @foreach ($productos as $producto)
          <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
              @if($producto->imagen ==null)
                <svg class="bd-placeholder-img card-img-top" width="100px" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
              @else
            <img src="{{Storage::url($producto->imagen)}}" class="card-img-top">
              @endif
              <div class="card-body">
              <p class="card-text">
                                {{$producto->categoria->nombre}}
                                {{$producto->color->nombre}}
                                {{$producto->genero->nombre}}
                                </p>
                <p class="card-text">Talla: {{$producto->talla->nombre}}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                  <a class="btn btn-sm btn-outline-secondary" href="/productos/{{$producto->id}}">Ver</a>
                  @if ($producto->stock_actual > 0)
                     <a class="btn btn-sm btn-outline-secondary" href="/añadir-al-carrito/{{$producto->id}}">Añadir al carro</a>
                  @endif

                  </div>
                  <p class="text-muted pl-1">@if ($producto->stock_actual > 0)
                      Precio c/u: ${{$producto->precio_unidad}}
                  @else
                    No hay stock
                  @endif </p>
                </div>
              </div>
            </div>
          </div>
          @endforeach

        </div>
      </div>
    </div>


@endsection
