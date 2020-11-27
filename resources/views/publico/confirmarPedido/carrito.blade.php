@extends('layouts.esquema')

@section('content')
    <div class="row">
        <div class="col-md-6 pl-6">
            @include('publico.confirmarPedido.itemsCarrito')
        </div>
  
        <div class="col-md-6">
            @include('publico.confirmarPedido.pedido')
        </div>
    </div>
            
@endsection

@section('js')
    <script>
        document.getElementById("hora").min = "08:00";
        document.getElementById("hora").max = "20:00";

        var today = new Date();
        document.getElementById("fecha").min = today;
    </script>
@endsection