@extends('layouts.esquema')

@section('content')
    

    
<div class="container-index">           
    <div class="col-md-12  mt-2">
      <div class="card-resultados mt-3 mb-5">
          <div class="card-header bg-light text-dark ">DETALLE DEL PRODUCTO</div>
          <div class="card-body">
            
            
              <div class="row">
                <div class="col-md-4">
                  <div class="card-resultados mt-3 mb-4 ml-4 shadow-sm">
                    @if($producto->imagen ==null)
                      <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    @else
                    <img src="{{Storage::url($producto->imagen)}}" class="card-img-top">
                    @endif
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="col"><h1>{{$producto->tipo->nombre}} color {{$producto->color->nombre}}, marca {{$producto->marca->nombre}}, {{$producto->talla->nombre}}</h1></div>
                  <div class="col"><h4>Stock: {{$producto->stock_actual}}</h4></div>
                  <div class="col"><h4>Precio: ${{$producto->precio_unidad}}</h4></div>
                  @if ($producto->stock_actual >0)
                      <div class="col"><a class="btn btn-lg btn-primary" href="{{route('publico.producto.addCarrito',['id' => $producto->id])}}">Añadir al carro</a></div>
                  @else
                  <h5 class="col">No hay stock</h5>
                  @endif
                  
                </div>
              </div>

          </div>
        </div>
      </div>
  </div>
</div>

<div class="container-index">
    
    <div class="mt-5"><h1>Ve también estos productos</h1></div>
    <hr>
    <div class="row mt-5 card-resultados">

        @foreach ($productos as $producto )
        <div class="col-xl-6 mb-3">
            <div class="card shadow card-resultados mb-3 bg-white px-3">
                <div class="row no-gutters align-items-center justify-content-around">
                    <div class="col-xl-5 ">
                    @if($producto->imagen ==null)
                        <svg class="card-img img-fluid rounded" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    @else
                        <img src="{{Storage::url($producto->imagen)}}" class="card-img img-fluid rounded">
                    @endif

                    </div>
                    <div class="col-xl-7">
                        <div class="card-body py-3 py-xl-0">
                            <h4 class="card-title  pb-2">{{$producto}}</h4>
                            <dl class="row">
                                <dt class="col-sm-5">Marca</dt>
                                <dd class="col-sm-7">{{$producto->marca ?? ''}}</dd>

                                <dt class="col-sm-5">Forma</dt>
                                <dd class="col-sm-7">Forma</dd>

                                <dt class="col-sm-5">Recurso</dt>
                                <dd class="col-sm-7">Recursos</dd>

                                <dt class="col-sm-5 text-truncate">Estudios</dt>
                                <dd class="col-sm-7">Cuenta con estudios</dd>

                            </dl>
                            <div class="row">
                                <div class="col-6 text-left">
                                <a href="{{route('publico.producto.verProducto',['id'=> $producto->id])}}"
                                        class="btn btn-success py-1 my-2">Ver detalles</a>
                                </div>
                                <div class="col-6 text-right">
                                <a href="{{route('publico.producto.addCarrito',['id' => $producto->id])}}"
                                        class="btn btn-naranjo py-1 my-2">Añadir a Carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>

@endsection