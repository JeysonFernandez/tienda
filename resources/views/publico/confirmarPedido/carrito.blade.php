@extends('layouts.esquema')

@section('contenido')
    <div class="row">
        <div class="col">
            @include('publico.confirmarPedido.itemsCarrito')
        </div>
        <div>
            <a class="btn btn-danger" href=""> Borrar Carro </a>
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