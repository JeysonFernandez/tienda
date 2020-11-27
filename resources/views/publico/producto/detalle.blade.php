@extends('layouts.esquema')

@section('content')
    

    
            
    <div class="col-sm-12  mt-2">
      <div class="card mt-3 mb-5">
          <div class="card-header bg-light text-dark ">DETALLE DEL PRODUCTO</div>
          <div class="card-body">
            
              <div class="row">
                <div class="col-md-4">
                  <div class="card mt-3 mb-4 ml-4 shadow-sm">
                    @if($producto->imagen ==null)
                      <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    @else
                    <img src="{{Storage::url($producto->imagen)}}" class="card-img-top">
                    @endif
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="col"><h1>{{$producto->categoria->nombre}} color {{$producto->color->nombre}}, marca {{$producto->marca->nombre}}, {{$producto->talla->nombre}}</h1></div>
                  <div class="col"><h4>Stock: {{$producto->stock_actual}}</h4></div>
                  <div class="col"><h4>Precio: ${{$producto->precio_unidad}}</h4></div>
                  @if ($producto->stock_actual >0)
                      <div class="col"><a class="btn btn-lg btn-primary" href="/añadir-al-carrito/{{$producto->id}}">Añadir al carro</a></div>
                  @else
                  <h5 class="col">No hay stock</h5>
                  @endif
                  
                </div>
              </div>

          </div>
      </div>
  </div>
  <div class="container">
    <div>
      <h1>Ve también estos productos</h1>
    </div>
    <div class="row">
      @foreach ($productos as $producto)
      <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
          @if($producto->imagen ==null)
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
          @else
        <img src="{{Storage::url($producto->imagen)}}" width=50% class="card-img-top">
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
            
@endsection