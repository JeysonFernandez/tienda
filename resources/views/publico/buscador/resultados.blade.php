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

                                            <dt class="col-sm-5">Porveedor</dt>
                                            <dd class="col-sm-7">{{$producto->proveedor ?? ''}}</dd>

                                            <dt class="col-sm-5">Precio</dt>
                                            <dd class="col-sm-7">{{$producto->precio_unidad ?? ''}}</dd>

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
        const tipo = document.querySelectorAll('a[name=tipo]');
        const talla = document.querySelectorAll('a[name=talla]');
        const proveedor = document.querySelectorAll('a[name=proveedor]');
        const color = document.querySelectorAll('a[name=color]');
        const genero = document.querySelectorAll('a[name=genero]');


        const inputCategoria = document.getElementById('categoria_id');
        const inputMarca = document.getElementById('marca_id');
        const inputTipo = document.getElementById('tipo_id');
        const inputTalla = document.getElementById('talla_id');
        const inputProveedor = document.getElementById('proveedor_id');
        const inputColor = document.getElementById('color_id');
        const inputGenero = document.getElementById('genero_id');

        const inputNombreCategoria = document.getElementById('nombre_categoria');
        const inputNombreMarca = document.getElementById('nombre_marca');
        const inputNombreTipo = document.getElementById('nombre_tipo');
        const inputNombreTalla= document.getElementById('nombre_talla');
        const inputNombreProveedor = document.getElementById('nombre_proveedor');
        const inputNombreColor = document.getElementById('nombre_color');
        const inputNombreGenero = document.getElementById('nombre_genero');

        const botonBuscar = document.querySelector('#boton-buscar');
        //const botonBorrar = document.querySelector('#boton-borrar');

        const cardNombreCategoria = document.getElementById('card-nombre-categoria');
        const cardNombreMarca =  document.getElementById('card-nombre-marca');
        const cardNombreTipo = document.getElementById('card-nombre-tipo');
        const cardNombreTalla =  document.getElementById('card-nombre-talla');
        const cardNombreProveedor = document.getElementById('card-nombre-proveedor');
        const cardNombreColor =  document.getElementById('card-nombre-color');
        const cardNombreGenero =  document.getElementById('card-nombre-genero');

        const toastCategoria = $('#toast-categoria');
        const toastMarca = $('#toast-marca');
        const toastTipo = $('#toast-tipo');
        const toastTalla = $('#toast-talla');
        const toastProveedor = $('#toast-proveedor');
        const toastColor = $('#toast-color');
        const toastGenero = $('#toast-genero');

        const btnCerrartoastCategoria = document.getElementById('btn-toast-categoria');
        const btnCerrartoastMarca = document.getElementById('btn-toast-marca');
        const btnCerrartoastTipo = document.getElementById('btn-toast-tipo');
        const btnCerrartoastTalla = document.getElementById('btn-toast-talla');
        const btnCerrartoastProveedor = document.getElementById('btn-toast-proveedor');
        const btnCerrartoastColor = document.getElementById('btn-toast-color');
        const btnCerrartoastGenero = document.getElementById('btn-toast-genero');

        const formBuscador = document.getElementById('form-buscador');

        //const botonBorrar = document.querySelector('#boton-borrar');

        let arregloBuscador = {
                    categoria_id: inputCategoria.value,
                    marca_id: inputMarca.value,
                    tipo_id: inputTipo.value,
                    talla_id: inputTalla.value,
                    genero_id: inputGenero.value,
                    proveedor_id: inputProveedor.value,
                    color_id: inputColor.value,
        }






        if(arregloBuscador['categoria_id'] != ''){
            cardNombreCategoria.innerHTML = inputNombreCategoria.value;
            toastCategoria.toast('show');
        }
        if(arregloBuscador['marca_id'] != ''){
            cardNombreMarca.innerHTML = inputNombreMarca.value;
            toastMarca.toast('show');
        }
        if(arregloBuscador['tipo_id'] != ''){
            cardNombreTipo.innerHTML = inputNombreTipo.value;
            toastTipo.toast('show');
        }
        if(arregloBuscador['talla_id'] != ''){
            cardNombreTalla.innerHTML = inputNombreTalla.value;
            toastTalla.toast('show');
        }
        if(arregloBuscador['proveedor_id'] != ''){
            cardNombreProveedor.innerHTML = inputNombreProveedor.value;
            toastProveedor.toast('show');
        }
        if(arregloBuscador['color_id'] != ''){
            cardNombreColor.innerHTML = inputNombreColor.value;
            toastColor.toast('show');
        }
        if(arregloBuscador['genero_id'] != ''){
            cardNombreGenero.innerHTML = inputNombreGenero.value;
            toastGenero.toast('show');
        }



        function rellenar_arreglo_buscador(){
            const arregloBuscador = {
                    categoria_id: inputCategoria.value,
                    marca_id: inputMarca.value,
                    tipo_id: inputTipo.value,
                    talla_id: inputTalla.value,
                    proveedor_id: inputProveedor.value,
                    color_id: inputColor.value,
                    genero_id: inputGenero.value,
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
        tipo.forEach(event  =>{
            event.addEventListener('click',e => {
                console.log('hola');
                inputTipo.value=e.target.getAttribute('data-id');
                inputNombreTipo.value = e.target.innerHTML;

                cardNombreTipo.innerHTML = e.target.innerHTML;
                toastTipo.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

            });
        });
        talla.forEach(event  =>{
            event.addEventListener('click',e => {
                inputTalla.value=e.target.getAttribute('data-id');
                inputNombreTalla.value = e.target.innerHTML;

                cardNombreTalla.innerHTML = e.target.innerHTML;
                toastTalla.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

            });
        });
        proveedor.forEach(event  =>{
            event.addEventListener('click',e => {
                inputProveedor.value=e.target.getAttribute('data-id');
                inputNombreProveedor.value = e.target.innerHTML;

                cardNombreProveedor.innerHTML = e.target.innerHTML;
                toastMarca.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

            });
        });
        color.forEach(event  =>{
            event.addEventListener('click',e => {
                inputColor.value=e.target.getAttribute('data-id');
                inputNombreColor.value = e.target.innerHTML;

                cardNombreColor.innerHTML = e.target.innerHTML;
                toastColor.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

            });
        });
        genero.forEach(event  =>{
            event.addEventListener('click',e => {
                inputGenero.value=e.target.getAttribute('data-id');
                inputNombreGenero.value = e.target.innerHTML;

                cardNombreGenero.innerHTML = e.target.innerHTML;
                toastGenero.toast('show')

                arregloBuscador = rellenar_arreglo_buscador();

            });
        });







        btnCerrartoastCategoria.addEventListener('click', e =>{
            cerrar_toast(cardNombreCategoria,toastCategoria,inputCategoria,inputNombreCategoria);
        });

        btnCerrartoastMarca.addEventListener('click', e =>{
            cerrar_toast(cardNombreMarca,toastMarca,inputMarca,inputNombreMarca);
        });

        btnCerrartoastTipo.addEventListener('click', e =>{
            cerrar_toast(cardNombreTipo,toastTipo,inputTipo,inputNombreTipo);
        });

        btnCerrartoastTalla.addEventListener('click', e =>{
            cerrar_toast(cardNombreTalla,toastTalla,inputTalla,inputNombreTalla);
        });

        btnCerrartoastCategoria.addEventListener('click', e =>{
            cerrar_toast(cardNombreCategoria,toastCategoria,inputCategoria,inputNombreCategoria);
        });

        btnCerrartoastProveedor.addEventListener('click', e =>{
            cerrar_toast(cardNombreProveedor,toastProveedor,inputProveedor,inputNombreProveedor);
        });btnCerrartoastCategoria.addEventListener('click', e =>{
            cerrar_toast(cardNombreCategoria,toastCategoria,inputCategoria,inputNombreCategoria);
        });

        btnCerrartoastColor.addEventListener('click', e =>{
            cerrar_toast(cardNombreColor,toastColor,inputColor,inputNombreColor);
        });
        btnCerrartoastGenero.addEventListener('click', e =>{
            cerrar_toast(cardNombreGenero,toastGenero,inputGenero,inputNombreGenero);
        });

</script>


@endpush
