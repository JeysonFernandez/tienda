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
            </div>


        </div>
    </div>
</section>
@endsection

@push('javascript')

<script>


        const categoria = document.querySelectorAll('a[name=categoria]');
        const marca = document.querySelectorAll('a[name=marca]');

        const inputCategoria = document.getElementById('categoria_id');
        const inputMarca = document.getElementById('marca_id');

        const inputNombreCategoria = document.getElementById('nombre_categoria');
        const inputNombreMarca = document.getElementById('nombre_marca');

        const botonBuscar = document.querySelector('#boton-buscar');
        //const botonBorrar = document.querySelector('#boton-borrar');

        const cardNombreCategoria = document.getElementById('card-nombre-categoria');
        const cardNombreMarca =  document.getElementById('card-nombre-marca');

        const toastCategoria = $('#toast-categoria');
        const toastMarca = $('#toast-marca');

        const btnCerrartoastCategoria = document.getElementById('btn-toast-categoria');
        const btnCerrartoastMarca = document.getElementById('btn-toast-marca');

        const formBuscador = document.getElementById('form-buscador');

        //const botonBorrar = document.querySelector('#boton-borrar');

        let arregloBuscador = {
                    categoria_id: inputCategoria.value,
                    marca_id: inputMarca.value,
        }





        console.log(categoria);

        if(arregloBuscador['categoria_id'] != ''){
            cardNombreCategoria.innerHTML = inputNombreCategoria.value;
            toastCategoria.toast('show');
        }
        if(arregloBuscador['marca_id'] != ''){
            cardNombreMarca.innerHTML = inputNombreMarca.value;
            toastMarca.toast('show');
        }



        function rellenar_arreglo_buscador(){
            const arregloBuscador = {
                    categoria_id: inputCategoria.value,
                    marca_id: inputMarca.value,
                }
            return arregloBuscador;
        }

        function cerrar_toast(cardNombre,toast,input,nombre){
            if(cardNombre.innerHTML != ''){
                cardNombre.innerHTML = '';
                toast.toast('hide');
                input.value = '';
                nombre.value = '';

                arregloBuscador = rellenar_arreglo_buscador();
            }
        }

        function ejecutar_form_buscador(){
            formBuscador.submit();
        }


        categoria.forEach(event  =>{
            event.addEventListener('click',e => {
                inputCategoria.value=e.target.getAttribute('data-id');
                inputNombreCategoria.value = e.target.innerHTML;

                cardNombreCategoria.innerHTML = e.target.innerHTML;
                toastCategoria.toast('show')



                arregloBuscador = rellenar_arreglo_buscador();

            });
        });

        marca.forEach(event  =>{
            event.addEventListener('click',e => {
                inputMarca.value=e.target.getAttribute('data-id');
                inputNombreMarca.value = e.target.innerHTML;

                cardNombreMarca.innerHTML = e.target.innerHTML;
                toastMarca.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

            });
        });






        btnCerrartoastCategoria.addEventListener('click', e =>{
            cerrar_toast(cardNombreCategoria,toastCategoria,inputCategoria,inputNombreCategoria);
        });

        btnCerrartoastMarca.addEventListener('click', e =>{
            cerrar_toast(cardNombreMarca,toastMarca,inputMarca,inputNombreMarca);
        });

</script>


@endpush
